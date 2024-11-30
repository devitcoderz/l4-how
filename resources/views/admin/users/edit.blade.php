@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">User Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit User</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="usernameInput" class="form-label">Username</label>
                                    <input name="name" type="text" class="form-control" id="usernameInput" value="{{ $user->name }}" aria-describedby="usernameHelp">
                                    @error('name')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Email Address</label>
                                    <input name="email" type="email" class="form-control" id="emailInput" value="{{ $user->email }}" aria-describedby="emailHelp">
                                    @error('email')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="passwordInput" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" id="passwordInput" aria-describedby="passwordHelp">
                                    @if($errors->has('password'))
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @else
                                        <div id="passwordHelp" class="form-text">Leave the password field blank if you don't want to change it.</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="roleInput" class="form-label">Role</label>
                                    <select name="is_admin" id="roleInput" class="form-select" aria-label="Select Role">
                                        <option {{ $user->is_admin ? 'selected' : '' }} value="1">Admin</option>
                                        <option {{ $user->is_admin ? '' : 'selected' }} value="0">Regular</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
