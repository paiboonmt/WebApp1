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
                            </div>
                            <div class="col-8">
                                {{-- fname --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Card number</span>
                                    <input type="text" class="form-control" name="m_card" value="1234">
                                </div>
                                {{-- Visa number --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Visa number</span>
                                    <input type="text" class="form-control" name="passport" value="1234">
                                </div>
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
                                            <input type="text" class="form-control" name="fname" value="Paiboon Yaniwong">
                                        </div>
                                    </div>
                                </div>
                                {{-- Email --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Email</span>
                                    <input type="text" class="form-control" name="Email" value="it@dev.tiger">
                                </div>
                                {{-- Phone number --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" >Phone number</span>
                                    <input type="text" class="form-control" name="phone" value="1169">
                                </div>
                                {{-- Fighter name --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text">Fighter name</span>
                                    <input type="text" class="form-control" name="fightname" value="Thanos">
                                </div>

                                {{-- Birthday --}}
                                <div class="row">
                                    <div class="col-6">

                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text">Nationality</label>
                                            <select class="form-select" name="nationalty">

                                                @foreach ($dataNationality as $rowna)
                                                    <option value="{{ $rowna->n_name }}">{{ $rowna->n_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Birthday</span>
                                            <input type="date" class="form-control" name="birthday" value="1985-09-18">
                                        </div>
                                    </div>
                                </div>

                                {{-- Emergency --}}
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text">Emergency</span>
                                    <input type="text" class="form-control" name="emergency" value="1169">
                                </div>

                                {{-- Start Training , Expriy , Type of training --}}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text" >Start Training</span>
                                            <input type="date" class="form-control" name="sta_date" value="2024-09-01">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Expriy</span>
                                            <input type="date" class="form-control" name="exp_date" value="2024-10-01">
                                        </div>
                                    </div>
                                    <div class="col-4">

                                        <div class="input-group input-group-sm mb-2">
                                            <label class="input-group-text">Type of training</label>
                                            <select class="form-select" name="type_training">
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
                                    <textarea class="form-control" rows="3" name="comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, quam!</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Accommodations</label>
                                    <textarea class="form-control" rows="3" name="accom">Lorem ipsum dolor sit amet.</textarea>
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
