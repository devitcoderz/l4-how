@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-1">
            <h1 class="h3 mb-3">Dashboard - Patient Introduction</h1>
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
                                onchange="handleSelectChange('admin')">
                                <option value="">Choose Patient</option>
                                @foreach ($userPatients as $item)
                                    <option value="{{ $item->id }}" {{ isset(Session::get('patientS')->id) && Session::get('patientS')->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('admin.patients.create') }}" class="btn btn-success p-2">
                                <i class="align-middle" data-feather="plus"></i>
                                Add new Patient
                            </a>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6 border rounded-3">
                            @if (Session::has('patientS'))
                                <form id="document-form" action="{{ route('admin.dashboard.docs.upload', Session::get('patientS')->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group files p-3">
                                            <label for="document" class="form-label">Upload Document</label>
                                            <input type="hidden" name="patient_id" value="{{Session::get('patientS')->id}}">
                                            <input name="documents[]" multiple id="document" type="file" class="form-control">
                                            @error('documents')
                                                <p class="form-text text-danger">{{ $message }}</p>
                                            @enderror
                                            <p class="form-text text-danger" id="err-doc"></p>
                                        </div>
                                    </div>
                                    <div class="row form-group p-3">
                                        <button type="submit" class="btn btn-primary p-2">Upload</button>
                                    </div>
                                    <div class="my-progress-bar" id="doc-progress-bar" style="display:none;">
                                        <div class="my-progress-bar-fill"  style="width: 0%;"></div>
                                    </div>
                                      
                                </form>
                            @else
                                <span class="text-warning">No Patient Selected</span>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group files p-3">
                                            <label for="document" class="form-label">Upload Document</label>
                                            <input disabled name="document" id="document" type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group p-3">
                                        <button disabled type="submit" class="btn btn-primary p-2">Upload</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <p class="">Here will be the recorder functionality</p>
                        </div>
                    </div>

                    <br>
<form action="{{ route('admin.chat') }}" method="POST">
    @csrf
                    <div class="row border rounded-3 p-3">
                        @if (Session::has('patientS'))
                        <input type="hidden" name="patient_id" value="{{Session::get('patientS')->id}}">
                            @if (!$documents->isEmpty())
                                <p class="form-text">{{ Session::get('patientS')->name }} Documents</p>
                                <table class="table">
                                    <thead>
                                        <th scope="col">Select</th>
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $doc)
                                            <tr>
                                                <td>
                                                    <input class="form-check-input" name="selectedDocs[]" type="checkbox" value="{{ $doc->text }}">
                                                </td>
                                                <td>{{ $doc->file_name }}</td>
                                                <td>{{ $doc->created_at }}</td>
                                                <td class="col-md-2">
                                                    <a href="{{ Storage::url($doc->file_path) }}"
                                                        class="btn btn-sm btn-primary" target="_blank">
                                                        <i class="align-middle" data-feather="download"></i>
                                                    </a>
                                                    <a href="{{ route('admin.docs.view',$doc->id) }}"
                                                        class="btn btn-sm btn-primary" target="_blank">
                                                        <i class="align-middle" data-feather="eye"></i>
                                                    </a>
                                                    {{-- <form
                                                        action="{{ route('admin.dashboard.docs.delete', ['patient' => $patient->id, 'document' => $doc->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="align-middle" data-feather="trash-2"></i>
                                                        </button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="form-text">{{ Session::get('patientS')->name }} has no Documents</p>
                            @endif
                        @else
                            <p class="form-text">Select patient to see their documents.</p>
                        @endif
                    </div>

                    <br>

                    <div class="row">
                        <div class="form-group">
                            <label class="form-label">Additional Notes</label>
                            <input name="additionalNotes" type="text" class="form-control p-2">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="form-group">
                            <label class="form-label">Prompt List</label>
                            <select name="promptText" class="form-select">
                                <option selected disabled value="">Select Prompt</option>
                                @foreach ($userPrompts as $item)
                                    <option value="{{ $item->description }}">
                                        {{ $item->text }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div id="btnHolderDiv">
                            @if (Session::get('patientS'))
                                <button class="btn btn-primary p-2">Send</button>
                            </form>
                            @endif
                        </div>
                        <div id="loaderMeter" style="display: none;" class="meter green">
                            <span style="width: 99%"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $(document).on("submit", "#document-form", function(e) {
        e.preventDefault();
        $("#err-doc").html(''); // Clear previous error messages
        var formData = new FormData(this);
        var allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png','bmp'];
        var filesValid = true;
        var errorMessage = "";

        // Check if files are selected
        if (formData.getAll('documents[]').length === 0) {
            filesValid = false;
            errorMessage = "Please select files to upload.";
        } else {
            // Validate file extensions
            formData.getAll('documents[]').forEach(function(file) {
                var fileExtension = file.name.split('.').pop().toLowerCase();
                if ($.inArray(fileExtension, allowedExtensions) === -1) {
                    filesValid = false;
                    errorMessage = "Only PDF, JPG, JPEG, and PNG files are allowed.";
                }
            });
        }

        // If files are invalid, display the error message and stop the upload
        if (!filesValid) {
            $("#err-doc").html(errorMessage);
            return false;
        }

        $('#doc-progress-bar').show();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        console.log(evt);
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 70); // Cap at 70%
                        $('#doc-progress-bar div').css("width", percentComplete + "%");
                        $('#doc-progress-bar div').html(percentComplete + "%");
                        $('#doc-progress-bar div').data("progress",percentComplete);
                    }
                }, false)
                return xhr;
            },
            url: '{{ route('admin.dashboard.docs.upload.ajax') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.code == 200) {
                    setInterval(() => {
                        var divPercent = $('#doc-progress-bar div').data("progress");
                        
                        divPercent += 2;
                        $('#doc-progress-bar div').css("width", divPercent+"%");
                        $('#doc-progress-bar div').html(divPercent+"%");
                        $('#doc-progress-bar div').data("progress",divPercent);

                        if(divPercent == 100){
                            window.location.reload(true);
                        }
                        
                    }, 1000);
                   
                } else if (response.code == 202) { // Form error
                    $("#err-doc").html(response.errors);
                } else {
                    alert("Something went wrong.");
                }
            },
            error: function() {
                alert("Upload failed, please try again.");
            }
        });
    });


})
</script>

<script>
$(document).ready(function() {
    $(document).on("submit", "form[action='{{ route('admin.chat') }}']", function(e) {
        e.preventDefault();

        // Show loader

        $('#btnHolderDiv').hide();
        $('#loaderMeter').show();

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: '{{ route('admin.chat') }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.code == 200) {
                    // Redirect to the new page
                    $('#loaderMeter').hide();
                    $('#btnHolderDiv').show();
                    window.location.href = '{{ route('admin.chat.thread', '') }}' + '/' + response.thread_id;
                } else {
                    // Handle errors
                    alert(response.error);
                }
            },
            error: function() {
                $('#btnHolderDiv').show();
                alert("Something went wrong. Please try again.");
            }
        });
    });
});
</script>

<script src="{{ asset('backoffice/js/dashboard.js') }}"></script>
@endsection

@section('styles')
<style>
    .my-progress-bar {
      width: 100%;
      height: 30px;
      background-color: #e0e0e0;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 5px;
    }
  
    .my-progress-bar-fill {
      height: 100%;
      width: 0%;
      background-color: #4caf50;
      color: #fff;
      text-align: center;
      line-height: 30px;
      border-radius: 15px 0 0 15px;
      transition: width 0.3s ease;
    }
  </style>
  
@endsection
