@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Patient Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{Session::get('patientS')->name}}'s Documents</h5>
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
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->documents as $k=>$v)
                                        <tr>
                                            <th scope="row">{{ $v->id }}</th>
                                            <td>{{ $v->file_name }}</td>
                                            <td>{{ $v->created_at }}</td>
                                            <td class="col-md-2">
                                                <a href="{{ Storage::url($v->file_path) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="align-middle" data-feather="download"></i>
                                                </a>
                                                <a href="{{ route('admin.docs.view',$v->id) }}"
                                                    class="btn btn-sm btn-info" target="_blank">
                                                    <i class="align-middle" data-feather="eye"></i>
                                                </a>
                                                <form action="{{ route('admin.users.patients.documents.delete', [$patient->user->id,$patient->id,$v->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                               
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
