<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8 md:py-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Products</h1>
                <p class="text-gray-500 mt-1">Manage your store products.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="bg-white border text-gray-800 px-5 py-3 rounded-lg font-semibold hover:bg-gray-50 text-center"
                >
                    View Orders
                </a>

                <a
                    href="{{ route('admin.products.create') }}"
                    class="bg-gray-900 text-white px-5 py-3 rounded-lg font-semibold hover:bg-gray-700 text-center"
                >
                    Add Product
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mobile Cards --}}
        <div class="md:hidden space-y-4">
            @foreach ($products as $product)
                <div class="bg-white border rounded-xl p-4 shadow-sm">
                    <div class="flex gap-4">
                        <div class="w-24 h-28 bg-gray-100 rounded overflow-hidden shrink-0">
                            @if ($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-xs uppercase tracking-wide text-gray-500 mb-1">
                                {{ $product->category?->name ?? 'No Category' }}
                            </p>

                            <h2 class="font-bold text-lg text-gray-900 leading-tight break-words">
                                {{ $product->name }}
                            </h2>

                            <div class="mt-2">
                                @if ($product->hasDiscount())
                                    <div class="font-semibold text-red-600">
                                        ${{ number_format($product->discount_price, 2) }}
                                    </div>

                                    <div class="text-sm text-gray-400 line-through">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @else
                                    <div class="font-semibold text-gray-900">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-3">
                                @if ($product->isSoldOut())
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs bg-red-100 text-red-700 font-semibold">
                                        Sold Out
                                    </span>
                                @elseif ($product->isLowStock())
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800 font-semibold">
                                        Low: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                        {{ $product->stock }} in stock
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 border-t pt-4">
                        <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                            Size
                        </p>

                        @if ($product->size_guides && count($product->size_guides))
                            <div class="space-y-1">
                                @foreach ($product->size_guides as $guide)
                                    <div class="inline-block bg-gray-100 border text-gray-700 px-3 py-1 rounded text-xs leading-relaxed">
                                        {{ $guide }}
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span class="text-sm text-gray-400">
                                No size guide
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 flex gap-3">
                        <a
                            href="{{ route('admin.products.edit', $product) }}"
                            class="flex-1 text-center bg-blue-50 text-blue-700 px-4 py-3 rounded-lg font-semibold"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.products.destroy', $product) }}"
                            onsubmit="return confirm('Are you sure you want to delete this product?')"
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

            @if ($products->isEmpty())
                <div class="bg-white border rounded-xl p-8 text-center text-gray-500">
                    No products yet.
                </div>
            @endif
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border rounded-xl overflow-x-auto">
            <table class="w-full min-w-[980px]">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-4">Image</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Stock</th>
                        <th class="p-4">Size</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-t align-top">
                            <td class="p-4">
                                <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden">
                                    @if ($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                                            No Image
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="p-4">
                                {{ $product->category?->name ?? 'No Category' }}
                            </td>

                            <td class="p-4 font-medium">
                                {{ $product->name }}
                            </td>

                            <td class="p-4">
                                @if ($product->hasDiscount())
                                    <div class="font-semibold text-red-600">
                                        ${{ number_format($product->discount_price, 2) }}
                                    </div>

                                    <div class="text-sm text-gray-400 line-through">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </td>

                            <td class="p-4">
                                @if ($product->isSoldOut())
                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700 font-semibold">
                                        Sold Out
                                    </span>
                                @elseif ($product->isLowStock())
                                    <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800 font-semibold">
                                        Low: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        {{ $product->stock }} in stock
                                    </span>
                                @endif
                            </td>

                            <td class="p-4 max-w-[260px]">
                                @if ($product->size_guides && count($product->size_guides))
                                    <div class="space-y-1">
                                        @foreach ($product->size_guides as $guide)
                                            <div class="inline-block bg-gray-100 border text-gray-700 px-3 py-1 rounded text-xs leading-relaxed">
                                                {{ $guide }}
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400">
                                        No size guide
                                    </span>
                                @endif
                            </td>

                            <td class="p-4">
                                <div class="flex justify-end gap-3">
                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="text-blue-600 hover:text-blue-800 font-semibold"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')"
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

                    @if ($products->isEmpty())
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-500">
                                No products yet.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>