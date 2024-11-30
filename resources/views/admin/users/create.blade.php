@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">User Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Add User</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.users.create')}}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="usernameInput" class="form-label">Username</label>
                                    <input name="name" type="text" class="form-control" id="usernameInput" value="{{ old('name') }}" aria-describedby="usernameHelp" autocomplete="off">
                                    @error('name')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Email Address</label>
                                    <input name="email" type="email" class="form-control" id="emailInput" value="{{ old('email') }}" aria-describedby="emailHelp">
                                    @error('email')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="passwordInput" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" id="passwordInput" aria-describedby="passwordHelp">
                                    @error('password')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="roleInput" class="form-label">Role</label>
                                    <select name="is_admin" id="roleInput" class="form-select" aria-label="Select Role">
                                        <option value="1">Admin</option>
                                        <option selected value="0">Regular</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Add New User</button>
                                <a href="{{ route('admin.users') }}" class="btn btn-primary">View All</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
