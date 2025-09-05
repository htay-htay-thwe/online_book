@extends('home.dashboard')

@section('content')
    <div class="p-5 page-content">
        <h2 class="mt-5">DashBoard v2</h2>
        <div class="container-fluid">
            <div class="row">
                <div class="grid-container col">
                    <div class="grid-item">
                        <div class="one-chart">
                            <div class="icon"><button><i class="fa-solid fa-gear"></i></button></div>
                            <div class="icon-letter">
                                <p>CPU Traffic</p>
                                <p>10%</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid-item">
                        <div class=" one-chart">
                            <div class="icon-red"><button><i class="fa-solid fa-gear"></i></button></div>
                            <div class="icon-letter">
                                <p>CPU Traffic</p>
                                <p>10%</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid-item">
                        <div class=" one-chart">
                            <div class="icon-green"><button><i class="fa-solid fa-gear"></i></button></div>
                            <div class="icon-letter">
                                <p>CPU Traffic</p>
                                <p>10%</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid-item">
                        <div class=" one-chart">
                            <div class="icon-yellow"><button><i class="fa-solid fa-gear"></i></button></div>
                            <div class="icon-letter">
                                <p>CPU Traffic</p>
                                <p>10%</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mt-4 col">
                    <table class="table">
                        <thead class="table-danger">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Admins</th>
                                <th scope="col">Create Date</th>
                                <th scope="col">Update Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminData as $data)
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="login-wrap col-6">
                    <div class="login-content">
                        <h2 class="mb-2 text-center">Admin Data</h2>
                        <div class="login-form">

                            <div class="form-group">
                                <label>Username</label>
                                <input class="au-input au-input--full " type="text" name="name" placeholder="Username"
                                    value="{{ Auth::user()->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full " type="email" name="email" placeholder="Email"
                                    value="{{ Auth::user()->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <img src="{{ asset('books/' . Auth::user()->image) }}"
                                    class="my-4 shadow-sm img-thumbnail w-25 " />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- col --}}
                <div class="login-wrap col-6">
                    <div class="login-content">
                        <h2 class="mb-2 text-center">Change Account Information</h2>
                        <div class="login-form">
                            <form action="{{ route('admin#input') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full @error('name') is-invalid @enderror"
                                        type="text" name="name" placeholder="Username">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full @error('email') is-invalid @enderror"
                                        type="email" name="email" placeholder="Email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="p-3 form-group">
                                    <input type='file' name="image" class="@error('image') is-invalid @enderror" />
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-dark col m-b-20" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
