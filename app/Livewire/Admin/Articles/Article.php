<?php

namespace App\Livewire\Admin\Articles;


use Livewire\Attributes\Url;

use App\Models\Admin\Articles\Articles;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Article extends Component
{
    use WithPagination;

    // public Articles $articles;
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

    public $search = '';

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

        return view('livewire.admin.articles.article', [
            'articles' => Articles::search($this->search)->paginate(10),
        ]);
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
        redirect()->route('articles.new');
    }
    public function store()
    {
        $this->rules = [
            'title' => 'required|unique:articles',
        ];
        $this->validate();

        Articles::create([
            'title'     => $this->title,
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
            $data = Articles::find($id);

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
    public function showModalUpdate(Articles $articles)
    {
        redirect()->route('articles.update',[$articles->slug]);
    }
    public function update()
    {
        $this->rules = [
            'title' => 'required',
        ];

        $this->validate();


        Articles::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title'     => $this->title,
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
        $data = Articles::find($id);
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
