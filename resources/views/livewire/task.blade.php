<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="w-full text-3xl text-black pb-6">Tasks</h1>
        <div class="w-full mt-1 ">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="mb-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task
                            title</label>
                        <input type="text" id="title" value="{{ old('title') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ex: Write Article" required name="title" wire:model="title">
                        @error('title')
                            <div class="bg-yellow-300 text-red-700">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due
                            Date</label>
                        <input type="date" id="due_date" value="{{ old('due_date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required name="due_date" wire:model="due_date">
                        @error('due_date')
                            <div class="bg-yellow-300 text-red-700">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="chooseCategory"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Category</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="chooseCategory" name="category_id" wire:model="category_id" required>
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="bg-yellow-300 text-red-700">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="assignedUser"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assigne to user</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="assignedUser" name="assigned_to_user_id" wire:model="assigned_to_user_id" required>
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to_user_id')
                            <div class="bg-yellow-300 text-red-700">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--  --}}
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-600" for="description">Description</label>
                    <textarea
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="message" name="description" wire:model="description" required>{{ old('description') }}</textarea>
                </div>
                <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded">Add
                    Task</button>
            </form>
        </div>
        @if (Session::has('message'))
            <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ Session::get('message') }}.</p>
            </div>
        @endif

        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> Tasks Records
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
                            Title</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Added by</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Assigned to</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $task->id }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $task->title }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $task->user->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $task->assignedUser->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded"
                                    type="button"
                                    onclick="location.href='{{ route('admin.categories.edit', $category->id) }}';">Edit</button>

                                {{-- <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"  onclick="location.href='{{ route('admin.categories.edit', $category->id) }}';">Edit</button> --}}
                                <form type="submit" method="POST" style="display: inline"
                                    action="{{ route('admin.tasks.destroy', $task->id) }}"
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
            {{ $tasks->links() }}
        </div>
    </main>
</div>
