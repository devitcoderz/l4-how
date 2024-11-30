@extends('user.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-1">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="h3 mb-3">Dashboard - Patient Saved Chats</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    @if (Session::has('patientS'))
                        <p class="h4 bg-white text-dark p-2 rounded-3">{{ Session::get('patientS')->name }}</p>
                    @endif
                </div>
                <div class="col-md-4"></div>
            </div>
            @if (Session::has("message"))
                <div style="background-color: {{Session::get('message')['bg']}}; padding:5px;">
                    <b>{{Session::get('message')['msg']}}</b>
                </div>
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
                            {{-- <a href="{{ route('user.patients.create') }}" class="btn btn-success p-2">
                                <i class="align-middle" data-feather="plus"></i>
                                Add new Patient
                            </a> --}}
                        </div>
                    </div>

                    <br>
                    <div class="row border rounded-3 p-3">
                        @if (Session::get('patientS'))    
                            @if ($threads)
                                <p class="form-text">{{ Session::get('patientS')->name }} Saved Chats</p>
                                <table class="table">
                                    <thead>
                                        <th scope="col">Chats</th>
                                        <th scope="col">Action</th>
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($threads as $k=>$v)
                                            <tr>    
                                                <td>
                                                    <span id="name_{{ $v->id }}">{{ $v->name }}</span>
                                                    <input id="input_{{ $v->id }}" type="text" value="{{ $v->name }}" class="custom-input" style="display: none;">
                                                    <a id="link_{{ $v->id }}" href="#" onclick="handleNameEdit(event, {{ $v->id }})" class="text-primary">
                                                        <i id="icon_{{ $v->id }}" class="align-middle" data-feather="edit"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.chat.thread',$v->id) }}"
                                                        class="btn btn-sm btn-primary" target="_blank">
                                                        <i class="align-middle" data-feather="eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="form-text">{{ Session::get('patientS')->name }} has no saved chats</p>
                            @endif
                        @else
                            <p class="form-text">Select patient to see their saved chats.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script src="{{ asset('backoffice/js/patient-saved-threads.js') }}"></script>
@endsection
