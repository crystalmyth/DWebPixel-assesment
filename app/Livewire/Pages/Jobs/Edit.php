<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPosting;
use App\Models\Skill;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Edit extends Component
{
    use WithFileUploads;
    
    public JobPosting $jobPosting;
    public string $title = '';
    public string $description = '';
    public string $company_name = '';
    public ?string $company_logo = null;
    public ?string $experience = null;
    public ?string $salary = null;
    public ?string $location = null;
    public ?string $extra = null;
    public Array $selectedSkills = [];
    public Collection $allSkills;

    public ?UploadedFile $newCompanyLogo = null;

    public function mount(JobPosting $jobPosting): void {
        $this->allSkills = Skill::all();

        $this->title = $jobPosting->title;
        $this->description = $jobPosting->description;
        $this->company_name = $jobPosting->company_name;
        $this->experience = $jobPosting->experience;
        $this->salary = $jobPosting->salary;
        $this->location = $jobPosting->location;
        $this->extra = implode(", ", json_decode($jobPosting->extra));
        $this->selectedSkills = $jobPosting->skills()->pluck('skill_id')->toArray();
        $this->company_logo = $jobPosting->company_logo;
    }

    public function updated($propertyName): void {
        $this->validateOnly($propertyName, [
            'title' => 'required|string|max:255|unique:job_postings,id,'. $this->jobPosting->id,
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'selectedSkills' => 'nullable|array',
            'selectedSkills.*' => 'exists:skills,id',
            'newCompanyLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    }

    public function updateJob()
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:job_postings,id,'. $this->jobPosting->id,
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'selectedSkills' => 'nullable|array',
            'selectedSkills.*' => 'exists:skills,id',
            'newCompanyLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $extras = [];
        if($this->extra) {
            $extras = array_map('trim', explode(',', $this->extra));
        }

        $logoPath = $this->jobPosting->company_logo;

        if ($this->newCompanyLogo) {
            if ($this->jobPosting->company_logo && Storage::exists($this->jobPosting->company_logo)) {
                Storage::delete($this->jobPosting->company_logo);
            }

            $logoPath = $this->newCompanyLogo->store('logos', 'public');
        }

        $this->jobPosting->update([
            'title' => $this->title,
            'description' => $this->description,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra' => json_encode($extras)
        ]);

        $this->jobPosting->skills()->sync($this->selectedSkills);
        $this->reset();
        return redirect()->route('admin.jobs.index')->with(['message' => 'Job posting updated successfully!']);
    }

    public function render()
    {
        return view('livewire.pages.jobs.edit', [
            'skills' => $this->allSkills
        ]);
    }
}
