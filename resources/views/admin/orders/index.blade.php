<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8 md:py-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Orders</h1>
                <p class="text-gray-500 mt-1">View and manage customer orders.</p>
            </div>

            <a
                href="{{ route('admin.products.index') }}"
                class="bg-white border text-gray-800 px-5 py-3 rounded-lg font-semibold hover:bg-gray-50 text-center"
            >
                Manage Products
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mobile Cards --}}
        <div class="md:hidden space-y-4">
            @foreach ($orders as $order)
                @php
                    $statusClass = match($order->status) {
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'confirmed' => 'bg-blue-100 text-blue-700',
                        'delivered' => 'bg-green-100 text-green-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <div class="bg-white border rounded-xl p-4 shadow-sm">
                    <div class="flex justify-between items-start gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Order</p>
                            <h2 class="text-xl font-bold text-gray-900">
                                #{{ $order->id }}
                            </h2>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="mt-4 space-y-2 text-sm">
                        <p>
                            <span class="font-semibold text-gray-700">Customer:</span>
                            {{ $order->name }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-700">Phone:</span>
                            <span dir="ltr">{{ $order->phone }}</span>
                        </p>

                        <p class="break-words">
                            <span class="font-semibold text-gray-700">Address:</span>
                            {{ $order->address }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-700">Date:</span>
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="mt-4 flex items-center justify-between gap-4 border-t pt-4">
                        <div>
                            <p class="text-sm text-gray-500">Total</p>
                            <p class="text-xl font-bold text-gray-900">
                                ${{ number_format($order->total, 2) }}
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.orders.show', $order) }}"
                            class="bg-gray-900 text-white px-5 py-3 rounded-lg font-semibold hover:bg-gray-700"
                        >
                            View
                        </a>
                    </div>
                </div>
            @endforeach

            @if ($orders->isEmpty())
                <div class="bg-white border rounded-xl p-8 text-center text-gray-500">
                    No orders yet.
                </div>
            @endif
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block bg-white border rounded-xl overflow-x-auto">
            <table class="w-full min-w-[900px]">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-4">Order</th>
                        <th class="p-4">Customer Name</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Address</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Date</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-t">
                            <td class="p-4 font-semibold">
                                #{{ $order->id }}
                            </td>

                            <td class="p-4 font-medium">
                                {{ $order->name }}
                            </td>

                            <td class="p-4">
                                {{ $order->phone }}
                            </td>

                            <td class="p-4 max-w-xs truncate">
                                {{ $order->address }}
                            </td>

                            <td class="p-4 font-semibold">
                                ${{ number_format($order->total, 2) }}
                            </td>

                            <td class="p-4">
                                @php
                                    $statusClass = match($order->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'confirmed' => 'bg-blue-100 text-blue-700',
                                        'delivered' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-sm {{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="p-4 text-sm text-gray-600">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="p-4 text-right">
                                <a
                                    href="{{ route('admin.orders.show', $order) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold"
                                >
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if ($orders->isEmpty())
                        <tr>
                            <td colspan="8" class="p-8 text-center text-gray-500">
                                No orders yet.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>