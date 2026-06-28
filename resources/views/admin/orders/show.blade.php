<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8 md:py-10">
        <a
            href="{{ route('admin.orders.index') }}"
            class="text-gray-600 hover:text-gray-900"
        >
            ← Back to orders
        </a>

        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5 mt-6 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold leading-tight">
                    Order #{{ $order->id }} - {{ $order->name }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Created at {{ $order->created_at->format('d M Y, h:i A') }}
                </p>
            </div>

            <form
                method="POST"
                action="{{ route('admin.orders.updateStatus', $order) }}"
                class="flex flex-col sm:flex-row gap-2 w-full md:w-auto"
            >
                @csrf
                @method('PATCH')

                <select name="status" class="w-full sm:w-auto min-h-[46px] rounded border-gray-300">
                    <option value="pending" @selected($order->status === 'pending')>Pending</option>
                    <option value="confirmed" @selected($order->status === 'confirmed')>Confirmed</option>
                    <option value="delivered" @selected($order->status === 'delivered')>Delivered</option>
                    <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                </select>

                <button
                    type="submit"
                    class="w-full sm:w-auto bg-gray-900 text-white px-4 py-3 rounded font-semibold hover:bg-gray-700"
                >
                    Update
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white border rounded-xl p-5 md:p-6">
                <h2 class="text-xl font-semibold mb-4">Customer Info</h2>

                <div class="space-y-3 text-sm md:text-base">
                    <p class="break-words">
                        <strong>Name:</strong> {{ $order->name }}
                    </p>

                    <p class="break-words">
                        <strong>Phone:</strong> <span dir="ltr">{{ $order->phone }}</span>
                    </p>

                    <a
                        href="https://wa.me/961{{ ltrim($order->phone, '0') }}"
                        target="_blank"
                        class="inline-block bg-green-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-700"
                    >
                        Message on WhatsApp
                    </a>

                    <p class="break-words">
                        <strong>Address:</strong> {{ $order->address }}
                    </p>

                    @if ($order->notes)
                        <p class="break-words">
                            <strong>Notes:</strong> {{ $order->notes }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="bg-white border rounded-xl p-5 md:p-6">
                <h2 class="text-xl font-semibold mb-4">Order Info</h2>

                @php
                    $statusClass = match($order->status) {
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'confirmed' => 'bg-blue-100 text-blue-700',
                        'delivered' => 'bg-green-100 text-green-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <div class="space-y-3 text-sm md:text-base">
                    <p>
                        <strong>Status:</strong>
                        <span class="inline-flex px-3 py-1 rounded-full text-sm {{ $statusClass }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    <p>
                        <strong>Total:</strong>
                        <span class="font-bold">${{ number_format($order->total, 2) }}</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Mobile Items --}}
        <div class="md:hidden space-y-4">
            <h2 class="text-xl font-bold">Order Items</h2>

            @foreach ($order->items as $item)
                <div class="bg-white border rounded-xl p-4 shadow-sm">
                    <h3 class="font-bold text-lg text-gray-900 leading-tight">
                        {{ $item->product_name }}
                    </h3>

                    <div class="mt-3">
                        <p class="text-xs uppercase tracking-wide text-gray-500 mb-1">
                            Size Guide
                        </p>

                        @if ($item->selected_size)
                            <span class="inline-block bg-gray-100 border px-3 py-2 rounded text-sm text-gray-700 leading-relaxed">
                                {{ $item->selected_size }}
                            </span>
                        @else
                            <span class="text-gray-400 text-sm">
                                No size selected
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 grid grid-cols-3 gap-3 text-sm border-t pt-4">
                        <div>
                            <p class="text-gray-500">Price</p>
                            <p class="font-semibold">${{ number_format($item->price, 2) }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Qty</p>
                            <p class="font-semibold">{{ $item->quantity }}</p>
                        </div>

                        <div class="text-right">
                            <p class="text-gray-500">Subtotal</p>
                            <p class="font-bold">${{ number_format($item->subtotal, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="bg-gray-50 border rounded-xl p-4 flex justify-between items-center">
                <span class="font-bold">Total</span>
                <span class="font-bold text-xl">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border rounded-xl overflow-x-auto">
            <table class="w-full min-w-[760px]">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-4">Product</th>
                        <th class="p-4">Size Guide</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Quantity</th>
                        <th class="p-4 text-right">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-t">
                            <td class="p-4 font-medium">
                                {{ $item->product_name }}
                            </td>

                            <td class="p-4">
                                @if ($item->selected_size)
                                    <span class="inline-block bg-gray-100 border px-3 py-2 rounded text-sm text-gray-700">
                                        {{ $item->selected_size }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">
                                        No size selected
                                    </span>
                                @endif
                            </td>

                            <td class="p-4">
                                ${{ number_format($item->price, 2) }}
                            </td>

                            <td class="p-4">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-4 text-right font-semibold">
                                ${{ number_format($item->subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="4" class="p-4 text-right font-bold">Total</td>
                        <td class="p-4 text-right font-bold">
                            ${{ number_format($order->total, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>