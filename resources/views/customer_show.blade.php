<x-app-layout>

    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Data --}}
                    <div class="row">
                        <div class="col-4">
                            <img id="img" src="{{ asset('http://172.16.0.3/memberimg/img/' . $data[0]->image) }}">
                            {{-- <img id="img" src="{{ asset('http://119.63.78.98:8889/fighterimg/img/'.$data[0]->image) }}"> --}}
                        </div>
                        <div class="col-8">

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Card number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->m_card }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Visa number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->p_visa }}">
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Sex</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->sex }}">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Full name</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->fname }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Email</span>
                                <input type="text" class="form-control" value="{{ $data[0]->email }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Phone number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->phone }}">
                            </div>



                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Fighter name</span>
                                <input type="text" class="form-control" value="{{ $data[0]->fightname }}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Nationality</span>
                                <input type="text" class="form-control" value="{{ $data[0]->nationalty }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Birthday</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->birthday }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Age</span>
                                        <input type="text" class="form-control" value="{{ $age }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Emergency</span>
                                <input type="text" class="form-control" value="{{ $data[0]->emergency }}">
                            </div>


                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Start Training</span>
                                        <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($data[0]->sta_date)) }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Expriy</span>
                                        <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($data[0]->exp_date)) }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" >Type of training</span>
                                        <input type="text" class="form-control"
                                            value="{{ $data[0]->type_training }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" >Expriy date</span>

                                @if ($exp >= 0)
                                    <input type="text" class="form-control bg-success" value="{{ $exp }} Day">
                                @else
                                    <input type="text" class="form-control bg-danger" value="{{ $exp }} Day">
                                @endif
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
