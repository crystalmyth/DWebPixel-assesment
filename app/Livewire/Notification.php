<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $show = false;
    public $message = '';
    public $type = 'success';

    protected $listeners = ['notify'];

    public function mount():void
    {
        if(session()->has('message')) {
            $this->message = session()->get('message');
            $this->type = session()->get('type') ?? 'success';
            $this->show = true;
            $this->dispatch('hide-notification')->to('notification');
        }
    }

    public function notify($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;
        $this->dispatch('hide-notification')->to('notification');
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
