@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-1">
            <h1 class="h3 mb-3">Dashboard - Treatment Options</h1>
            @if (Session::has("message"))
            <div style="background-color:{{Session::get('message')['color']}} ;">{{Session::get('message')['msg']}}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="choosePatient" class="form-label h3">Choose Patient</label>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <select id="choosePatient" class="form-select me-3 p-2" style="width: 35%"
                                onchange="handleSelectChange('admin')">
                                <option value="">Choose Patient</option>
                                @foreach ($userPatients as $item)
                                    <option value="{{ $item->id }}" {{ isset($patient->id) && $patient->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if (isset($patient->id))
                            <a href="{{ route('admin.treatment.patient.update',$patient->id) }}" class="btn btn-success p-2">
                                <i class="align-middle" data-feather="refresh-ccw"></i>
                                Update
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" dir="rtl">
                            <hr>
                            {!! $treatmentOptions !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('backoffice/js/treatment-options.js') }}"></script>
@endsection