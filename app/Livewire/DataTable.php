<?php

namespace App\Livewire;

use Livewire\Component;

class DataTable extends Component
{
    public array $headers = [];

    public function mount(array $headers = [])
    {
        $this->headers = $headers;
    }

    public function render()
    {
        return view('livewire.data-table');
    }
}
