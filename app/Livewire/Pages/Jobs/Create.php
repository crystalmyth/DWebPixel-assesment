<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPosting;
use App\Models\Skill;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $description = '';
    public string $company_name = '';
    public ?UploadedFile $company_logo = null;
    public ?string $experience = null;
    public ?string $salary = null;
    public ?string $location = null;
    public ?string $extra = null;
    public Collection $selectedSkills;
    public Collection $allSkills;

    public function mount(): void {
        $this->allSkills = Skill::all();
        $this->selectedSkills = collect();
    }

    public function updated($propertyName): void {
        $this->validateOnly($propertyName, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'experience' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'selectedSkills' => 'nullable|array',
            'selectedSkills.*' => 'exists:skills,id'
        ]);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'experience' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'selectedSkills' => 'nullable|array',
            'selectedSkills.*' => 'exists:skills,id',
        ]);

        $extras = [];
        if($this->extra) {
            $extras = array_map('trim', explode(',', $this->extra));
        }
        $logoPath = null;
        if ($this->company_logo) {
            $logoPath = $this->company_logo->store('logos', 'public');
        }

        $jobPosting = JobPosting::create([
            'title' => $this->title,
            'description' => $this->description,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra' => json_encode($extras)
        ]);

        $jobPosting->skills()->attach($this->selectedSkills);

        $this->reset();
        return redirect()->route('admin.jobs.index')->with(['message' => 'Job posting created successfully!']);
    }

    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'skills' => $this->allSkills
        ]);
    }
}
