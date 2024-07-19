@extends("template")

@section("title", "Profile")

@section("content")
    <h3>Update Profile</h3>
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <form class="mb-3" method="POST" action="{{ url('/profile') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" class="form-control" id="name" name="name" value="{{ $user["name"] }}">
        </div>
        <div class="form-group">
            <label for="membership">Membership Type</label>
            <select class="form-control" id="membership" name="membership_id">
                {{-- <option value="">Select option</option> --}}
                @foreach($memberships as $row)
                    <option value="{{ $row->id }}" @selected($row->id == $user->membership_id)>{{ $row->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="password">
                Password 
            </label>
            <input type="password" class="form-control" id="password" name="password">
            <p class="text-muted">Password tidak perlu diisi jika tidak ada perubahan</p>
        </div>
        <button type="submit" class="btn btn-warning mt-5">Update</button>
    </form>
@endsection