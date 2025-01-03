<style>
    .img-fluid {
        /* border-radius: 15px; */
        align-items: center;
        /* width: 100%; */
        height: 450px;
    }
</style>

<x-app-layout>

    <div class="container-fluid">
        <div class="row">
            <div class="col p-1">
                <div class="card p-1 mb-2">
                    {{-- Data --}}
                    <div class="row">

                        <div class="col-4">
                            <div class="card">
                                <img class="img-fluid"
                                    src="{{ asset('http://172.16.0.3/fighterimg/img/' . $data[0]->image) }}">
                            </div>
                            {{-- <img id="img" src="{{ asset('http://119.63.78.98:8889/fighterimg/img/'.$data[0]->image) }}"> --}}
                        </div>

                        <div class="col-8">

                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Card number</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->m_card }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Visa number</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->p_visa }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-2">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Sex</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->sex }}">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Full name</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->fname }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Emergency</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->emergency }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Email</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->email }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Phone number</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->phone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fighter name</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->fightname }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Nationality</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->nationalty }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Birthday</span>
                                        <input type="text" class="form-control"
                                            value="{{ date('d-m-Y', strtotime($data[0]->birthday)) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Age</span>
                                        <input type="text" class="form-control" value="{{ $age }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Start Training</span>
                                        <input type="text" class="form-control"
                                            value="{{ date('d-m-Y', strtotime($data[0]->sta_date)) }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Expriy</span>
                                        <input type="text" class="form-control"
                                            value="{{ date('d-m-Y', strtotime($data[0]->exp_date)) }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Type of training</span>
                                        <input type="text" class="form-control"
                                            value="{{ $data[0]->type_training }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Expriy date</span>

                                @if ($exp >= 0)
                                    <input type="text" class="form-control bg-success"
                                        value="{{ $exp }} Day">
                                @else
                                    <input type="text" class="form-control bg-danger"
                                        value="{{ $exp }} Day">
                                @endif
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
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label">Accommodations</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $data[0]->accom }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Time Table
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="card p-1">
                                                <table class="table" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date | Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($times as $time)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ date('d-m-Y H:i:s' , strtotime($time->date)) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="card-group">
                                        @foreach ($files as $file)
                                            <div class="card" style="margin: 5px;">
                                                <a data-fancybox="gallery"
                                                    data-src="{{ asset('http://172.16.0.3/fighterimg/file/' . $file->image) }}">
                                                    <img src="{{ asset('http://172.16.0.3/fighterimg/file/' . $file->image) }}"
                                                        width="50px" class="me-2 rounded"
                                                        style="cursor: pointer" />
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>


</x-app-layout>
