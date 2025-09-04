@extends('home.dashboard')

@section('content')
    <div class="p-5 page-content container-fluid">
        <div class="row">
            <div class="mt-4 login-wrap col-5">
                <div class="shadow-lg login-content">
                    <h2 class="mb-2 text-center">Input Data about Post</h2>
                    <div class="login-form">
                        <form method="post" action="{{ route('post#create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Book Name</label>
                                <input class="au-input au-input--full @error('bookName') is-invalid @enderror"
                                    type="text" name="bookName" placeholder="Book Name">
                                @error('bookName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Genre</label>
                                <select name="genre" type='text' class="form-select au-input au-input--full"
                                    aria-label="Default select example">
                                    <option value="" selected>Choose Genre</option>
                                    @foreach ($genre as $gen)
                                        <option value="{{ $gen->genre }}">{{ $gen->genre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Writer Name</label>
                                <input class="au-input au-input--full @error('writerName') is-invalid @enderror"
                                    type="text" name="writerName" placeholder="Writer Name">
                                @error('writerName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Number</label>
                                <input class="au-input au-input--full @error('number') is-invalid @enderror" type="text"
                                    name="number" placeholder="Number">
                                @error('number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input class="au-input au-input--full @error('price') is-invalid @enderror" type="text"
                                    name="price" placeholder="Number">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Book Image</label>
                                <input type="file" name="bookImage" class="@error('bookImage') is-invalid @enderror">
                                @error('bookImage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="scroll" class="au-input au-input--full @error('description') is-invalid @enderror" cols="7"
                                    rows="5" type="text" name="description" placeholder="Description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="mt-3 btn btn-dark offset-4 col-4" type="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-5 col-7">
                <div class="slide-container swiper">
                    <div class="slide-content">
                        <div class="card-wrapper swiper-wrapper">
                            @foreach ($book as $data)
                                <div class="card swiper-slide">
                                    <div class="image-content">
                                        <span class="overlay"></span>

                                        <div class="card-image">
                                            <img src="{{ asset('books/' . $data->bookImage) }}" alt=""
                                                class="card-img" />
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h2 class="name">{{ $data->bookName }} - <span style="color:brown;">ID
                                                {{ $data->id }}</span></h2>
                                        <p class="mt-3 mb-3 description">စာအုပ်အရေအတွက် - {{ $data->number }} </p>
                                        <div style="display: flex;gap:1rem;">
                                            <a href="{{ route('post#delete', $data->id) }}"><span
                                                    class="p-2 btn btn-danger"><i
                                                        class="fa-solid fa-trash-can"></i></span></a>
                                            <a href="{{ route('post#editPage', $data->id) }}"><span
                                                    class="btn btn-success"><i
                                                        class="fa-solid fa-pen-to-square"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="mt-5 shadow-lg login-content">
                    <h2 class="mb-2 text-center">Genre Create Page</h2>
                    <div class="login-form">
                        <form method="post" action="{{ route('genre#create') }}">
                            @csrf
                            <div class="form-group">
                                <label>Genre</label>
                                <input class="au-input au-input--full @error('genre') is-invalid @enderror" type="text"
                                    name="genre" placeholder="Genre">
                                @error('genre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="mt-3 btn btn-dark offset-4 col-4" type="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function() {
        var swiper = new Swiper(".slide-content", {
            slidesPerView: 1,
            centeredSlides: false,
            spaceBetween: 30,
            grabCursor: true,
            loop: true,
            fade: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                550: {
                    slidesPerView: 1,
                },
                855: {
                    slidesPerView: 1,
                },
                950: {
                    slidesPerView: 1,
                },
            },
        });
    }
</script>
