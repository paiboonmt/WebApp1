<x-app-layout>
    <div class="p-2">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="row">
                        <div class="col-6">
                            <div class="card p-1">
                                <table class="table table-sm" id="products">
                                    <thead>
                                        <tr>
                                            <th>product</th>
                                            <th>price</th>
                                            <th>Cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ number_format($item->price) }}</td>
                                                <td>
                                                    <form action="{{ route('addToCart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="name"
                                                            value="{{ $item->product_name }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $item->price }}">
                                                        <input type="hidden" name="quantity" value="1"
                                                            min="1">
                                                        <button type="submit" class="btn btn-sm btn-success focus-ring focus-ring-success border rounded-2">
                                                            <i class="fa-solid fa-cart-shopping"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card p-1">
                                @if (Session::has('cart') && count(Session::get('cart')) > 0)

                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (session('cart') as $id => $item)
                                                <tr>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td class="text-right">{{ number_format($item['price']) }}</td>
                                                    <td class="text-right">{{ $item['quantity'] }}</td>
                                                    <td class="text-right">{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <form action="{{ route('updateCart') }}" method="post">
                                                                    @csrf
                                                                    <input
                                                                        type="hidden"
                                                                        name="product_id"
                                                                        value="{{ $id }}">
                                                                    <input
                                                                        type="hidden"
                                                                        name="quantity"
                                                                        value="{{ $item['quantity'] }}">
                                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                                        <i class="fa-solid fa-plus"></i></button>
                                                                </form>
                                                            </div>

                                                            <div class="col-6">
                                                                <form action="{{ route('cartremove') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id"value="{{ $id }}">
                                                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] }}">
                                                                    <button type="submit"class="btn btn-sm btn-danger"><i class="fa-solid fa-minus"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>Total</td>
                                                <td colspan="2"></td>
                                                <td colspan="2">{{ number_format($total, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('cart_checkout') }}" class="btn btn-success">Checkout</a>

                                @else
                                    <p>Your cart is empty.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</x-app-layout>
