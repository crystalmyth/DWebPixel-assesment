<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPosting;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public array $headers = ['Title', 'Description', 'Company Logo', 'Company Name', 'Experience', 'Salary', 'Location', 'Skills', 'Extra'];
    public string $search = '';
    public string $sortBy = 'name';
    public string $sortDirection = 'asc';
    public int $perPage = 10;

    public ?JobPosting $jobToDelete = null;
    public bool $confirmingDelete = false;

    protected function getListeners()
    {
        return [
            'delete' => 'deleteJobPosting',
            'cancelDelete',
        ];
    }

    public function mount():void
    {
        if(session()->has('message')) {
            $this->dispatch('notify', session()->get('message'),'success');   
        }
    }

    public function confirmDelete(JobPosting $job)
    {
        $this->jobToDelete = $job;
        $this->confirmingDelete = true;
        $this->dispatch('showDeleteModal', ['itemName' => $job->title]);
    }

    public function deleteJobPosting()
    {
        if ($this->jobToDelete) {
            $this->jobToDelete->delete();
            $this->confirmingDelete = false;
            $this->jobToDelete = null;
            $this->dispatch('notify', 'Job Posting deleted successfully!', 'success');
        }
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->jobToDelete = null;
    }

    public function render()
    {
        $jobs = JobPosting::query()
            ->with('skills')
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage)
            ->each(function ($job) {
                $job->extra = json_decode($job->extra, true);
                $job->skills = $job->skills->pluck('name')->toArray();
                $job->description = str($job->description)->words(3);
                if ($job->company_logo) {
                    $job->company_logo = asset('storage/' . $job->company_logo);
                } else {
                    $job->company_logo = null;
                }
            });
        
        return view('livewire.pages.jobs.index', [
            'jobs' => $jobs
        ]);
    }
}
