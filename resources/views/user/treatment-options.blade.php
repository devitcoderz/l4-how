@extends('user.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-1">
            <div class="row pb-3">
                <div class="col-md-4">
                    <h1 class="h3 mb-3">Dashboard - Treatment Options</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    @if (Session::has('patientS'))
                        <p class="h4 bg-white text-dark p-2 rounded-3">{{ Session::get('patientS')->name }}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group row g-0">
                        <label class="col-sm col-form-label">Select Content Direction</label>
                        <select id="dir-select" class="col-sm form-select">
                            <option selected value="1">Right to Left</option>
                            <option value="2">Left to Right</option>
                        </select>
                    </div>
                </div>
            </div>
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
                                onchange="handleSelectChange('user')">
                                <option value="">Choose Patient</option>
                                @foreach ($userPatients as $item)
                                    <option value="{{ $item->id }}" {{ isset($patient->id) && $patient->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if (isset($patient->id))
                            <a href="{{ route('user.treatment.patient.update',$patient->id) }}" class="btn btn-success p-2">
                                <i class="align-middle" data-feather="refresh-ccw"></i>
                                Update
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div id="div-content" class="col-md-12" dir="rtl">
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