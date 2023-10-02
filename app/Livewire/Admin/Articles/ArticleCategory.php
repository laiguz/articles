<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Admin\Articles\ArticleCategories;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleCategory extends Component
{
    use WithPagination;

    public ArticleCategories $articleCategories;
    public $showJetModal = false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $alertSession = false;
    public $rules;
    public $detail;

    public $model_id;
    public $registerId;
    public $active = 1;
    public $title;
    public $media;
    public $link;

    protected $listeners =
    [
        'showModalCreate',
        'showModalRead',
        'showModalUpdate',
        'showModalDelete'
    ];

    public function render()
    {
        if (Gate::allows('profile-user')) {
            abort(403);
        }
        return view('livewire.admin.articles.article-category');
    }
    public function resetAll()
    {
        $this->reset(
            'title',
        );
    }

    //CREATE
    public function showModalCreate()
    {
        $this->resetAll();
        $this->showModalCreate = true;
    }
    public function store()
    {
        $this->rules = [
            'title' => 'required|unique:article_categories',
        ];
        $this->validate();

        ArticleCategories::create([
            'title'     => mb_strtoupper($this->title),
            'created_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro criado com sucesso.');

        $this->showModalCreate = false;
        $this->resetAll();
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;

        if (isset($id)) {
            $data = ArticleCategories::find($id);

            $this->detail = [
                'Criada'            => $data->created,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
            ];
        } else {
            $this->detail = '';
        }
    }
    //UPDATE
    public function showModalUpdate(ArticleCategories $articleCategories)
    {
        $this->resetAll();

        $this->model_id     = $articleCategories->id;
        $this->title        = $articleCategories->title;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'title' => 'required',
        ];

        $this->validate();


        ArticleCategories::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title'     => mb_strtoupper($this->title),
            'updated_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');

        $this->showModalEdit = false;
        $this->resetAll();
    }
    //DELETE
    public function showModalDelete($id)
    {
        $this->showJetModal = true;
        if (isset($id)) {
            $this->registerId = $id;
        } else {
            $this->registerId = '';
        }
    }
    public function delete($id)
    {
        $data = ArticleCategories::find($id);
        $data->delete();

        $this->openAlert('success', 'Registro excluido com sucesso.');

        $this->showJetModal = false;
        $this->resetAll();
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
