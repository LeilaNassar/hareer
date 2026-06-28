<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8 md:py-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Categories</h1>
                <p class="text-gray-500 mt-1">Manage product categories.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a 
                    href="{{ route('admin.products.index') }}"
                    class="bg-white border text-gray-800 px-5 py-3 rounded-lg font-semibold hover:bg-gray-50 text-center"
                >
                    Products
                </a>

                <a 
                    href="{{ route('admin.categories.create') }}"
                    class="bg-gray-900 text-white px-5 py-3 rounded-lg font-semibold hover:bg-gray-700 text-center"
                >
                    Add Category
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Mobile Cards --}}
        <div class="md:hidden space-y-4">
            @foreach ($categories as $category)
                <div class="bg-white border rounded-xl p-4 shadow-sm">
                    <div class="flex justify-between items-start gap-4">
                        <div class="min-w-0">
                            <h2 class="text-lg font-bold text-gray-900 break-words">
                                {{ $category->name }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1 break-words">
                                /{{ $category->slug }}
                            </p>
                        </div>

                        <span class="shrink-0 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $category->products_count }} products
                        </span>
                    </div>

                    @if ($category->description)
                        <p class="mt-4 text-sm text-gray-600 leading-relaxed break-words">
                            {{ $category->description }}
                        </p>
                    @endif

                    <div class="mt-4 flex gap-3 border-t pt-4">
                        <a 
                            href="{{ route('admin.categories.edit', $category) }}"
                            class="flex-1 text-center bg-blue-50 text-blue-700 px-4 py-3 rounded-lg font-semibold"
                        >
                            Edit
                        </a>

                        <form 
                            method="POST" 
                            action="{{ route('admin.categories.destroy', $category) }}"
                            onsubmit="return confirm('Are you sure you want to delete this category?')"
                            class="flex-1"
                        >
                            @csrf
                            @method('DELETE')

                            <button 
                                type="submit"
                                class="w-full bg-red-50 text-red-700 px-4 py-3 rounded-lg font-semibold"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            @if ($categories->isEmpty())
                <div class="bg-white border rounded-xl p-8 text-center text-gray-500">
                    No categories yet.
                </div>
            @endif
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border rounded-xl overflow-x-auto">
            <table class="w-full min-w-[760px]">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-4">Name</th>
                        <th class="p-4">Slug</th>
                        <th class="p-4">Products</th>
                        <th class="p-4">Description</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-t align-top">
                            <td class="p-4 font-medium">
                                {{ $category->name }}
                            </td>

                            <td class="p-4 text-gray-600">
                                {{ $category->slug }}
                            </td>

                            <td class="p-4">
                                {{ $category->products_count }}
                            </td>

                            <td class="p-4 max-w-sm text-gray-600">
                                @if ($category->description)
                                    <span class="line-clamp-2">
                                        {{ $category->description }}
                                    </span>
                                @else
                                    <span class="text-gray-400">
                                        No description
                                    </span>
                                @endif
                            </td>

                            <td class="p-4">
                                <div class="flex justify-end gap-3">
                                    <a 
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="text-blue-600 hover:text-blue-800 font-semibold"
                                    >
                                        Edit
                                    </a>

                                    <form 
                                        method="POST" 
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button 
                                            type="submit"
                                            class="text-red-600 hover:text-red-800 font-semibold"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($categories->isEmpty())
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                No categories yet.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>