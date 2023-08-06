<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reply;

class ShowReply extends Component
{
    public Reply $reply;
    public $body = '';
    public $is_creating = false;

    // Esto indica que el componente ShowReply está escuchando un evento llamado 'refresh'. 
    // Cuando este evento es emitido, el componente ejecutará la acción '$refresh'.
    // Si se cambia el nombre de $refresh, sigue funcionando
    public $listeners = ['refresh' => '$refresh'];

    public function postChild()
    {
        if(!is_null($this->reply->reply_id)) return;
        //dd('llego', $this->reply, $this->body,$this->reply->thread->id );
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

    public function render()
    {
        return view('livewire.show-reply');
    }
}
