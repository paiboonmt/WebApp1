<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="row">
                        {{-- @dump($cart) --}}
                        {{-- Back --}}
                        <div class="col mb-3">
                            <a href="{{ route('ticket') }}" class="btn btn-dark" style="width: 200px"><i
                                    class="fa-solid fa-circle-chevron-left"></i> | Back</a>
                        </div>

                        {{-- product cart --}}
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

                        {{-- add discount --}}
                        <form action="{{ route('addDiscount') }}" method="post">
                            @csrf
                            <div class="row py-1">
                                {{-- <div class="col"></div> --}}
                                @if (session('discount'))
                                @else
                                    <div class="col-4">
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
                        </form>

                        {{-- show discount --}}
                        @if (session('discount'))
                            <div class="row">
                                <div class="col-8 ml-auto py-1">
                                    <a href="{{ route('removeDiscount') }}" class="btn btn-warning"><i class="fa-solid fa-trash"></i></a>
                                </div>
                                <div class="col-4">
                                    <table class="table">
                                        <tr>
                                            <td>Discount :</td>
                                            <td class="text-right">{{ session('sub_discount') }} %</td>
                                            <td class="text-right">{{ number_format(session('discount'), 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            {{-- add payment --}}
                            <form action="{{ route('addPayment') }}" method="post">
                                @csrf
                                <div class="row py-1">
                                    {{-- <div class="col"></div> --}}
                                    @if (session('payment'))
                                    @else
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text">Payment Type</span>
                                                <select name="payment" class="form-control">
                                                    @foreach ($payments as $payment)
                                                        <option value="{{ $payment->pay_name }}">
                                                            {{ $payment->pay_name }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-info" type="submit">Add</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            {{-- show payment --}}
                            @if (session('payment'))
                                <div class="row">
                                    <div class="col-8 ml-auto py-1">
                                        <form action="{{ route('removePayment') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tax3" value="{{ session('payment') }}">
                                            <button class="btn btn-warning" type="submit"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <table class="table">
                                                <tr>
                                                    <td>Payment typr :</td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right">{{ session('payment') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- add tax3 --}}
                            <form action="{{ route('addTax') }}" method="post">
                                @csrf
                                <div class="row py-1">
                                    @if (session('tax3'))
                                    @else
                                        <div class="col-4">
                                            <div class="input-group">
                                                <label class="input-group-text">Vat</label>
                                                <input type="text" name="tax3" value="3"
                                                    class="form-control">
                                                <input type="hidden" name="sub"
                                                    class="form-control"value="{{ session('sub') }}">
                                                <button class="btn btn-info" type="submit">Add</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            {{-- Show tax3 --}}
                            @if (session('tax3'))
                                <div class="row">
                                    <div class="col-8 ml-auto py-1">
                                        <form action="{{ route('removeTex') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tax3" value="{{ session('tax3') }}">
                                            <input type="hidden" name="sub" value="{{ session('sub') }}">
                                            <button class="btn btn-warning" type="submit"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-4">
                                        <table class="table">
                                            <tr>
                                                <td>Vat :</td>
                                                <td class="text-right">3 %</td>
                                                <td class="text-right">{{ number_format(session('tax3'), 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            {{-- Grand Total --}}
                            @if (session('discount'))
                                <div class="row">
                                    <div class="col-2 ">
                                        <form action="{{ route('removeAll') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tax3" value="{{ session('tax3') }}">
                                            <input type="hidden" name="sub" value="{{ session('sub') }}">
                                            <button class="btn btn-danger" type="submit"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-4 ms-auto">
                                        <div class="input-group mb-1">
                                            <table class="table">
                                                <tr>
                                                    <td>Grand Total :</td>
                                                    <td></td>
                                                    <td class="text-right">{{ number_format(session('sub'), 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            @endif

                            {{-- add Comments --}}
                            <div class="row py-1">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                    </div>
                                </div>
                            </div>


                        @endif

{{--***************************************************************************** --}}
                            {{-- add payment --}}
                            <form action="{{ route('addPayment') }}" method="post">
                                @csrf
                                <div class="row py-1">
                                    {{-- <div class="col"></div> --}}
                                    @if (session('payment'))
                                    @else
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text">Payment Type</span>
                                                <select name="payment" class="form-control">
                                                    @foreach ($payments as $payment)
                                                        <option value="{{ $payment->pay_name }}">
                                                            {{ $payment->pay_name }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-info" type="submit">Add</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            {{-- show payment --}}
                            @if (session('payment'))
                                <div class="row">
                                    <div class="col-8 ml-auto py-1">
                                        <form action="{{ route('removePayment') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tax3" value="{{ session('payment') }}">
                                            <button class="btn btn-warning" type="submit"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <table class="table">
                                                <tr>
                                                    <td>Payment typr :</td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right">{{ session('payment') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- add tax3 --}}
                            <form action="{{ route('addTax') }}" method="post">
                                @csrf
                                <div class="row py-1">
                                    @if (session('tax3'))
                                    @else
                                        <div class="col-4">
                                            <div class="input-group">
                                                <label class="input-group-text">Vat</label>
                                                <input type="text" name="tax3" value="3" class="form-control">
                                                <input type="hidden" name="sub" class="form-control"value="{{ $total }}">
                                                <button class="btn btn-info" type="submit">Add</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            {{-- Show tax3 --}}
                            @if (session('tax3'))
                                <div class="row">
                                    <div class="col-8 ml-auto py-1">
                                        <form action="{{ route('removeTex') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tax3" value="{{ session('tax3') }}">
                                            <input type="hidden" name="sub" value="{{ session('sub') }}">
                                            <button class="btn btn-warning" type="submit"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-4">
                                        <table class="table">
                                            <tr>
                                                <td>Vat :</td>
                                                <td class="text-right">3 %</td>
                                                <td class="text-right">{{ number_format(session('tax3'), 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            {{-- Grand Total --}}

                            <div class="row">
                                <div class="col-2 ">
                                </div>
                                <div class="col-4 ms-auto">
                                    <div class="input-group mb-1">
                                        <table class="table">
                                            <tr>
                                                <td>Grand Total :</td>
                                                <td></td>
                                                <td class="text-right">{{ number_format(session('sub'), 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            {{-- add Comments --}}
                            <div class="row py-1">
                                <div class="col-6 ms-auto">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                    </div>
                                </div>
                            </div>

                        <div class="row py-2">
                            <div class="col-4">
                                <a href="{{ route('cancelcart') }}" class="btn btn-danger form-control">Remove</a>
                            </div>
                            <div class="col-4 ms-auto">
                                <form action="" method="post">

                                    @csrf
                                    <button class="btn btn-success form-control">Save</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
