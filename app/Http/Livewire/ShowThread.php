<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Thread;

class ShowThread extends Component
{
    /** la busqueda de estas variables es implicita, es decir, que se hace automativamente
     * La consulta es http://localhost:8000/thread/195. SI no colocamos el tipo en la variable
     * es decir, si no colocamos Thread en $thread, simplemente el programa considerara que 
     * estamos pasando el valor 195, pero si colocamos la clase, se hara una busqueda instantanea
     * tomando 195 como el id
     */ 
    public Thread $thread;

    public $body = '';

    public function postReply()
    {
        //validate
        $this->validate(['body' => 'required']);

        //craate
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body
        ]);

        //refresh
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-thread');
    }
}
