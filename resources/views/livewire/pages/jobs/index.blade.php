<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center py-8">
            <h1 class="text-2xl font-bold">Jobs</h1>
        </div>
        <div class="w-full">
            <!-- Start coding here -->
            <x-data-table :headers="$headers">
                @foreach ($jobs as $job)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">{{ $job['title'] }}</th>
                    <td class="px-4 py-3 whitespace-nowrap">{{ str($job['description']) }}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($job['company_logo'])
                        <img src="{{ $job['company_logo'] }}" class="h-12 w-auto block mx-auto" alt="{{ $job['company_name'] }}">
                        @else
                        No Logo
                        @endif
                    </td>
                    <td><span class="font-medium text-gray-900">{{ $job['company_name'] }}</span></td>
                    <td class="px-4 py-3">{{ $job['experience'] }}</td>
                    <td class="px-4 py-3">{{ $job['salary'] }}</td>
                    <td class="px-4 py-3">{{ $job['location'] }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center flex-wrap gap-2">
                            @foreach ($job['skills'] as $skill)
                            <span class="inline-block bg-gray-200 rounded-full px-2 py-0.5 text-xs font-medium text-gray-700">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center flex-wrap gap-2">
                            @foreach ($job['extra'] as $extra)
                            <span class="inline-block bg-amber-100 rounded-full px-2 py-0.5 text-xs font-medium text-amber-800">{{ $extra }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <a href="{{ route('admin.jobs.edit', ['jobPosting' => $job]) }}" class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-green-500">Edit</a>
                        <button type="button" wire:click="confirmDelete({{ $job }})" class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-red-500">Delete</button>
                    </td>
                </tr>
                @endforeach
            </x-data-table>
        </div>
    </div>
    <livewire:delete-modal />
</div>