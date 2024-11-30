@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Patient Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Patient</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.patients.update', Session::get('patientS'))}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nameInput" class="form-label">Name</label>
                                    <input name="name" value="{{ Session::get('patientS')->name }}" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp">
                                    @error('name')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success">Update Patient</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection