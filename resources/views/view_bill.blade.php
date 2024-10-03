<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="row">

                        <div class="col mb-3">
                            <a href="" class="btn btn-success focus-ring focus-ring-success border rounded-2" style="width: 10%">Update data</a>
                            <a href="" class="btn btn-danger focus-ring focus-ring-danger border rounded-2" style="width: 10%">Delete data</a>
                            <a href="" class="btn btn-info focus-ring focus-ring-info border rounded-2" style="width: 10%">Print data</a>
                        </div>

                    </div>
                    <hr class="mb-2">
                    <div class="row">

                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                            </table>

                            <textarea class="form-control"  rows="15"> {{ $data }}</textarea>
                        </div>

                        <div class="col-4">

                            <div class="input-group mb-1">
                                <label class="input-group-text">Card number</label>
                                <input type="text" class="form-control" value="{{ $data->ref_order_id }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Customer name</label>
                                <input type="text" class="form-control" value="{{ $data->customer }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Payment with</label>
                                <input type="text" class="form-control" value="{{ $data->payment }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Discount</label>
                                <input type="text" class="form-control" value="{{ $data->discount_value .'%'. ' -> ' . number_format($data->discount,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Vat3%</label>
                                <input type="text" class="form-control" value="{{ $data->vat3 .'%'. ' -> ' . number_format($data->vat3_value,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Vat7%</label>
                                <input type="text" class="form-control" value="{{ $data->vat7 .'%'. ' -> ' . number_format($data->vat7_value,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Grand Total</label>
                                <input type="text" class="form-control" value="{{ number_format($data->total,2) }} ฿">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Created at</label>
                                <input type="text" class="form-control" value="{{ date('d-m-Y H:i:s',strtotime($data->created_at) ) }}">
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text">Create by</label>
                                <input type="text" class="form-control" value="{{ $data->user }}">
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
