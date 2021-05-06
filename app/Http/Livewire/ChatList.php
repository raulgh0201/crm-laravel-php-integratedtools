<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatList extends Component
{
    public $mensajes;
    protected $listeners = ["Mensaje recibido"];


    public function render()
    {
        return view('livewire.chat-list');
    }
}
