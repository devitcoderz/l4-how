@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">User Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Users</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" title="{{ $user->name }}" rel="noopener">{{ $user->email }}</a>
                                            </td>
                                            <td>{{ $user->is_admin ? "Admin" : "Regular" }}</td>
                                            <td class="col-md-2">
                                                <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit', $user->id) }}" title="Edit">
                                                    <i class="align-middle" data-feather="edit"></i>
                                                </a>
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                                <a class="btn btn-sm btn-info" href="{{ route('admin.users.patients', $user->id) }}" title="Patients">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a class="btn btn-success" href="{{ route('admin.users.create') }}">Add New User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
