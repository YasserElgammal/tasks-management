<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="w-full text-3xl text-black pb-6">Categories</h1>
        <div class="w-full mt-1 ">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                <div class="grid mb-6 md:grid-cols-2 ">
                    <div class="mb-1">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                            Name</label>
                        <input type="text" wire:model="name" name="name" id="name"
                            value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ex: Laravel" required>
                        @error('name')
                            <div class="bg-yellow-300 text-red-700">{{ $message }}</div>
                        @enderror
                        <button class="px-4  mt-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded">Add
                            Category</button>
                    </div>
                    {{--  --}}
                </div>
            </form>
        </div>

        <x-session-message />

        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Categories Records
        </p>
        {{-- <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2" onclick="location.href='{{ route('admin.categories.create') }}';">Add Category</button> --}}
        <div class="bg-white overflow-auto">
            <table class="text-left w-full border-collapse">
                <thead>
                    <tr>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            ID</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Name</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Added by</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $category->id }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $category->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $category->user->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"  onclick="location.href='{{ route('admin.categories.edit', $category->id) }}';">Edit</button>

                                {{-- <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"  onclick="location.href='{{ route('admin.categories.edit', $category->id) }}';">Edit</button> --}}
                                <form type="submit" method="POST" style="display: inline"
                                    action="{{ route('admin.categories.destroy', $category->id) }}"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-red-600 rounded"
                                        type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </main>
</div>
