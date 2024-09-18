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
                                <th>Training</th>
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
                                    <td>{{ $item->m_card }}</td>
                                    <td>{{ $item->fname }}</td>
                                    <td>{{ $item->nationalty }}</td>
                                    <td>{{ $item->type_training }}</td>
                                    <td>
                                        <a href="{{ route('fighter_show',$item->id) }}" target="_blank" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
