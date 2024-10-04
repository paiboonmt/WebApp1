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
                                {{-- <th>Customer</th> --}}
                                <th>Product</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Payment</th>
                                <th>Vat</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $ticketReport as $item )
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('viewBill',$item->id) }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    </td>
                                    <td>{{ $item->ref_order_id }}</td>
                                    {{-- <td>{{ $item->customer }}</td> --}}
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ number_format($item->price,2) }}</td>
                                    <td>{{ $item->discount_value .' %' . ' / ' . number_format($item->discount,2) }}</td>
                                    <td>{{ $item->payment }}</td>
                                    @if ($item->vat3 != 0 && $item->vat7 != 0)

                                        <td>{{  number_format($item->vat3_value,2) . ' / ' . number_format($item->vat7_value,2) }}</td>

                                    @elseif ($item->vat3 != 0)

                                        <td>{{ number_format($item->vat3_value,2) }}</td>

                                    @elseif ($item->vat7 != 0)

                                        <td>{{ number_format($item->vat7_value,2) }}</td>

                                    @endif
                                    <td>{{ number_format($item->total,2) }}</td>
                                    <td class="text-right">
                                        <form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('report_dastroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})"><i class="fa-regular fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    @if(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                timer: 2000, // optional auto-close timer
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
