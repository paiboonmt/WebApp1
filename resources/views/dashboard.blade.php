<x-app-layout>


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- card --}}
                    <div class="row mb-2">

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-info">
                                    <h3>Sponsor Fighter</h3>
                                </div>
                                <div class="card-body">
                                    {{ number_format($dataFighters,0) }} : People
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-danger">
                                    <h3>Sponsor Fighter Active</h3>
                                </div>
                                <div class="card-body">
                                    {{ number_format($fighterAvtive,0) }} : People
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-success">
                                    <h3>Customer All</h3>
                                </div>
                                <div class="card-body">
                                    {{ number_format($dataCustomer,0) }} : People
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-primary">
                                    <h3>Customer Active</h3>
                                </div>
                                <div class="card-body">
                                    {{ $customerActive }} : People
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-dark" style="color: rgb(255, 255, 255)">
                                    <h3>Nationality Popular</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th class="text-right">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $th=1;
                                            @endphp
                                            @foreach ($countNationality as $narow)
                                                <tr>
                                                    <td>{{ $th++ }}</td>
                                                    <td>{{ $narow->nationalty }}</td>
                                                    <td class="text-right">{{ $narow->count }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header" style="background-color: rgb(118, 0, 134);color: white">
                                    <h3>Check in Total </h3>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th class="text-right">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $th=1;
                                            @endphp
                                            @foreach ($countCheckin as $timerow)
                                                <tr>
                                                    <td>{{ $th++ }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($timerow->date)) }}</td>
                                                    <td class="text-right">{{ $timerow->quantity }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="card p-1">
                                <div class="card-header" style="background-color: rgb(127, 156, 11);color: white">
                                    Type of training
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type name</th>
                                                <th class="text-right">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach ($typeTrainings as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->type_training }}</td>
                                                    <td class="text-right">{{ $item->cc }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card p-1">
                                <div class="card-header" style="background-color: rgb(5, 179, 130);color: white">
                                    Products for sale Popular
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product name</th>
                                                <th class="text-right">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $ii=1;
                                            @endphp
                                            @foreach ($countProducts as $pp)
                                                <tr>
                                                    <td>{{ $ii++ }}</td>
                                                    <td>{{ $pp->product_name }}</td>
                                                    <td class="text-right">{{ $pp->product_count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
