<style>
    #img{
        border-radius: 15px;
        align-items: center;
        width: 100%;
        padding-left: 60px;
    }
</style>
<x-app-layout>

    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="row">
                        <div class="col-4 mb-3">
                            {{-- <img id="img" src="{{ asset('http://172.16.0.3/fighterimg/img/'.$data[0]->image) }}"> --}}
                            <img id="img" src="{{ asset('http://119.63.78.98:8889/fighterimg/img/'.$data[0]->image) }}">
                        </div>
                        <div class="col-8 mb-3">

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="basic-addon1">Card number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->m_card }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="basic-addon1">Visa number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->p_visa }}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Email</span>
                                <input type="text" class="form-control" value="{{ $data[0]->email }}">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Phone number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->phone }}">
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="basic-addon1">Sex</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->sex }}">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="basic-addon1">Full name</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->fname }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="basic-addon1">Fighter name</span>
                                <input type="text" class="form-control" value="{{ $data[0]->fightname }}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="basic-addon1">Nationality</span>
                                <input type="text" class="form-control" value="{{ $data[0]->nationalty }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" id="basic-addon1">Birthday</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->birthday }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" id="basic-addon1">Age</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->age }}">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="basic-addon1">Package</span>
                                <input type="text" class="form-control" value="{{ $data[0]->package }}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="basic-addon1">Emergency</span>
                                <input type="text" class="form-control" value="{{ $data[0]->emergency }}">
                            </div>


                            <div class="row">
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" id="basic-addon1">Start Training</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->sta_date }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" id="basic-addon1">Expriy</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->exp_date }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text" id="basic-addon1">Type of training</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->type_training }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $data[0]->comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Accomunication</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $data[0]->accom }}</textarea>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
