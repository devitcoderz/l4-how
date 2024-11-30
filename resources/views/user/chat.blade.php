@extends('user.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Chat</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.chat.answer') }}" method="POST">
                            @csrf
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
                                <div class="form-group">
                                    <label class="form-label">Answer</label>
                                    <textarea style="direction: rtl; text-align: right;" name="answer" id="answer" class="form-control" rows="10" {{ $finalText != null ? 'readonly' : '' }}>{{ $finalText != null ? $finalText : '' }}</textarea>
                                </div>
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
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <div class="row">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-outline-secondary p-2">Chat</button>
                                        </div>
                                    </form>
                                        <div class="col-auto">
                                            <button type="button" onclick="handleEditButton()" class="btn btn-outline-secondary p-2">Edit</button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="handleCopyToClipboard()" class="btn btn-secondary p-2" >Copy</button>
                                        </div>

                                        <form action="{{ route('user.chat.download') }}" method="POST" class="col-auto d-inline">
                                            @csrf
                                            {{-- <input type="hidden" name="content" value="{{ $finalText != null ? $finalText : '' }}"> --}}
                                            <textarea style="direction: rtl; text-align: right;" name="content" id="content" rows="10" hidden>{{ $finalText != null ? $finalText : '' }}</textarea>
                                            <button type="submit" class="btn btn-success p-2">Save to Patient Folder</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    <script src="{{ asset('backoffice/js/dashboardChat.js') }}"></script>
@endsection
