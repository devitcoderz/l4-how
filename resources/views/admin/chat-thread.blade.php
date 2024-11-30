@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Chat</h1>

            @if (Session::has('message'))
                <div style="background-color: {{ Session::get('message')['bg'] }}; padding:5px;">
                    <b>{{ Session::get('message')['msg'] }}</b>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Chat Thread Container -->
                            <div id="chat-thread" class="chat-thread p-3"
                                style="height: 400px; overflow-y: scroll; background-color: #e9eaec; direction: rtl; resize: vertical;">
                                @foreach ($thread->chats as $message)
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="{{ $message->sender == 'admin' ? 'bg-primary text-white' : 'bg-light text-dark' }} p-3 rounded"
                                                style="width: 100%; box-sizing: border-box; padding:10px;">
                                                <p class="m-0">{!! nl2br($message->text) !!}</p>
                                                <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <br>

                            <!-- Input Form for Chat -->
                            <form action="{{ route('admin.chat.thread.answer') }}" method="POST">
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
                                        <button type="button" id="btn-chat-save-to-folder"
                                            data-thread="{{ $thread->id }}" class="btn btn-success p-2">Save to
                                            folder</button>
                                        <button type="button" class="btn btn-warning p-2">Edit</button>
                                        <button type="button" id="btn-print" class="btn btn-info p-2">Print</button>
                                        {{-- <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <input name="customFileName" class="form-control p-2" type="text" placeholder="someFile.pdf" value="{{  }}">
                                        </div>
                                    </div> --}}
                                    </div>
                                    <div class="col-md-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary p-2">Send</button>
                                    </div>
                                </div>

                                <div id="loaderMeter" style="display: none" class="col-12">
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
    <script>
        $(document).ready(function() {
            $(document).on("click", "#btn-chat-save-to-folder", function(e) {
                var btn = $(this);
                btn.html("Saving...");
                var threadId = $(this).data("thread");
                $.ajax({
                    url: "{{ route('admin.chat.thread.save.ajax') }}",
                    type: "post",
                    data: {
                        thread_id: threadId
                    },
                    success: function(response) {
                        console.log(response.msg);
                        btn.html('Save to folder');
                        alert(response.msg);
                    }
                });
            });

            const firstDiv = $('#chat-thread > div:first');

            if (firstDiv.length) {
                firstDiv.css('display', 'none');
            }

            $(document).on('click', '#btn-print', function(e) {
                var lastDiv = $('#chat-thread > div:last')[0];
                var newWin = window.open('', 'Print-Window');

                newWin.document.open();
                newWin.document.write(
                    '<html><head><title>Print</title></head><body onload="window.print()">' + lastDiv
                    .innerHTML + '</body></html>');
                newWin.document.close();

                setTimeout(function() {
                    newWin.close();
                }, 10);
            });

            // Submitting thread to get answer back with whole thread
            $(document).on("submit", "form[action='{{ route('admin.chat.thread.answer') }}']", function(e) {
                e.preventDefault();

                // Show loader
                $('#loaderMeter').show();
                $('#btnHolderDiv').hide();

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: '{{ route('admin.chat.thread.answer') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.code == 200) {
                            // Redirect to the new page
                            // $('#loaderMeter').hide();
                            // $('#btnHolderDiv').show();
                            window.location.href =
                                '{{ route('admin.chat.thread', '') }}' + '/' + response
                                .thread_id;
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



        // Scroll chat to the bottom after loading
        const chatThread = document.getElementById('chat-thread');
        chatThread.scrollTop = chatThread.scrollHeight;
    </script>
@endsection
