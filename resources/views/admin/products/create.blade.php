<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8 md:py-10">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold">Add Product</h1>
            <p class="text-gray-500 mt-1">Create a new product for your store.</p>
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
            action="{{ route('admin.products.store') }}"
            enctype="multipart/form-data"
            class="bg-white border rounded-xl p-4 md:p-6 space-y-5"
        >
            @csrf

            <div>
                <label class="block mb-1 font-medium">Category</label>
                <select
                    name="category_id"
                    class="w-full min-h-[46px] rounded border-gray-300"
                >
                    <option value="">No Category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Product Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full min-h-[46px] rounded border-gray-300"
                    required
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-1 font-medium">Price</label>
                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        value="{{ old('price') }}"
                        class="w-full min-h-[46px] rounded border-gray-300"
                        required
                    >
                </div>

                <div>
                    <label class="block mb-1 font-medium">Discount Price optional</label>
                    <input
                        type="number"
                        step="0.01"
                        name="discount_price"
                        value="{{ old('discount_price') }}"
                        class="w-full min-h-[46px] rounded border-gray-300"
                        placeholder="Leave empty if no discount"
                    >
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium">Stock</label>
                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    class="w-full min-h-[46px] rounded border-gray-300"
                    required
                >
            </div>

            <div>
                <label class="block mb-1 font-medium">Size Guide / Height & Suitable Weight</label>

                <textarea
                    name="size_guides_text"
                    rows="5"
                    class="w-full rounded border-gray-300"
                    placeholder="Example:
Height 155-160 cm | Suitable weight 45-55 kg
Height 160-165 cm | Suitable weight 55-65 kg
Height 165-170 cm | Suitable weight 65-75 kg"
                >{{ old('size_guides_text') }}</textarea>

                <p class="text-sm text-gray-500 mt-1">
                    Add one option per line. The customer will choose one before adding to cart.
                </p>
            </div>

            <div>
                <label class="block mb-1 font-medium">Main Image</label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full rounded border-gray-300 text-sm"
                >
            </div>

            <div>
                <label class="block mb-2 font-medium">Product Images</label>

                <input
                    type="file"
                    name="images[]"
                    multiple
                    accept="image/*"
                    class="w-full rounded border-gray-300 text-sm"
                >

                <p class="text-sm text-gray-500 mt-1">
                    You can select more than one image.
                </p>
            </div>

            <div>
                <label class="block mb-1 font-medium">Description</label>
                <textarea
                    name="description"
                    rows="5"
                    class="w-full rounded border-gray-300"
                >{{ old('description') }}</textarea>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-3 pt-2">
                <a
                    href="{{ route('admin.products.index') }}"
                    class="text-center text-gray-600 hover:text-gray-900 px-6 py-3"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="w-full sm:w-auto bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700"
                >
                    Save Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>