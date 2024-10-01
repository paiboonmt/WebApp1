<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>View</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Payment</th>
                                <th>Vat 3%</th>
                                <th>Vat 7%</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $ticketReport as $item )
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <i class="btn btn-info fa-solid fa-magnifying-glass"></i>
                                    </td>
                                    <td class="text-right">{{ $item->ref_order_id }}</td>
                                    <td class="text-right">{{ $item->customer }}</td>
                                    <td class="text-right">{{ number_format($item->price,2) }}</td>
                                    <td class="text-right">{{ number_format($item->discount,2) }}</td>
                                    <td class="text-right">{{ $item->payment }}</td>
                                    <td class="text-right">{{ number_format($item->vat3,2)}}</td>
                                    <td class="text-right">{{ number_format($item->vat7,2) }}</td>
                                    <td class="text-right">{{ number_format($item->total,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
