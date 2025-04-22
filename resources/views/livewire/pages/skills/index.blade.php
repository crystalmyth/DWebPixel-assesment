<div>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-4">
            <div class="col-span-2">
                <x-data-table :headers="$headers">
                @foreach ($skills as $skill)
                    <tr>
                        <td class="px-4 py-2">{{ $skill->name }}</td>
                        <td class="px-4 py-2 grid grid-cols-2 justify-end items-center gap-2">
                            <button class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-green-500" wire:click.prevent="editSkill({{ $skill }})">Edit</button>
                            <button class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-red-500" wire:click.prevent="confirmDelete({{ $skill }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </x-data-table>
            </div>
            <div class="col-span-1">
                @if ($editingSkill)
                    <form wire:submit.prevent="updateSkill" class="shadow border p-4 rounded">
                @else
                    <form wire:submit.prevent="createSkill" class="shadow border p-4 rounded">
                @endif
                    <h2 class="font-bold text-md mb-4">{{ $editingSkill ? 'Update Skill' : 'Add New Skill' }}</h2>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" wire:model="name" id="name" class="w-full p-2 border rounded border-gray-300">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">{{ $editingSkill ? 'Update' : 'Save' }}</button>
                </form>
            </div>
        </div>
    </div>
    <livewire:delete-modal />
</div>
