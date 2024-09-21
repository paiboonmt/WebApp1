<x-app-layout>
    <div class="p-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('fighter_save') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Data --}}
                        <div class="row">
                            <div class="col-4">
                                <img src="#" id="preview" width="100%">
                                <input type="file" name="image" id="imageUpload" accept="image/*" class="form-control">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-8">
                                {{-- fname --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Card number</span>
                                    <input type="text" class="form-control" name="m_card" value="{{ old('m_card') }}">
                                </div>

                                @error('m_card')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Visa number --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Visa number</span>
                                    <input type="text" class="form-control" name="p_visa" value="{{ old('p_visa') }}">
                                </div>

                                @error('passport')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Sex , fname --}}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text">Gender</label>
                                            <select class="form-select" name="sex">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text" >Full name</span>
                                            <input type="text" class="form-control" name="fname" value="{{ old('fname') }}">
                                        </div>
                                    </div>

                                    @error('fname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                {{-- Email --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Email</span>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                </div>

                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Phone number --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Phone number</span>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>

                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Fighter name --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text">Fighter name</span>
                                    <input type="text" class="form-control" name="fightname" value="{{ old('fightname') }}">
                                </div>

                                @error('fightname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Nationality , Birthday --}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text">Nationality</label>
                                            <select class="form-select" name="nationality" value="{{ old('nationality') }}">
                                                @foreach ($dataNationality as $rowna)
                                                    <option value="{{ $rowna->n_name }}">{{ $rowna->n_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Birthday</span>
                                            <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}">
                                        </div>
                                    </div>

                                    @error('birthday')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                {{-- Emergency --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text">Emergency</span>
                                    <input type="text" class="form-control" name="emergency" value="{{ old('emergency') }}">
                                </div>
                                {{-- Start Training , Expriy , Type of training --}}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Start Training</span>
                                            <input type="date" class="form-control" name="sta_date" value="{{ old('sta_date') }}">
                                        </div>
                                    </div>

                                    @error('sta_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    {{-- Expriy --}}
                                    <div class="col-4">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Expriy</span>
                                            <input type="date" class="form-control" name="exp_date" value="{{ old('exp_date') }}">
                                        </div>
                                    </div>

                                    @error('exp_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    {{-- Type of training --}}
                                    <div class="col-4">
                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text">Type of training</label>
                                            <select class="form-select" name="type_training" value="{{ old('type_training') }}">
                                                <option value="Temporary">Temporary</option>
                                                <option value="Tryout">Tryout</option>
                                                <option value="Trainee">Trainee</option>
                                                <option value="MMA"> MMA </option>
                                                <option value="Muay Thai"> Muay Thai </option>
                                                <option value="Fitness"> Fitness </option>
                                                <option value="Visitors pass"> Visitors pass </option>
                                                <option value="Entry Pass"> Entry Pass </option>
                                                <option value="Media Pass"> Media Pass </option>
                                                <option value="VIP Member"> VIP Member </option>
                                                <option value="Western Boxing">Western Boxing</option>
                                                <option value="-">-</option>
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
                                    <textarea class="form-control" rows="3" name="comment">{{ old('comment') }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Accommodations</label>
                                    <textarea class="form-control" rows="3" name="accom">{{ old('accom') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success" type="submit">SAVE TO | <i class="fa fa-database"></i></button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    });
</script>
