<x-app-layout>


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="row">

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-info">
                                    <h3>Sponsor Fighter</h3>
                                </div>
                                <div class="card-body">
                                    {{ $dataFighters }} : People
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-danger">
                                    <h3>Sponsor Fighter Active</h3>
                                </div>
                                <div class="card-body">
                                    {{ $fighterAvtive }} : People
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header bg-success">
                                    <h3>Customer All</h3>
                                </div>
                                <div class="card-body">
                                    {{ $dataCustomer }} : People
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






                </div>
            </div>
        </div>
    </div>
</x-app-layout>
