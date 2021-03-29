@extends('template.index')

@section('title', 'Login')


@section('content')
    <div class="container h-100 shadow">
        <div class="row h-100 justify-content-center align-items-center">


            <form class="col-12  bg-light p-4" action="{{ url('login/check') }}" method="POST">
                @csrf
                <h1>Login Demo Application</h1>
                @if (Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                    </div>
                @endif
                <div class="form-group">
                    <label for="formGroupExampleInput">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
