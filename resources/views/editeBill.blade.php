<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="row mb-2">

                       <div class="col">
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <span style="color: white; font-size: 28px">UPDATE</span>
                                </div>
                            </div>
                       </div>

                    </div>
                    <hr class="mb-2">

                    <div class="row">

                        <div class="col-6">
                            <table class="table" id="reportticket">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ number_format($item->price,2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                <form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('deleteItem', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="ref_order_id" value="{{ $item->price }}">
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})"><i class="fa-regular fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <textarea class="form-control mt-3"  rows="9"> {{ $data[0]->comment }}</textarea> --}}
                            <textarea class="form-control mt-3"  rows="9"> {{ $data }}</textarea>

                        </div>

                        <div class="col-6">

                            <div class="input-group mb-1">
                                <label class="input-group-text">Card number</label>
                                <input type="text" class="form-control" value="{{ $data[0]->ref_order_id }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Customer name</label>
                                <input type="text" class="form-control" value="{{ $data[0]->customer }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Payment with</label>
                                <input type="text" class="form-control" value="{{ $data[0]->payment }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Discount</label>
                                <input type="text" class="form-control" value="{{ $data[0]->discount_value .'%'. ' -> ' . number_format($data[0]->discount,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Vat3%</label>
                                <input type="text" class="form-control" value="{{ $data[0]->vat3 .'%'. ' -> ' . number_format($data[0]->vat3_value,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Vat7%</label>
                                <input type="text" class="form-control" value="{{ $data[0]->vat7 .'%'. ' -> ' . number_format($data[0]->vat7_value,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Grand Total</label>
                                <input type="text" class="form-control" value="{{ number_format($data[0]->total,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Created at</label>
                                <input type="text" class="form-control" value="{{ date('d-m-Y H:i:s',strtotime($data[0]->created_at) ) }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Create by</label>
                                <input type="text" class="form-control" value="{{ $data[0]->user }}">
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-footer bg-success">
                                    <span style="color: white; font-size: 28px; float: right;">
                                        <button class="btn btn-info">UPDATE</button>
                                    </span>
                                </div>
                            </div>
                       </div>
                    </div>

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
