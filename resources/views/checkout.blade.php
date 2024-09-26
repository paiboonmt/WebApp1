<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="row">
                        {{-- @dump($cart) --}}
                        <div class="col mb-3">
                            <a href="{{ route('ticket') }}" class="btn btn-dark" style="width: 200px"><i class="fa-solid fa-circle-chevron-left"></i> | Back</a>
                        </div>
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
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach (session('cart') as $id => $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ number_format($item['price'], 2) }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="font-weight: 900">Total</td>
                                    <td colspan="2" style="font-weight: 900; color:red">
                                        {{ number_format($total, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>

                        <form action="{{ route('addDiscount') }}" method="post">
                            @csrf
                            <div class="row py-2">
                                <div class="col"></div>
                                @if (session('discount'))
                                @else
                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="input-group-text">Discound</label>
                                            <select name="discount" class="form-control">
                                                <option value="0">0%</option>
                                                <option value="3">3%</option>
                                                <option value="5">5%</option>
                                                <option value="10">10%</option>
                                            </select>
                                            <button class="btn btn-info" type="submit">Add</button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr>
                            {{-- show discount --}}
                            <div class="row">
                                <div class="col py-1">
                                    @if (session('discount'))
                                        <a href="{{ route('removeDiscount') }}" class="btn btn-danger">Delete</a>
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if (session('discount'))
                                        <table class="table">
                                            <tr>
                                                <td>Discount :</td>
                                                <td>{{ session('tax') }} %</td>
                                                <td class="text-right">{{ number_format(session('discount'), 2) }}</td>
                                            </tr>
                                        </table>
                                        <input type="hidden" class="form-control" name="discount"value="{{ number_format(session('discount'), 2) }}">
                                        <div class="input-group mb-1">
                                            <table class="table">
                                                <tr>
                                                    <td>Grand Total :</td>
                                                    <td></td>
                                                    <td class="text-right">{{ number_format(session('sub'), 2) }}</td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="sub" name="sub" class="form-control"value="{{ number_format(session('sub'), 2) }}">
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </form>

                        {{-- tax3 --}}
                        <form action="{{ route('addTax') }}" method="post">
                            @csrf
                            <div class="row py-2">
                                <div class="col">
                                    @if (session('discount'))
                                        <input type="hidden" name="discount" value="{{ session('discount') }}">
                                        <input type="hidden" name="sub" value="{{ session('sub') }}">
                                    @endif
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        <label class="input-group-text">Tax</label>
                                        <input type="text" name="tax3" value="3" readonly class="form-control">
                                        <button class="btn btn-info" type="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Comments --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Comments</label>
                                  </div>
                            </div>
                        </div>

                        {{-- Grand Total --}}
                        <div class="row">
                            <div class="input-group mb-1">
                                <table class="table">
                                    <tr>
                                        <td>Grand Total :</td>
                                        <td></td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                </table>
                                <input type="hidden" name="total" class="form-control" value="{{ $total }}">
                            </div>
                        </div>

                        <div class="row">
                            <a href="{{ route('cancelcart') }}" class="btn btn-danger">Remove</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
