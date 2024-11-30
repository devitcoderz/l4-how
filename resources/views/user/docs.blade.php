@extends('user.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Document Management</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.docs.patients') }}" method="POST">
                            @csrf
                            <div class="mb-1">
                                <label for="patient-select" class="form-label">Select Patient</label>
                                <select name="selectedPatient" id="patient-select" class="form-select choices-single" data-live-search="true" aria-label="Select a Patient">
                                    <option selected disabled>- No patient selected -</option>
                                    @foreach ($userPatients as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <div class="mb-1">
                                <label class="form-label fw-bold">No patient selected, select one to see their documents.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection