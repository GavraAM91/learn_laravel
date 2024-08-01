<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">
        <div class="mx-auto max-w-screen-md sm:text-center">
            <div class="max-w-2xl px-2 py-4 mx-auto lg:py-15">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @dd($post->id); --}}
                <form action="{{ route('blog.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- The rest of your form fields -->
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="title" required="" value="{{ $post->title }}">
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="category_id"
                                class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <select id="category_id" name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="{{ $post->category['id'] }}">{{ $post->category['name'] }}</option>
                                <option value="1">Web design</option>
                                <option value="2">UI/UX</option>
                                <option value="3">Machine Learning</option>
                                <option value="4">Data Structures</option>
                                <option value="5">Ai Design</option>
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Body</label>
                            <textarea id="body" name="body" rows="6"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Write a body here...">{{ $post->body }}</textarea>
                            @error('body')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white">
                            Save
                        </button>
                        <a href="{{ route('blog.index') }}">
                            <button type="button"
                                class="flex items-center justify-center text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-400 dark:hover:bg-red-500 focus:outline-none dark:focus:ring-red-500">
                                    Cancel
                            </button>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layout>
