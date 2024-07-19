@extends("template")

@section("title", "Log In")

@section("content")
    <div class="col d-flex justify-content-center  mx-auto my-auto">
        <div class="card w-50">
            <div class="card-header text-center">
                Log In
            </div>   
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-danger">{{ Session::get('message') }}</p>
                @endif
                <form class="mb-3" method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-block btn-success">Log In</button>
                </form>

                <p class="text-center">
                    Or
                </p>

                <a href="{{ url('/auth/google') }}" class="btn btn-block btn-outline-danger"><i class="bi bi-google"></i> Log In With Google</a>
                <a href="{{ url('/auth/facebook') }}" class="btn btn-block btn-outline-primary"><i class="bi bi-facebook"></i> Log In With Facebook</a>

                <p class="mt-3"><a href="<?php echo url('/register') ?>">I have no account</a></p>
            </div>
        </div>
    </div>
@endsection