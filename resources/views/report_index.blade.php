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

                                        {{-- <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#id{{ $item->id }}">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button> --}}
                                        <a href="{{ route('viewBill',$item->id) }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    </td>
                                    <td>{{ $item->ref_order_id }}</td>
                                    {{-- <td>{{ $item->customer }}</td> --}}
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


<!-- Modal -->
<div class="modal fade" id="id{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title {{  $item->id  }} </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">




                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $item->ref_order_id }}">
                        <label for="floatingInput">Bill Number</label>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
        </div>
    </div>
    </div>
</div>




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
