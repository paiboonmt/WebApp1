<x-app-layout>

    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table table-sm table-hover" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Iamge</th>
                                <th>Code</th>
                                <th>Training</th>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ( $Fighters as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="text-center">
                                        <img style="border-radius: 50px" width="30px" src="{{ asset('http://172.16.0.3/fighterimg/img/' . $item->image) }}">
                                        {{-- <img style="border-radius: 50px" width="30px" src="{{ asset('http://119.63.78.98:8889/fighterimg/img/'.$item->image) }}"> --}}
                                    </td>
                                    <td>{{ $item->m_card }}</td>
                                    <td>{{ $item->type_training }}</td>
                                    <td>{{ $item->fname }}</td>
                                    <td>{{ $item->nationalty }}</td>
                                    <td>
                                        <a href="{{ route('fighter_show',$item->id) }}"  class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
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
