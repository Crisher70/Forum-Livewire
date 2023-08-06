<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowReply extends Component
{

    use AuthorizesRequests;

    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;

    // Esto indica que el componente ShowReply está escuchando un evento llamado 'refresh'. 
    // Cuando este evento es emitido, el componente ejecutará la acción '$refresh'.
    // Si se cambia el nombre de $refresh, sigue funcionando
    public $listeners = ['refresh' => '$refresh'];

    //parecido a watch en vue. Si is_editing cambia de valor, se ejecuta lo que esta en la funcion
    // podemos pasar parametros para poder captar el cambio, es decir, se puede colocar updatedIsEditing($valor)
    public function updatedIsEditing()
    {
        $this->authorize('update', $this->reply);
        $this->is_creating = false;
        $this->body = $this->reply->body;
    }

    public function updatedIsCreating()
    {
        $this->is_editing = false;
        $this->body = '';
    }

    public function postChild()
    {
        if(!is_null($this->reply->reply_id)) return;
        //validate
        $this->validate(['body' => 'required']);

        //craate
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        //refresh
        $this->body = '';
        $this->is_creating = false;
        $this->emitSelf('refresh');
    }

    public function updateReply()
    {
        $this->authorize('update', $this->reply);
        //validate
        $this->validate(['body' => 'required']);

        //update
        $this->reply->update([
            'body' => $this->body
        ]);

        $this->is_editing = false;
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
