<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="row">

                        {{-- Start --}}

                        <div class="col-6 mb-3">
                            <a href="{{ route('ticket') }}" class="btn btn-dark" style="width: 200px"><i class="fa-solid fa-circle-chevron-left"></i> | Back</a>
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
                        </div>

                        {{-- End --}}

                        {{-- Action Start --}}
                        <div class="col-6">

                            {{-- Total --}}
                            <div class="row">
                                <div class="col">
                                    <table class="table">
                                        <tr>
                                            <td>Total</td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">{{ number_format($total,2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            {{-- add discount --}}
                            @if (session('discount'))
                                @else
                                    <form action="{{ route('addDiscount') }}" method="post">
                                        @csrf
                                        <div class="row py-1">
                                                <div class="col-6">
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
                                        </div>
                                    </form>
                                @endif

                                {{-- show discount --}}
                                @if (session('discount'))

                                    {{-- show discount --}}
                                    <div class="row">
                                        <div class="col">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <form action="{{ route('removeDiscount') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="tax3" value="{{ session('payment') }}">
                                                            <button class="btn btn-warning" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                    <td></td>
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
                                        <div class="row">
                                            @if (session('pay_name'))
                                            @else
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Payment</span>
                                                        <select class="form-control" id="payment" name="payment_value" onchange="updatePayName()">
                                                            <option> --Choose--</option>
                                                            @foreach ($payments as $payment)
                                                                <option value="{{ $payment->value }}" data-name="{{ $payment->pay_name }}">{{ $payment->pay_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="pay_name" name="pay_name">
                                                        <input type="hidden" name="total" value="{{ $total }}">
                                                        <script>
                                                            function updatePayName() {
                                                                var select = document.getElementById('payment');
                                                                var selectedOption = select.options[select.selectedIndex];
                                                                var payName = selectedOption.getAttribute('data-name');
                                                                document.getElementById('pay_name').value = payName;
                                                            }
                                                        </script>
                                                        <button class="btn btn-info" type="submit">Add</button>
                                                    </div>
                                                    @error('pay_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </form>

                                    {{-- show payment --}}
                                    @if (session('pay_name'))
                                        <div class="row">
                                            <div class="col">
                                                <table class="table">
                                                        <tr>
                                                            <td>
                                                                <form action="{{ route('removePayment') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="tax3" value="{{ session('payment') }}">
                                                                    <button class="btn btn-warning" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                            <td></td>
                                                            <td>{{ session('pay_name') }}</td>
                                                            <td class="text-right">{{ session('payment_value')}} %</td>
                                                            <td class="text-right">{{ number_format(session('vat'),2) }}</td>
                                                        </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- add sub payment --}}
                                    @if (session('payment_value') == 7)
                                        @if (session('sub_payment'))
                                        @else
                                            <form action="{{ route('addSubPayment') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text">3 %</span>
                                                            <select class="form-control" id="payment" name="sub_payment" onchange="updatePayName()">
                                                                <option> --Choose--</option>
                                                                @foreach ($vat3 as $v3)
                                                                    <option value="{{ $v3->value }}" data-name="{{ $v3->pay_name }}">{{ $v3->pay_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" id="pay_name" name="pay_name">
                                                            <input type="hidden" name="total" value="{{ session('total') }}">
                                                            <script>
                                                                function updatePayName() {
                                                                    var select = document.getElementById('payment');
                                                                    var selectedOption = select.options[select.selectedIndex];
                                                                    var payName = selectedOption.getAttribute('data-name');
                                                                    document.getElementById('pay_name').value = payName;
                                                                }
                                                            </script>
                                                            <button class="btn btn-info" type="submit">Add</button>
                                                        </div>
                                                        @error('pay_name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @elseif (session('payment_value') == 3)
                                        @if (session('sub_payment'))
                                        @else
                                            <form action="{{ route('addSubPayment') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Sub payment</span>
                                                            <select class="form-control" id="payment" name="sub_payment" onchange="updatePayName()">
                                                                <option> --Choose--</option>
                                                                @foreach ($vat7 as $v7)
                                                                    <option value="{{ $v7->value }}" data-name="{{ $v7->pay_name }}">{{ $v7->pay_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" id="pay_name" name="pay_name">
                                                            <input type="hidden" name="total" value="{{ session('total') }}">
                                                            <script>
                                                                function updatePayName() {
                                                                    var select = document.getElementById('payment');
                                                                    var selectedOption = select.options[select.selectedIndex];
                                                                    var payName = selectedOption.getAttribute('data-name');
                                                                    document.getElementById('pay_name').value = payName;
                                                                }
                                                            </script>
                                                            <button class="btn btn-info" type="submit">Add</button>
                                                        </div>
                                                        @error('pay_name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @endif

                                    @if (session('sub_total'))
                                        <div class="row">
                                            <div class="col">
                                                <table class="table">
                                                    <tr>
                                                        <td>
                                                            <form action="{{ route('removeSubPayment') }}" method="post">
                                                                @csrf
                                                                <button class="btn btn-warning" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                        <td></td>
                                                        <td>{{ session('sub_pay_name') }}</td>
                                                        <td>{{ session('sub_payment')}} %</td>
                                                        <td class="text-right">{{ number_format(session('vat_sub'), 2) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Grand Total --}}
                                    @if (session('sub_total'))
                                        <div class="row">
                                            <div class="col">
                                                <table class="table">
                                                    <tr>
                                                        <td style="font-weight: bold">Grand Total :</td>
                                                        <td></td>
                                                        <td class="text-right">{{ number_format(session('sub_total'), 2) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <table class="table">
                                                    <tr>
                                                        <td style="font-weight: bold">Grand Total :</td>
                                                        <td></td>
                                                        <td class="text-right">{{ number_format(session('total'), 2) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    <form action="{{ route('complete') }}" method="post">
                                        @csrf

                                        @php
                                            $card = rand(mikrotime());
                                        @endphp

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Number</span>
                                            <input type="text" name="card" class="form-control" placeholder="card" value="{{ $card }}">
                                        </div>

                                        {{-- Customer name --}}
                                        <div class="row py-1">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="customer" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 20px">{{ old('customer') }}</textarea>
                                                    <label for="floatingTextarea2">Customer name</label>
                                                    @error('customer')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- add Comments --}}
                                        <div class="row py-1">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Comments</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row py-3">
                                            <div class="col-6">
                                                <a href="{{ route('cancelcart') }}" class="btn btn-danger form-control">Remove</a>
                                            </div>
                                            <div class="col-6">
                                                <input type="hidden" name="total" value="{{ $total }}">
                                                <button class="btn btn-success form-control" type="submit">Save complete</button>
                                            </div>
                                        </div>

                                        
                                    </form>

                                {{-- ถ้าไม่มีส่วนลดให้ทำงานหลังจาก else --}}
                            @else

                                {{-- add payment --}}
                                <form action="{{ route('addPayment') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        @if (session('pay_name'))
                                        @else
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">Payment</span>
                                                    <select class="form-control" id="payment" name="payment_value" onchange="updatePayName()">
                                                        <option> --Choose--</option>
                                                        @foreach ($payments as $payment)
                                                            <option value="{{ $payment->value }}" data-name="{{ $payment->pay_name }}">{{ $payment->pay_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="pay_name" name="pay_name">
                                                    <input type="hidden" name="total" value="{{ $total }}">
                                                    <script>
                                                        function updatePayName() {
                                                            var select = document.getElementById('payment');
                                                            var selectedOption = select.options[select.selectedIndex];
                                                            var payName = selectedOption.getAttribute('data-name');
                                                            document.getElementById('pay_name').value = payName;
                                                        }
                                                    </script>
                                                    <button class="btn btn-info" type="submit">Add</button>
                                                </div>
                                                @error('pay_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                </form>

                                {{-- show payment --}}
                                @if (session('pay_name'))
                                    <div class="row">
                                        <div class="col">
                                            <table class="table">
                                                    <tr>
                                                        <td style="padding-left: 55px">
                                                            <form action="{{ route('removePayment') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="tax3" value="{{ session('payment') }}">
                                                                <button class="btn btn-warning" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                        <td>{{ session('pay_name') }}</td>
                                                        <td>{{ session('payment_value')}} %</td>
                                                        <td class="text-right">{{ number_format(session('vat'),2) }}</td>
                                                    </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                {{-- add sub payment --}}
                                @if (session('payment_value') == 7)
                                    @if (session('sub_payment'))
                                    @else
                                        <form action="{{ route('addSubPayment') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <span class="input-group-text">3 %</span>
                                                        <select class="form-control" id="payment" name="sub_payment" onchange="updatePayName()">
                                                            <option> --Choose--</option>
                                                            @foreach ($vat3 as $v3)
                                                                <option value="{{ $v3->value }}" data-name="{{ $v3->pay_name }}">{{ $v3->pay_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="pay_name" name="pay_name">
                                                        <input type="hidden" name="total" value="{{ session('total') }}">
                                                        <script>
                                                            function updatePayName() {
                                                                var select = document.getElementById('payment');
                                                                var selectedOption = select.options[select.selectedIndex];
                                                                var payName = selectedOption.getAttribute('data-name');
                                                                document.getElementById('pay_name').value = payName;
                                                            }
                                                        </script>
                                                        <button class="btn btn-info" type="submit">Add</button>
                                                    </div>
                                                    @error('pay_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                @elseif (session('payment_value') == 3)
                                    @if (session('sub_payment'))
                                    @else
                                        <form action="{{ route('addSubPayment') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Sub payment</span>
                                                        <select class="form-control" id="payment" name="sub_payment" onchange="updatePayName()">
                                                            <option> --Choose--</option>
                                                            @foreach ($vat7 as $v7)
                                                                <option value="{{ $v7->value }}" data-name="{{ $v7->pay_name }}">{{ $v7->pay_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="pay_name" name="pay_name">
                                                        <input type="hidden" name="total" value="{{ session('total') }}">
                                                        <script>
                                                            function updatePayName() {
                                                                var select = document.getElementById('payment');
                                                                var selectedOption = select.options[select.selectedIndex];
                                                                var payName = selectedOption.getAttribute('data-name');
                                                                document.getElementById('pay_name').value = payName;
                                                            }
                                                        </script>
                                                        <button class="btn btn-info" type="submit">Add</button>
                                                    </div>
                                                    @error('pay_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                @endif

                                @if (session('sub_total'))
                                    <div class="row">
                                        <div class="col">
                                            <table class="table">
                                                <tr>
                                                    <td style="padding-left: 55px">
                                                        <form action="{{ route('removeSubPayment') }}" method="post">
                                                            @csrf
                                                            <button class="btn btn-warning" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                    <td>{{ session('sub_pay_name') }}</td>
                                                    <td>{{ session('sub_payment')}} %</td>
                                                    <td class="text-right">{{ number_format(session('vat_sub'), 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                {{-- Grand Total --}}
                                @if (session('sub_total'))
                                    <div class="row">
                                        <div class="col">
                                            <table class="table">
                                                <tr>
                                                    <td style="font-weight: bold">Grand Total :</td>
                                                    <td></td>
                                                    <td class="text-right">{{ number_format(session('sub_total'), 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col">
                                            <table class="table">
                                                <tr>
                                                    <td style="font-weight: bold">Grand Total :</td>
                                                    <td></td>
                                                    <td class="text-right">{{ number_format(session('total'), 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                {{-- add Comments --}}
                                <div class="row py-1">
                                    <div class="col">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>

                    </div>

                    {{--  Remove all and save order--}}
                    {{-- <div class="row py-3">
                        <div class="col-6">
                            <a href="{{ route('cancelcart') }}" class="btn btn-danger form-control">Remove</a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('complete') }}" method="post">
                                @csrf
                                <input type="hidden" name="total" value="{{ $total }}">
                                <button class="btn btn-success form-control" type="submit">Save complete</button>
                            </form>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
