@extends("template")

@section("title", "Register")

@section("content")
    <div class="container">
        <div class="col d-flex justify-content-center  mx-auto my-auto">
            <div class="card w-50">
                <div class="card-header text-center">
                    Register
                </div>   
                <div class="card-body">
                    @if(Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    <form class="mb-3" method="POST" action="{{ url('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="membership">Membership Type</label>
                            <select class="form-control" id="membership" name="membership_id">
                                @foreach($memberships as $row)
                                    <option value="{{ $row->id }}">{{ $row->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Register</button>
                    </form>

                    <p class="text-center">
                        Or
                    </p>

                    <a href="{{ url('/auth/google') }}" class="btn btn-block btn-outline-danger"><i class="bi bi-google"></i> Register With Google</a>
                    <a href="{{ url('/auth/facebook') }}" class="btn btn-block btn-outline-primary"><i class="bi bi-facebook"></i> Register With Facebook</a>

                    <p class="mt-3"><a href="<?php echo url('/login') ?>">I have an account</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection