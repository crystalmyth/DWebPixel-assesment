<?php

namespace App\Livewire;

use Livewire\Component;

class DeleteModal extends Component
{
    public $showModal = false;
    public $itemName = 'item';
    public $confirmMethod = 'delete';
    public $cancelMethod = 'cancelDelete';

    protected $listeners = ['showDeleteModal'];

    public function showDeleteModal($params)
    {
        $this->itemName = $params['itemName'] ?? 'item';
        $this->showModal = true;
    }

    public function callCancelCallback()
    {
        $this->dispatch($this->cancelMethod);
        $this->showModal = false;
    }
    
    public function callConfirmCallBack()
    {
        $this->dispatch($this->confirmMethod);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }
}
