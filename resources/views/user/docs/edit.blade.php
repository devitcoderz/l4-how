@extends('user.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Document Management</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.docs.patients', $patient) }}" method="POST">
                            @csrf
                            <div class="mb-1">
                                <label for="patient-select" class="form-label">Select Patient</label>
                                <select name="selectedPatient" id="patient-select" class="form-select choices-single" data-live-search="true" aria-label="Select a Patient">
                                    @foreach ($userPatients as $item)
                                        <option {{ $item == $patient ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedPatient')
                                    <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <button type="submit" class="btn btn-success">View Documents</button>
                            </div>
                        </form>
                        <br>
                        <div class="p-3">
                            <div class="mb-1 border p-3 rounded-3">
                                <form action="{{ route('user.docs.upload', $patient->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="document" class="form-label">Upload Document</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="file" name="document" id="document" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-primary">Upload Document</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mb-1 border p-3 rounded-3">
                                <label class="form-label fw-bold">{{ Session::get('patientS')->name }} Documents</label>
                                <table class="table">
                                    <thead>
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $doc)
                                            <tr>
                                                <td>{{ $doc->file_name }}</td>
                                                <td>{{ $doc->created_at }}</td>
                                                <td class="col-md-2">
                                                    <a href="{{ Storage::url($doc->file_path) }}" class="btn btn-sm btn-primary" target="_blank">
                                                        <i class="align-middle" data-feather="eye"></i>
                                                    </a>
                                                    <form action="{{ route('user.docs.delete', ['patient' => $patient->id, 'document' => $doc->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
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
        </div>
    </div>
</main>
@endsection