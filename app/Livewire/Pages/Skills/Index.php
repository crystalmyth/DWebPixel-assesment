<?php

namespace App\Livewire\Pages\Skills;

use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $headers = ['Name'];
    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public ?Skill $skillToDelete = null;
    public bool $confirmingDelete = false;

    public ?Skill $editingSkill = null;
    public string $name = '';

    protected function getListeners()
    {
        return [
            'delete' => 'deleteSkill',
            'cancelDelete',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function addNewSkill():void
    {
        $this->editingSkill = null;
        $this->name = '';
    }

    public function createSkill(): void
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:skills,name',
        ]);

        Skill::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->dispatch('notify', 'Skill created successfully!', 'success');
    }

    public function editSkill(Skill $skill):void
    {
        $this->editingSkill = $skill;
        $this->name = $skill->name;
    }

    public function updateSkill():void
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $this->editingSkill->id,
        ]);

        $this->editingSkill->update([
            'name' => $this->name,
        ]);

        $this->editingSkill = null;
        $this->name = '';
        $this->dispatch('notify', 'Skill updated successfully!', 'success');
    }

    public function confirmDelete(Skill $skill)
    {
        $this->skillToDelete = $skill;
        $this->confirmingDelete = true;
        $this->dispatch('showDeleteModal', ['itemName' => $skill->name]);
    }

    public function deleteSkill()
    {
        if ($this->skillToDelete) {
            $this->skillToDelete->delete();
            $this->confirmingDelete = false;
            $this->skillToDelete = null;
            $this->dispatch('notify', 'Skill deleted successfully!', 'success');
        }
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->skillToDelete = null;
    }

    public function render()
    {
        $skills = Skill::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.pages.skills.index', [
            'skills' => $skills
        ]);
    }
}
