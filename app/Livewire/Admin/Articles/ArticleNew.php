<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Admin\Articles\ArticleCategories;
use App\Models\Admin\Articles\ArticleCategoriesArticles;
use App\Models\Admin\Articles\Articles;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticleNew extends Component
{
    use WithFileUploads;

    public $rules;
    public $categories;
    public $article_categories = [];

    public $title;
    public $description;
    public $meta_description;
    public $meta_tags;
    public $thumbnail_path;

    // protected $listeners =
    // [
    //     'thumbnail'
    // ];


    public function mount()
    {
        $this->categories = ArticleCategories::select('id','title')->get();
    }
    public function render()
    {
        if (Gate::allows('profile-user')) {
            abort(403);
        }
        return view('livewire.admin.articles.article-new');
    }

    public function store()
    {
        $this->rules = [
            'title' => 'required|unique:articles',
            'description'=>'required'
        ];
        $this->validate();

        // $this->state();
        $article = Articles::create([
            'title'             => $this->title,
            'active'            => 1,
            'description'       => $this->description,
            'meta_description'  => $this->meta_description,
            'meta_tags'         => strtolower($this->meta_tags),
            'created_by'        => Auth::user()->name,
        ]);

        if (isset($this->thumbnail_path)) {
            Storage::deleteDirectory('public/articles/'.$article->id);
            $ext = $this->thumbnail_path->getClientOriginalExtension();
            $code = Str::uuid();
            $new_name = $code . '.' . $ext;
            $this->thumbnail_path->storeAs('public/articles/'.$article->id, $new_name);
            $article->thumbnail_path = $code;
            $article->save();

            //criar imagem em WEBP
            $thumbWebp = Image::make('storage/articles/'.$article->id.'/'.$new_name);
            $thumbWebp->encode('webp', 95);
            $thumbWebp->save('storage/articles/'.$article->id.'/'. $code . '.webp');
        }
        foreach ($this->article_categories as $key => $value) {
            ArticleCategoriesArticles::create([
                'user_id'              => Auth::user()->id,
                'articles_id'          => $article->id,
                'article_categories_id'=> $value,
            ]);
        }


        $this->openAlert('success', 'Registro criado com sucesso.');
        $this->redirectRoute('articles');
    }
    public function excluirTemp()
    {
        $this->thumbnail_path = '';
    }

     //pega o status do registro
     public function openAlert($status, $msg)
     {
         $this->dispatch('openAlert', $status, $msg);
     }
}
