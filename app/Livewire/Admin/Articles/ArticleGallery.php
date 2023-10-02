<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Admin\Articles\ArticleGalleries;
use App\Models\Admin\Articles\Articles;
use Livewire\Component;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticleGallery extends Component
{
    use WithFileUploads;

    public $article;
    public $image_path;
    public $images;
    public $model_id;

    public function mount(Articles $articles)
    {
        $this->article          = $articles;
        $this->model_id         = $articles->id;
        $this->images           = $articles->images;
    }
    public function render()
    {
        return view('livewire.admin.articles.article-gallery', [
            'article' => $this->article
        ]);
    }
    public function uploadGallery()
    {
        $ext = $this->image_path->getClientOriginalExtension();
        $code = Str::uuid();
        $new_name = $code . '.' . $ext;
        $this->image_path->storeAs('public/articles/' . $this->article->id, $new_name);

        $gallery = ArticleGalleries::create([
            'articles_id'   => $this->article->id,
            'image_path'    => $code,
            'image_name'    => $new_name,
        ]);

        $highlights = $this->article->images->where('highlight',1)->count();
        if($highlights == 0){
            $gallery->highlight = 1;
            $gallery->save();
        }

        //criar imagem em WEBP
        $thumbWebp = Image::make('storage/articles/' . $this->article->id . '/' . $new_name);
        $thumbWebp->encode('webp', 95);
        $thumbWebp->save('storage/articles/' . $this->article->id . '/' . $code . '.webp');

        $this->images           = $this->article->images;
        $this->image_path = '';

        $this->openAlert('success', 'Imagem inserida com sucesso.');
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
    public function excluirTemp()
    {
        $this->image_path = '';
    }
    public function deleteImage(ArticleGalleries $articleGalleries)
    {
        if ($articleGalleries->highlight == 1) {
            $gallery = ArticleGalleries::where('articles_id',$this->article->id)
            ->where('id','!=',$articleGalleries->id)->first();
            if ($gallery) {
                $gallery->highlight = 1;
                $gallery->save();
            }
        }

        $articleGalleries->delete();
        Storage::delete('public/articles/'.$this->article->id.'/' . $articleGalleries->image_path . '.webp');
        Storage::delete('public/articles/'.$this->article->id.'/' . $articleGalleries->image_name);
        $this->images           = $this->article->images;

        $this->openAlert('success', 'Excluída criado com sucesso.');
    }
    public function highlight(ArticleGalleries $articleGalleries)
    {
        $articleGalleries->highlight = 1;
        $articleGalleries->save();

        $galleries = ArticleGalleries::where('articles_id',$this->article->id)
        ->where('id','!=',$articleGalleries->id)->get();
        foreach ($galleries as $gallery) {
            $gallery->highlight = 0;
            $gallery->save();
        }
        $this->images           = $this->article->images;
    }
}
