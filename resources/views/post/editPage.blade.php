@extends('home.dashboard')

@section('content')


                <div class="p-5 page-content">
                    <div class=" login-wrap col-9">
                        <div class="shadow-lg login-content col">
                            <h2 class="mb-2 text-center">Edit Post Data</h2>
                                <form method="post" action="{{ route('post#update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                            <div class="col-6">
                                                <input value="{{ old('id',$data->id) }}" name="id" type="hidden"/>
                                                <img name="bookImage" src="{{ asset('storage/'.$data->bookImage) }}" class="card-img-top w-100" alt="..." style="height:300px; " />
                                                <div class="form-group">
                                                    <label>Book Image</label>
                                                    <input type="file" name="bookImage" class="@error('bookImage') is-invalid @enderror">
                                                    @error('bookImage')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label>Book Name</label>
                                                <input class="au-input au-input--full @error('bookName') is-invalid @enderror"
                                                    type="text" name="bookName" placeholder="Book Name" value="{{ old('username',$data->bookName) }}">
                                                @error('bookName')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Genre</label>
                                                <select name="genre" type='text' class="form-select au-input au-input--full" aria-label="Default select example">
                                                  <option>Choose Genre</option>
                                                  @foreach($genre as $gen)
                                                  <option value="{{ $gen->id }}"selected>{{ $gen->genre }}</option>
                                                  @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>Writer Name</label>
                                                <input class="au-input au-input--full @error('writerName') is-invalid @enderror"
                                                    type="text" name="writerName" placeholder="Writer Name" value="{{ old('username',$data->writerName) }}">
                                                @error('writerName')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Number</label>
                                                <input class="au-input au-input--full @error('number') is-invalid @enderror" type="text"
                                                    name="number" placeholder="Number" value="{{ old('username',$data->number) }}">
                                                @error('number')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Price</label>
                                                 <input value="{{ old('price',$data->price) }}" class="au-input au-input--full @error('price') is-invalid @enderror" type="text" name="price" placeholder="Number">
                                                 @error('price')
                                               <small class="text-danger">{{ $message }}</small>
                                               @enderror
                                               </div>


                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="au-input au-input--full @error('description') is-invalid @enderror"
                                                    cols="30" row="10" type="text" name="description"
                                                    placeholder="Description">{{ $data->description }}</textarea>
                                                @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            </div>
                                            <button class="mt-3 btn btn-dark offset-4 col-4" type="submit">Update</button>
                                            </div>
                                </form>
                        </div>
                    </div>
                </div>



@endsection
