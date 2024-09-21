<x-app-layout>
    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="row">
                        <div class="col-6">

                            <div class="card mb-2">
                                <div class="card-header bg-dark" style="color: white">
                                    Sponsor Fighter
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('fighter_create') }}" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-person-circle-plus"></i> |
                                        Create Sponsor Fighter
                                    </a>
                                </div>
                            </div>

                            <div class="card">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($dataFighter as $frow)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $frow->fname }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-dark" style="color: white">
                                    Customer
                                </div>
                                <div class="card-body">
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-person-circle-plus"></i> |
                                        Create Customer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
