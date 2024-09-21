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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataFighter as $frow)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $frow->fname }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#id{{ $frow->id }}"> <i class="fa-solid fa-binoculars"></i> | View
                                                    </button>
                                                </td>

                                                <!-- Modal -->
                                                <div class="modal fade" id="id{{ $frow->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                {{-- Data --}}
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <img src="{{ asset('image/fighter/'.$frow->image ) }}"  width="100%">
                                                                    </div>

                                                                    <div class="col-8">
                                                                        {{-- fname --}}
                                                                        <div class="input-group input-group-sm mb-2">
                                                                            <span class="input-group-text">Card number</span>
                                                                            <input type="text" class="form-control" name="m_card" value="{{ $frow->m_card }}">
                                                                        </div>

                                                                        {{-- Visa number --}}
                                                                        <div class="input-group input-group-sm mb-2">
                                                                            <span class="input-group-text">Visa number</span>
                                                                            <input type="text" class="form-control"name="p_visa" value="{{ $frow->p_visa }}">
                                                                        </div>


                                                                        {{-- Sex , fname --}}
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <label class="input-group-text">Gender</label>
                                                                                    <select class="form-select" name="sex">
                                                                                        <option>{{ $frow->sex }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <span class="input-group-text">Full name</span>
                                                                                    <input type="text"class="form-control"name="fname"  value="{{ $frow->fname }}">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        {{-- Email --}}
                                                                        <div class="input-group input-group-sm mb-2">
                                                                            <span class="input-group-text">Email</span>
                                                                            <input type="text" class="form-control" name="email"  value="{{ $frow->email }}">
                                                                        </div>


                                                                        {{-- Phone number --}}
                                                                        <div class="input-group input-group-sm mb-2">
                                                                            <span class="input-group-text">Phone number</span>
                                                                            <input type="text" class="form-control"name="phone"  value="{{ $frow->phone }}">
                                                                        </div>


                                                                        {{-- Fighter name --}}
                                                                        <div class="input-group input-group-sm mb-2">
                                                                            <span class="input-group-text">Fighter name</span>
                                                                            <input type="text" class="form-control" name="fightname"  value="{{ $frow->fightname }}">
                                                                        </div>

                                                                        {{-- Nationality , Birthday --}}
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <label class="input-group-text">Nationality</label>
                                                                                    <select class="form-select" name="nationality">
                                                                                        <option>{{ $frow->nationality }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <span
                                                                                        class="input-group-text">Birthday</span>
                                                                                    <input type="date" class="form-control"name="birthday" value="{{ $frow->birthday }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {{-- Emergency --}}
                                                                        <div class="input-group input-group-sm mb-2">
                                                                            <span class="input-group-text">Emergency</span>
                                                                            <input type="text" class="form-control" name="emergency" value="{{ $frow->emergency }}">
                                                                        </div>
                                                                        {{-- Start Training , Expriy , Type of training --}}
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <span
                                                                                        class="input-group-text">Start Training</span>
                                                                                    <input type="date" class="form-control" name="sta_date" value="{{ $frow->sta_date }}">
                                                                                </div>
                                                                            </div>

                                                                            {{-- Expriy --}}
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <span class="input-group-text">Expriy</span>
                                                                                    <input type="date"class="form-control"name="exp_date" value="{{ $frow->exp_date }}">
                                                                                </div>
                                                                            </div>

                                                                            {{-- Type of training --}}
                                                                            <div class="col-4">
                                                                                <div
                                                                                    class="input-group input-group-sm mb-2">
                                                                                    <label class="input-group-text">Type of training</label>
                                                                                    <select class="form-select" name="type_training" >
                                                                                        <option>{{ $frow->type_training }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment accom --}}
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Comment</label>
                                                                            <textarea class="form-control" rows="3" name="comment">{{ $frow->comment }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">Accommodations</label>
                                                                            <textarea class="form-control" rows="3" name="accom">{{ $frow->accom }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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

                    <div class="row">

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
