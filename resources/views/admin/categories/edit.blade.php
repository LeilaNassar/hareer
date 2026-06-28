<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8 md:py-10">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold">Edit Category</h1>
            <p class="text-gray-500 mt-1">Update category name and shop-page description.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form 
            method="POST" 
            action="{{ route('admin.categories.update', $category) }}"
            class="bg-white border rounded-xl p-4 md:p-6 space-y-5"
        >
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium">Category Name</label>

                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $category->name) }}"
                    class="w-full min-h-[46px] rounded border-gray-300"
                    required
                >
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-[#2f2a26]">
                    Category Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    placeholder="Example: Graceful abayas selected for elegance, comfort, and timeless modest style."
                    class="w-full rounded-2xl border-[#d8cbb8] bg-[#fffdf9] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                >{{ old('description', $category->description ?? '') }}</textarea>

                <p class="mt-2 text-xs text-[#7a7268]">
                    This text will appear on the shop page when customers filter by this category.
                </p>
            </div>

            <div>
                <label class="block mb-1 font-medium">Slug</label>

                <input 
                    type="text" 
                    value="{{ $category->slug }}"
                    class="w-full min-h-[46px] rounded border-gray-300 bg-gray-100"
                    disabled
                >

                <p class="text-sm text-gray-500 mt-1">
                    Slug updates automatically when you change the category name.
                </p>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-3 pt-2">
                <a 
                    href="{{ route('admin.categories.index') }}"
                    class="text-center text-gray-600 hover:text-gray-900 px-6 py-3"
                >
                    Cancel
                </a>

                <button 
                    type="submit"
                    class="w-full sm:w-auto bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700"
                >
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-app-layout>