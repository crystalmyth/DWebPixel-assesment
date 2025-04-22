<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mb-8">Update job posting</h1>
        </div>
        <form method="post" wire:submit.prevent="updateJob">
            <div class="grid grid-cols-3 gap-4">
                <!-- Job Details Card -->
                <div class="col-span-2 border rounded shadow p-4">
                    <h2 class="mb-6 font-bold text-md">Job Details</h2>
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" wire:model="title" id="title" class="w-full p-2 border rounded border-gray-300" placeholder="Job posting title">
                        @error('title')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea wire:model="description" id="description" class="w-full p-2 border rounded border-gray-300" placeholder="Job posting description"></textarea>
                        @error('description')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col">
                            <label for="experience" class="block text-gray-700 font-medium mb-2">Experience</label>
                            <input type="text" wire:model="experience" id="experience" class="w-full p-2 border rounded border-gray-300" placeholder="Job posting experience">
                            @error('experience')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="col">
                            <label for="description" class="block text-gray-700 font-medium mb-2">Salary</label>
                            <input type="text" wire:model="salary" id="salary" class="w-full p-2 border rounded border-gray-300" placeholder="Job posting salary">
                            @error('salary')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col">
                            <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
                            <input type="text" wire:model="location" id="location" class="w-full p-2 border rounded border-gray-300" placeholder="Job posting location">
                            @error('location')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="col">
                            <label for="extra" class="block text-gray-700 font-medium mb-2">Extra Info</label>
                            <input type="text" wire:model="extra" id="extra" class="w-full p-2 border rounded border-gray-300" placeholder="Job posting extra">
                            <span class="text-gray-500 text-xs mt-1">Please usse comma seperated values</span>
                            @error('extra')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <!-- Company Details Card -->
                    <div class="border rounded shadow p-4">
                        <h2 class="mb-6 font-bold text-md">Company Details</h2>
                        <div class="mb-4">
                            <label for="company_name" class="block text-gray-700 font-medium mb-2">Name</label>
                            <input type="text" wire:model="company_name" id="company_name" class="w-full p-2 border rounded border-gray-300" placeholder="Company name">
                            @error('company_name')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="newCompanyLogo" class="block text-gray-700 font-medium mb-2">Company Logo</label>
                            <input type="file" wire:model="newCompanyLogo" id="newCompanyLogo" class="w-full p-2 border rounded border-gray-300">
                            @error('newCompanyLogo')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            @if ($newCompanyLogo)
                                <div class="mt-2">
                                    <img src="{{ $newCompanyLogo->temporaryUrl() }}" alt="Company Logo Preview" class="max-w-full h-20 rounded">
                                </div>
                            @elseif ($company_logo)
                                <div class="mt-2">
                                    <p class="font-semibold">Current Logo:</p>
                                    <img src="{{ asset('storage/' . $company_logo) }}" alt="Company Logo" class="max-w-full h-20 rounded">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Skills Card -->
                    <div class="border rounded shadow p-4 mt-4">
                        <h2 class="mb-6 font-bold text-md">Skills</h2>
                        <div class="mb-4">
                            <select multiple wire:model="selectedSkills" id="skills" class="w-full p-2 border rounded border-gray-300">
                                @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}" {{ in_array($skill->id, $selectedSkills) ? 'selected' : '' }}>{{ $skill->name }}</option>
                                @endforeach
                            </select>
                            @error('skills')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4">Update</button>
        </form>
    </div>
</div>