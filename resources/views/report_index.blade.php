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
                                <th>Action</th>
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
                                    <td>
                                        {{-- <form action="{{ route('report_dastroy') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button class="btn btn-sm btn-danger delete-button" type="submit">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form> --}}

                                        <button class="btn btn-sm btn-danger delete-button"  data-id="{{ $item->id }}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Event listener for delete button
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                var itemId = this.getAttribute('data-id');

                // SweetAlert confirmation
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
                        // Make AJAX request to delete the item
                        $.ajax({
                            // url: '/items/' + itemId,
                            url: "{{ route('report_dastroy', '') }}/" + itemId,  // URL to your delete route
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'  // Include CSRF token
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your item has been deleted.',
                                    'success'
                                );

                                // Optionally remove the item from the DOM
                                location.reload();
                            },
                            error: function (xhr) {
                                Swal.fire(
                                    'Failed!',
                                    'There was a problem deleting your item.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    });
</script>

