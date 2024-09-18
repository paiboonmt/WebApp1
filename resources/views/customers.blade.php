<x-app-layout>

    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Nationality</th>
                                {{-- <th>Packages</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ( $Customers as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->m_card }}</td>
                                    <td>{{ $item->fname }}</td>
                                    <td>{{ $item->nationalty }}</td>
                                    {{-- <td>{{ $item->package }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
