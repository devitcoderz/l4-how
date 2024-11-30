<script>
    let route_userChatThreadSaveAjax = "{{ route('user.chat.thread.save.ajax') }}";
    let route_userChatThreadMarkSaveAjax = "{{ route('user.chat.thread.mark.save.ajax') }}";

    $(document).ready(function() {
        $(document).on('click', '.copy-message-btn', function(e) {
            var messageText = '';
            var chats = $(".edit-form");
            $.each(chats,function(i,e){
                if(i != 0){
                    var messageId = $(this).data("id");
                    messageText += $("#editable-text-"+messageId).val();
                    messageText +="\n\n";
                } 
            });
            
            // Create a temporary input element to hold the text
            const tempInput = $('<textarea>');
            $('body').append(tempInput);
            tempInput.val(messageText).select();

            // Copy the text to the clipboard
            document.execCommand('copy');

            // Remove the temporary input element
            tempInput.remove();

            // Optionally, show a confirmation message
            alert('Copied to clipboard!');
        })

        // Edit message button click
        $(document).on("click", ".edit-message-btn", function(e) {
            

            // var messageId = $(this).data("message-id");
            // var messageText = $(this).data("message-text");

            // // Show the edit form for the selected message
            // $("#edit-form-" + messageId).show();
            // $("#message-" + messageId).hide();
            // $(this).hide(); // Hide the edit button when editing

            var btnEdit = $(this);
            var btnCancelEdit = $("#cancel-edit-message-btn");
            var btnSaveEdit = $("#save-edit-message-btn");

            var chats = $(".edit-form");
            $.each(chats,function(i,e){
                var messageId = $(this).data("id");

                // Show the edit form for the selected message
                $("#edit-form-" + messageId).show();
                $("#message-" + messageId).hide();
                btnEdit.hide(); // Hide the edit button when editing
                btnCancelEdit.show();
                btnSaveEdit.show();

            });

            $('textarea').each(function () {
                const textarea = $(this);
                adjustTextareaHeight(textarea);
            
                // Adjust height on input
                textarea.on('input', function () {
                    adjustTextareaHeight(textarea);
                });
            });
            

    
        });

        function adjustTextareaHeight(textarea) {
            textarea.css('height', 'auto'); // Reset the height
            textarea.css('height', `${textarea[0].scrollHeight}px`); // Set to fit content height
        }

        // // Cancel edit button click
        // $(document).on("click", ".cancel-edit", function(e) {
        //     var messageId = $(this).data("message-id");

        //     // Hide the edit form and show the original message again
        //     $("#edit-form-" + messageId).hide();
        //     $("#message-" + messageId).show();
        //     $(".edit-message-btn[data-message-id='" + messageId + "']").show();
        // });

        $(document).on("click","#cancel-edit-message-btn",function(e){
            var btnCancelEdit = $(this);
            var btnEdit = $("#edit-message-btn");
            var btnSaveEdit = $("#save-edit-message-btn");

            var chats = $(".edit-form");
            $.each(chats,function(i,e){
                var messageId = $(this).data("id");
                // hide the edit form for the selected message
                $("#edit-form-" + messageId).hide();
                $("#message-" + messageId).show();
                btnCancelEdit.hide();
                btnSaveEdit.hide();
                btnEdit.show(); // Hide the edit button when editing
            });
        })

        $(document).on("click",'#save-edit-message-btn',function(e){
            var btnSaveEdit = $(this);
            var btnCancelEdit = $("#cancel-edit-message-btn");
            var btnEdit = $("#edit-message-btn");
            btnSaveEdit.hide();
            btnCancelEdit.hide();
            

            var chats = $(".edit-form");
            var post_data = [];
            $.each(chats,function(i,e){
                var messageId = $(this).data("id");
                var message = $("#editable-text-"+messageId).val();
                var ob =  {
                    messageId:messageId,
                    message:message
                };

                post_data.push(ob);
            });

            $.ajax({
                url: "{{route('user.chat.messages.update.ajax')}}",
                type: "post",
                data: {
                    data:post_data
                },
                success: function(response){
                    if(response.success && response.code == 200){
                        window.location.reload(true)
                    }else{
                        btnSaveEdit.show();
                        btnCancelEdit.show();
                    }
                }
            });

            
        })

        const firstDiv = $('#chat-thread > div:first');

        if (firstDiv.length) {
            firstDiv.css('display', 'none');
        }

        // Scroll chat to the bottom after loading
        const chatThread = document.getElementById('chat-thread');
        chatThread.scrollTop = chatThread.scrollHeight;

        $(document).on('click', '#btn-print', function(e) {
            var divContent = $('#chat-thread').clone();
            divContent.find('.edit-message-btn').css('display', 'none');
            var newWin = window.open('', 'Print-Window');

            newWin.document.write('<html><head><meta charset="utf-8">');
            newWin.document.write(
                '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">'
            );

            newWin.document.write(
                '<style>body { -webkit-print-color-adjust: exact; color-adjust: exact; }</style>');
            newWin.document.write('</head><body>');
            newWin.document.write('<div style="direction: ' + PRINT_CONTENT_DIR + ';">');
            newWin.document.write(divContent.html());
            newWin.document.write('</div></body></html>');
            newWin.document.close();
            newWin.focus();
            newWin.print();
            setTimeout(function() {
                newWin.close();
            }, 10);
        });

        function send_chat_req_with_timeout(formData){
            setTimeout(() => {
                $.ajax({
                    url: '{{ route('user.chat.thread.answer') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response2) {
                        if (response2.code == 200) {
                            // success
                            window.location.href =
                            '{{ route('user.chat.thread', '') }}' + '/' + response2.thread_id;
                        }else if(response2.code == 429){ // rate limit on OpenAi
                            $('#delayIndicator').show();
                            send_chat_req_with_timeout(formData)
                        }else{
                            console.log("function")
                            console.log(response2);
                            alert(response2.error)
                        }
                    }
                });
            }, 20000); // 20000 milliseconds = 20 seconds
        }

        // Form submission for replying to a thread
        $(document).on("submit", "form[action='{{ route('user.chat.thread.answer') }}']", function(e) {
            e.preventDefault();

            $('#loaderMeter').show();
            $('#btnHolderDiv').hide();

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: '{{ route('user.chat.thread.answer') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.code == 200) {
                        window.location.href =
                            '{{ route('user.chat.thread', '') }}' + '/' + response.thread_id;
                    }else if(response.code == 429){
                        $('#delayIndicator').show();
                        send_chat_req_with_timeout(formData)
                    }else {
                        console.log("ajax");
                        console.log(response)
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