var PRINT_CONTENT_DIR = "rtl";

function handleCopyToClipboard()
{
    var textarea = document.getElementById("answer");
    
    textarea.select();
    textarea.setSelectionRange(0, 99999);
    
    document.execCommand("copy");
    
    alert("Text copied!");
}

function handleEditButton()
{
    var textarea = document.getElementById("answer");

    textarea.removeAttribute("readonly");
    textarea.focus();
}

const visibleTextarea = document.getElementById("answer");
const hiddenTextarea = document.getElementById("content");

visibleTextarea.addEventListener('input', function(){
    hiddenTextarea.value = visibleTextarea.value;
});

$(document).on("change", "#dir-select", function () {
    let ThreadDIV = $("#chat-thread");
    let selectedValue = $(this).val();

    if (selectedValue == 1)
    {
        ThreadDIV.css("direction", "rtl");
        PRINT_CONTENT_DIR = "rtl";
    }
    else if (selectedValue == 2)
    {
        ThreadDIV.css("direction", "ltr");
        PRINT_CONTENT_DIR = "ltr";
    }
    else
    {
        alert("Something went wrong with Direction change.");
    }
});

function handleNameEdit(event, id)
{
    event.preventDefault();

    let nameE = document.getElementById("name_rename");
    let inputE = document.getElementById("input_rename");
    let linkE = document.getElementById("link_rename");
    let iconE = document.getElementById("icon_rename");

    if (inputE.style.display == "none")
    {
        nameE.style.display = "none";
        inputE.style.display = "inline-block";
        linkE.classList.remove('text-primary');
        linkE.classList.add('text-success');
        iconE.setAttribute("data-feather", "check-square");
        feather.replace();

        inputE.focus();
        const length = inputE.value.length;
        inputE.setSelectionRange(length, length);
    }
    else
    {
        nameE.style.display = "inline-block";
        inputE.style.display = "none";
        linkE.classList.remove('text-success');
        linkE.classList.add('text-primary');
        iconE.setAttribute("data-feather", "edit");
        feather.replace();

        updateFileName(id, inputE, nameE);
    }
}

function updateFileName(id, inputE, nameE)
{
    let pName = nameE.innerHTML;
    nameE.innerHTML = 'Changing Name...';

    if (pName != inputE.value)
    {
        $.ajax({
            url: '/user/chat/thread/'+ id +'/update-name',
            type: 'PUT',
            data: {
                name: inputE.value
            },
            success: function (response) {
                if(response.success)
                {
                    nameE.innerHTML = inputE.value;
                }
                else
                {
                    nameE.innerHTML = pName;
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }
    else
    {
        nameE.innerHTML = pName;
    }
}


// |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// Save chat to folder functionality
$(document).on("click", "#btn-chat-save-to-folder", function(e) {
    btnSaveToFolderToggle(false);
    btnSaveChatToggle(true);
});

function btnSaveToFolderToggle(show)
{
    let btn = $("#btn-chat-save-to-folder");
    let chunk = $('#_chunk');
    let input_name = $("#input_save-to-folder");
    let link_btn = $("#link_save-to-folder");
    let cancelBtn = $('#cancel_save-to-folder');

    show ? btn.show() : btn.hide();
    show ? input_name.hide() : input_name.show();
    show ? link_btn.hide() : link_btn.show();
    show ? cancelBtn.hide() : cancelBtn.show();
    show ? chunk.hide() : chunk.show();
}

function saveToFolder(event, threadId)
{
    event.preventDefault();

    let input_name = $("#input_save-to-folder");   
    $.ajax({
        url: route_userChatThreadSaveAjax,
        type: "post",
        data: {
            thread_id: threadId,
            name: input_name.val()
        },
        success: function(response) {
            btnSaveToFolderToggle(true);
            alert(response.msg);
        }
    });
}

// $('#input_save-to-folder').on('input', function() {
//     // Allowed characters: letters, numbers, spaces, underscores, dashes, and dots
//     const safePattern = /^[a-zA-Z0-9 _.-]*$/;
//     let inputValue = $(this).val();

//     // Check for invalid characters
//     if (!safePattern.test(inputValue)) {
//         // Remove invalid characters
//         $(this).val(inputValue.replace(/[^a-zA-Z0-9 _.-]/g, ''));
//         alert("Invalid character removed. Please use only letters, numbers, spaces, underscores, dashes, or dots.");
//     }
// });

function cancelSaveToFolder(event)
{
    event.preventDefault();

    let chunk = $('#_chunk');
    let cancelBtn = $('#cancel_save-to-folder');
    let btn = $("#btn-chat-save-to-folder");
    let input_name = $("#input_save-to-folder");
    let link_btn = $("#link_save-to-folder");

    input_name.val('');

    btn.show();
    input_name.hide();
    link_btn.hide();
    cancelBtn.hide();
    chunk.hide();
}
// |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||


// ========================================================================
$(document).on("click", "#btn-save-chat", function(e) {
    btnSaveChatToggle(false);
    btnSaveToFolderToggle(true);
})

function btnSaveChatToggle(show)
{
    let btn = $("#btn-save-chat");
    let chunk1 = $('#_chunk1');
    let chunk2 = $('#_chunk2');
    let cancelBtn = $('#cancel_save-chat');
    let input_name = $("#input_save-chat");
    let link_btn = $("#link_save-chat");

    show ? btn.show() : btn.hide();
    show ? input_name.hide() : input_name.show();
    show ? link_btn.hide() : link_btn.show();
    show ? cancelBtn.hide() : cancelBtn.show();
    show ? chunk1.hide() : chunk1.show();
    show ? chunk2.hide() : chunk2.show();
}

function saveChat(event, threadId)
{
    event.preventDefault();

    let input_name = $("#input_save-chat");

    $.ajax({
        url: route_userChatThreadMarkSaveAjax,
        type: "post",
        data: {
            thread_id: threadId,
            name: input_name.val()
        },
        success: function(response) {
            btnSaveChatToggle(true);
            // alert(response.msg);
            window.location.reload(true)
        }
    });
}

// $('#input_save-chat').on('input', function() {
//     // Allowed characters: letters, numbers, spaces, underscores, dashes, and dots
//     const safePattern = /^[a-zA-Z0-9 _.-]*$/;
//     let inputValue = $(this).val();

//     // Check for invalid characters
//     if (!safePattern.test(inputValue)) {
//         // Remove invalid characters
//         $(this).val(inputValue.replace(/[^a-zA-Z0-9 _.-]/g, ''));
//         alert("Invalid character removed. Please use only letters, numbers, spaces, underscores, dashes, or dots.");
//     }
// });

function cancelSaveChat(event)
{
    event.preventDefault();

    let chunk1 = $('#_chunk1');
    let chunk2 = $('#_chunk2');
    let cancelBtn = $('#cancel_save-chat');
    let btn = $("#btn-save-chat");
    let input_name = $("#input_save-chat");
    let link_btn = $("#link_save-chat");

    input_name.val('');

    btn.show();
    input_name.hide();
    link_btn.hide();
    cancelBtn.hide();
    chunk1.hide();
    chunk2.hide();
}
// ========================================================================