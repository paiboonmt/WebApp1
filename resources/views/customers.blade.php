
<x-app-layout>

    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table table-sm" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>Package</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ( $Customers as $item)
                                <tr class="text-left">
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <img style="border-radius: 50px" width="30px" id="img" src="{{ asset('http://172.16.0.3/memberimg/img/'.$item->image) }}">
                                    </td>
                                    <td>{{ $item->m_card }}</td>
                                    <td>{{ $item->fname }}</td>
                                    <td>{{ $item->nationalty }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <a href="{{ route('customers_show',$item->id) }}" class="btn btn-sm btn-info"><i class="fa-solid fa-binoculars"></i></a>
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
