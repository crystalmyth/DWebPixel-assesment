<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $query = JobPosting::with('skills')->latest();

        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('company_name', 'like', "%{$searchTerm}%")
                  ->orWhereHas('skills', function ($skillQuery) use ($searchTerm) {
                      $skillQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        if ($request->has('location') && !empty($request->input('location'))) {
            $location = $request->input('location');
            $query->where('location', 'like', "%{$location}%");
        }

        $jobPostings = $query->get()->map(function ($job) use ($now) {
            $createdAt = Carbon::parse($job->created_at);
            $diffInSeconds = $createdAt->diffInSeconds($now);

            return [
                'id' => $job->id,
                'title' => $job->title,
                'description' => $job->description,
                'company_name' => $job->company_name,
                'company_logo' => $job->company_logo,
                'experience' => $job->experience,
                'salary' => $job->salary,
                'location' => $job->location,
                'skills' => $job->skills->pluck('name'),
                'extra' => json_decode($job->extra),
                'created_ago' => $this->createdAgo($diffInSeconds)
            ];
        });
        return Inertia::render('Dashboard',  [
            'jobPostings' => $jobPostings
        ]);
    }

    protected function createdAgo($diffInSeconds) {
        $ago = '';
        if ($diffInSeconds < 60) {
            $ago = 'less than a minute ago';
        } elseif ($diffInSeconds < 3600) {
            $ago = floor($diffInSeconds / 60) . ' minute' . (floor($diffInSeconds / 60) > 1 ? 's' : '') . ' ago';
        } elseif ($diffInSeconds < 86400) {
            $ago = floor($diffInSeconds / 3600) . ' hour' . (floor($diffInSeconds / 3600) > 1 ? 's' : '') . ' ago';
        } elseif ($diffInSeconds < 2592000) {
            $ago = floor($diffInSeconds / 86400) . ' day' . (floor($diffInSeconds / 86400) > 1 ? 's' : '') . ' ago';
        } elseif ($diffInSeconds < 31536000) {
            $ago = floor($diffInSeconds / 2592000) . ' month' . (floor($diffInSeconds / 2592000) > 1 ? 's' : '') . ' ago';
        } else {
            $ago = floor($diffInSeconds / 31536000) . ' year' . (floor($diffInSeconds / 31536000) > 1 ? 's' : '') . ' ago';
        }
        return $ago;
    }
}
