@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Prompt Management</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 border-end p-3">
                                    <p class="h4 text-secondary">Patient Introduction Prompts</p>
                                    <form action="{{ route('admin.prompts.update', $prompt) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-1">
                                            <label class="form-label fw-bold">Update Prompt</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="text" class="form-control"
                                                value="{{ $prompt->text }}" placeholder="Enter prompt text">
                                        </div>
                                        <div class="mb-3">
                                            <textarea rows="4" name="description" class="form-control" placeholder="Enter prompt description">{{ $prompt->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="align-middle" data-feather="check"></i>
                                            <span class="align-middle">Update</span>
                                        </button>
                                    </form>
                                    <br>
                                    <br>
                                    <h5 class="card-title mb-0">Prompts</h5>
                                    <br>
                                    @include('admin.includes.promptList')
                                </div>
                                <div class="col-md-6 p-3">
                                    <form action="{{ route('admin.prompts.others') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <p class="h4 text-secondary">Other Prompts</p>

                                        <div class="form-group pb-3">
                                            <label class="form-label" for="diagnoseSummary">Diagnose Summary Prompt</label>
                                            <textarea placeholder="No prompt is set for Diagnose Summary" class="form-control" name="diagnoseSummary"
                                                id="diagnoseSummary" rows="5">{{ $otherPrompts->diagnose_summary }}</textarea>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label class="form-label" for="treatmentOptions">Treatment Options
                                                Prompt</label>
                                            <textarea placeholder="No prompt is set for Treatment Options" class="form-control" name="treatmentOptions"
                                                id="treatmentOptions" rows="4">{{ $otherPrompts->treatment_options }}</textarea>
                                        </div>

                                        <button class="btn btn-success" type="submit">Update Prompts</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
