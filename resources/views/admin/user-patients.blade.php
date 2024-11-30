@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">User Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{$user->name}}'s Patients</h5>
                            @if (Session::has('message'))
                            <div style="background-color: {{Session::get('message')['color']}};">
                                {{Session::get('message')['msg']}}
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->patients as $k=>$v)
                                        <tr>
                                            <th scope="row">{{ $v->id }}</th>
                                            <td>{{ $v->name }}</td>
                                            <td class="col-md-2">
                                                <form action="{{ route('admin.users.patients.delete', [$user->id,$v->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                                <a class="btn btn-sm btn-info" href="{{ route('admin.users.patients.documents', [$user->id,$v->id]) }}" title="Documents">
                                                    <i class="align-middle" data-feather="file"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
