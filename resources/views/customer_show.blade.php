<x-app-layout>
    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Data --}}
                    <div class="row">
                        <div class="col-4">
                            <img id="img" src="{{ asset('http://172.16.0.3/memberimg/img/' . $data[0]->image) }}">
                            <!-- <img id="img" src="{{ asset('http://119.63.78.98:8889/memberimg/img/'.$data[0]->image) }}"> -->
                        </div>
                        <div class="col-8">

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Card number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->m_card }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Visa number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->p_visa }}">
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Sex</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->sex }}">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Full name</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->fname }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Email</span>
                                <input type="text" class="form-control" value="{{ $data[0]->email }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Phone number</span>
                                <input type="text" class="form-control" value="{{ $data[0]->phone }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Package</span>
                                <input type="text" class="form-control" value="{{ $data[0]->product_name }}">
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Nationality</span>
                                <input type="text" class="form-control" value="{{ $data[0]->nationalty }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Birthday</span>
                                        <input type="text" class="form-control" value="{{ $data[0]->birthday }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Age</span>
                                        <input type="text" class="form-control" value="{{ $age }}">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text">Emergency</span>
                                <input type="text" class="form-control" value="{{ $data[0]->emergency }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Start Training</span>
                                        <input type="text" class="form-control"
                                            value="{{ date('d-m-Y', strtotime($data[0]->sta_date)) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <span class="input-group-text">Expriy</span>
                                        <input type="text" class="form-control"
                                            value="{{ date('d-m-Y', strtotime($data[0]->exp_date)) }}">
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

                        </div>
                    </div>

                    {{-- Comment accom --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $data[0]->comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Accommodations</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $data[0]->accom }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Files --}}
                    <div class="row">
                        <div class="col">
                            <div class="card-group">
                                @foreach ($files as $file)
                                    <a data-fancybox="gallery"
                                        data-src="{{ asset('http://172.16.0.3/memberimg/file/' . $file->image) }}">
                                        <img src="{{ asset('http://172.16.0.3/memberimg/file/' . $file->image) }}"
                                            width="50px" class="me-2 rounded" style="cursor: pointer" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Time check in --}}
                    <div class="row p-2">
                        <div class="col">
                            <div class="card p-2">
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
                                                <td>{{ $time->date }}</td>
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
</x-app-layout>
