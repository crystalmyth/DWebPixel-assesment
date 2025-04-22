<?php

namespace Database\Seeders;

use App\Models\JobPosting;
use App\Models\Skill;
use Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        $jobPostingsData = [
            [
                "id" => 1,
                "title" => "Sr. Full Stack Developer",
                "description" => "You will be responsible for designing, developing, and maintaining robust and scalable web applications from end to end. You must have a deep understanding of both frontend and backend development, thrives in a collaborative environment, and is passionate about delivering high-quality software solutions",
                "company_name" => "DWebPixel",
                "company_logo" => '',
                "experience" => "4-5 Yrs",
                "salary" => "4.5-8 Lacs PA",
                "location" => "Remote",
                "skills" => [
                    "Laravel",
                    "React",
                    "Vue",
                    "MySQL",
                ],
                "extra" => [
                    "Remote",
                    "Full-Time",
                ]
            ],
            [
                "id" => 2,
                "title" => "Sr. Frontend Developer",
                "description" => "You will leverage your expertise in modern frontend technologies and best practices to create exceptional user experiences.",
                "company_name" => "DWebPixel",
                "company_logo" => '',
                "experience" => "3-4 Yrs",
                "salary" => "2.5-4 Lacs PA",
                "location" => "Remote",
                "skills" => [
                    "React",
                    "Vue",
                ],
                "extra" => [
                    "Remote",
                    "Full-Time",
                ]
            ]
        ];


        JobPosting::truncate();
        Skill::truncate();
        DB::table('job_posting_skill')->truncate();

        $skillsMap = [];
        foreach (array_unique(Arr::flatten(Arr::pluck($jobPostingsData, 'skills'))) as $skillName) {
            $skill = Skill::create(['name' => $skillName]);
            $skillsMap[$skillName] = $skill->id;
        }

        foreach ($jobPostingsData as $jobData) {
            $job = JobPosting::create([
                'title' => $jobData['title'],
                'description' => $jobData['description'],
                'company_name' => $jobData['company_name'],
                'company_logo' => $jobData['company_logo'],
                'experience' => $jobData['experience'],
                'salary' => $jobData['salary'],
                'location' => $jobData['location'],
                'extra' => json_encode($jobData['extra']),
            ]);

            $skillIdsToAttach = [];
            foreach ($jobData['skills'] as $skillName) {
                if (isset($skillsMap[$skillName])) {
                    $skillIdsToAttach[] = $skillsMap[$skillName];
                }
            }
            $job->skills()->attach($skillIdsToAttach);
        }
    }
}