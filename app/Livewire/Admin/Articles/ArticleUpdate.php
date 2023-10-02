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

class ArticleUpdate extends Component
{

    use WithFileUploads;

    public $rules;
    public $article;

    public $categories;
    public $article_categories = [];

    public $model_id;
    public $active = 1;
    public $title;
    public $description;
    public $thumbnail_path;
    public $meta_description;
    public $meta_tags;
    public $thumbnail;

     protected $listeners =
    [
        'sendThumb'
    ];

    public function mount(Articles $articles)
    {
        $this->article          = $articles;
        $this->model_id         = $articles->id;
        $this->title            = $articles->title;
        $this->description      = $articles->description;
        $this->meta_description = $articles->meta_description;
        $this->meta_tags        = $articles->meta_tags;
        $this->thumbnail        = $articles->thumbnail_path;

        foreach ($articles->categories->pluck('id')->toArray() as $key => $value) {
            $this->article_categories[] = $value;
        }

        $this->categories = ArticleCategories::select('id','title')->get();
        // dd($this->article_categories);
    }
    public function render()
    {
        return view('livewire.admin.articles.article-update');
    }
    public function update()
    {
        $this->realUpdate();
        $this->redirectRoute('articles');
    }
    public function updateContinue()
    {
        $this->realUpdate();
    }

    public function realUpdate()
    {
        $this->rules = [
            'title' => 'required',
        ];

        $this->validate();

        Articles::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title'             => $this->title,
            'description'       => $this->description,
            'meta_description'  => $this->meta_description,
            'meta_tags'         => strtolower($this->meta_tags),
            'updated_by' => Auth::user()->name,
        ]);

        if($this->article){
            if (isset($this->thumbnail_path)) {
                Storage::deleteDirectory('public/articles/'.$this->article->id);
                $ext = $this->thumbnail_path->getClientOriginalExtension();
                $code = Str::uuid();
                $new_name = $code . '.' . $ext;
                $this->thumbnail_path->storeAs('public/articles/'.$this->article->id, $new_name);
                $this->article->thumbnail_path = $code;
                $this->article->save();

                //criar imagem em WEBP
                $thumbWebp = Image::make('storage/articles/'.$this->article->id.'/'.$new_name);
                $thumbWebp->encode('webp', 95);
                $thumbWebp->save('storage/articles/'.$this->article->id.'/'. $code . '.webp');
            }

            ArticleCategoriesArticles::where('articles_id',$this->article->id)->delete();
            foreach ($this->article_categories as $key => $value) {
                ArticleCategoriesArticles::create([
                    'user_id'              => Auth::user()->id,
                    'articles_id'          => $this->article->id,
                    'article_categories_id'=> $value,
                ]);
            }

        }

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
    public function sendThumb($url_temp, $name)
    {
        dd($url_temp);
    }

    public function excluirThumb()
    {
        $this->article->thumbnail_path = '';
        $this->article->save();
        Storage::deleteDirectory('public/articles/'.$this->article->id);
        $this->thumbnail = $this->article->thumbnail_path;
    }
}
