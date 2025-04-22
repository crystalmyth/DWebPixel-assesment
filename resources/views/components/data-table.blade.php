<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($headers as $header)
                    <th scope="col" class="px-4 py-3">{{ $header }}</th>
                    @endforeach
                    <th scope="col" class="px-4 py-3 w-40 min-w-40">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>