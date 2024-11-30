@extends('user.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row pb-3">
                <div class="col-md-4">
                    <h1 class="h3 mb-3">Chat</h1>
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

            @if (Session::has('message'))
                <div style="background-color: {{ Session::get('message')['bg'] }}; padding:5px;">
                    <b>{{ Session::get('message')['msg'] }}</b>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row pb-4">
                                <div class="col-md-12 d-flex justify-content-end align-items-end">
                                    <!-- Edit button (visible to both user and AI messages) -->
                                    <button id="edit-message-btn" class="btn btn-sm btn-secondary edit-message-btn"
                                        style="position: absolute; top: 10px; right: 70px;">
                                        Edit
                                    </button>
                                    <button id="cancel-edit-message-btn" class="btn btn-sm btn-secondary cancel-edit-message-btn"
                                        style="position: absolute; top: 10px; right: 120px; display:none;">
                                        Cancel Edit
                                    </button>

                                    <button id="save-edit-message-btn" class="btn btn-sm btn-secondary save-edit-message-btn"
                                        style="position: absolute; top: 10px; right: 70px; display:none;">
                                        Save
                                    </button>

                                    <!-- Edit button (visible to both user and AI messages) -->
                                    <button class="btn btn-sm btn-secondary copy-message-btn"
                                        style="position: absolute; top: 10px; right: 10px;">
                                        Copy
                                    </button>
                                </div>
                            </div>
                            <!-- Chat Thread Container -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="chat-thread" class="chat-thread p-3"
                                        style="height: 400px; overflow-y: scroll; background-color: #e9eaec; direction: rtl; resize: vertical;">
                                        @foreach ($thread->chats as $message)
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="{{ $message->sender == 'user' ? 'bg-primary text-white' : 'bg-light text-dark' }} p-3 rounded"
                                                        style="width: 100%; box-sizing: border-box; padding:10px; position: relative;">
                                                        <p id="message-{{ $message->id }}">{!! nl2br($message->text) !!}
                                                        </p>
                                                        <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                                                        

                                                        <!-- Edit form (hidden initially) -->
                                                        <div class="edit-form" data-id="{{ $message->id }}" id="edit-form-{{ $message->id }}"
                                                            style="display: none;">
                                                            <form action="{{ route('user.chat.thread.edit', $message->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <textarea id="editable-text-{{$message->id}}" name="updated_text" class="form-control mb-2 edit-message-textarea" rows="2">{{ $message->text }}</textarea>
                                                                {{-- <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                                <button type="button" class="btn btn-secondary btn-sm cancel-edit"
                                                                    data-message-id="{{ $message->id }}">Cancel</button> --}}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- Input Form for Chat -->
                            <form action="{{ route('user.chat.thread.answer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="thread_id" value="{{ $thread->id }}">

                                <br>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label">Your Message</label>
                                        <textarea name="answer" id="answer" class="form-control" rows="4" style="direction: rtl; text-align: right;"
                                            placeholder="Type your message here..."></textarea>
                                    </div>
                                </div>

                                <br>

                                <div id="btnHolderDiv" class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                {{-- Save Folder --}}
                                                <button type="button" id="btn-chat-save-to-folder"
                                                    class="btn btn-success p-2">Save to folder</button>
                                                <input id="input_save-to-folder"
                                                    placeholder="Enter a file name or leave blank for default"
                                                    type="text" value="{{ $thread->name }}" class="custom-input"
                                                    style="display: none; width: 40%;">
                                                <a id="link_save-to-folder" href="#" style="display: none;"
                                                    onclick="saveToFolder(event, {{ $thread->id }})"
                                                    class="text-success pe-1">
                                                    <i id="icon_{{ $thread->id }}" class="align-middle"
                                                        data-feather="check-square"></i>
                                                    <span class="border-start"></span>
                                                </a>
                                                <a id="cancel_save-to-folder" href="#" style="display: none;"
                                                    onclick="cancelSaveToFolder(event)" class="text-danger">
                                                    <i class="align-middle" data-feather="x-square"></i>
                                                </a>
                                                <span id="_chunk" style="display: none;" class="ps-3"></span>

                                                {{-- Save Chat --}}
                                                @if ($thread->save == 0)
                                                    <span id="_chunk1" style="display: none;" class="pe-3"></span>
                                                    <button type="button" id="btn-save-chat"
                                                        data-thread="{{ $thread->id }}"
                                                        class="btn btn-success p-2">Save Chat</button>
                                                    <input id="input_save-chat"
                                                        placeholder="Enter a chat name or leave blank for default"
                                                        type="text" value="{{ $thread->name }}" class="custom-input"
                                                        style="display: none; width: 40%;">
                                                    <a id="link_save-chat" href="#" style="display: none;"
                                                        onclick="saveChat(event, {{ $thread->id }})"
                                                        class="text-success pe-1">
                                                        <i id="icon_{{ $thread->id }}" class="align-middle"
                                                            data-feather="check-square"></i>
                                                        <span class="border-start"></span>
                                                    </a>
                                                    <a id="cancel_save-chat" href="#" style="display: none;"
                                                        onclick="cancelSaveChat(event)" class="text-danger">
                                                        <i class="align-middle" data-feather="x-square"></i>
                                                    </a>
                                                    <span id="_chunk2" style="display: none;" class="pe-3"></span>
                                                    <button type="button" id="btn-print"
                                                        class="btn btn-info p-2">Print</button>
                                                @else
                                                    <button type="button" id="btn-print"
                                                        class="btn btn-info p-2">Print</button>
                                                    <span class="ps-3 border-start border-start-3"
                                                        id="name_rename">{{ $thread->name }}</span>
                                                    <input id="input_rename" type="text" value="{{ $thread->name }}"
                                                        class="custom-input" style="width:40%; display: none;">
                                                    <a id="link_rename" href="#"
                                                        onclick="handleNameEdit(event, {{ $thread->id }})"
                                                        class="text-primary">
                                                        <i id="icon_rename" class="align-middle" data-feather="edit"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary p-2">Send</button>
                                    </div>

                                </div>

                                <div id="loaderMeter" style="display: none" class="col-12">
                                    <p id="delayIndicator" style="display: none;" class="h3 text-warning">Your request is being processed. Please bear with us for a moment!</p>
                                    <div class="meter green p-2">
                                        <span style="width 100%;"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('backoffice/js/dashboardChat.js') }}"></script>
    @include('user.includes.js.chat-thread-js')
@endsection

@section('styles')
    <style>
        .custom-input {
            /* display: block; */
            width: 80%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .custom-input:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.05rem rgba(0, 123, 255, 0.25);
        }

        /* .edit-message-textarea {
            overflow-y: hidden;
            resize: none;
        } */
    </style>
@endsection
