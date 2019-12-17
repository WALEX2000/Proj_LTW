"use strict";
if (document.getElementById('reply_form') != null) {
    document.getElementById('reply_form').addEventListener('submit', function (event) {
        let reply_content = document.getElementById("commentTextArea").value;
        let comment = document.getElementsByName("comment")[0].value;
        console.log(comment);
        let request = new XMLHttpRequest();
        request.open('post', "../actions/action_add_reply.php" , true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onload = reload_reply_section;
        request.send(encodeForAjax({ 'reply_content': reply_content , 'comment': comment}));
        event.preventDefault();
    });
}

function reload_reply_section() {
    let data = JSON.parse(this.responseText);
    console.log(data);

    let reply_section = document.getElementsByClassName('comment_container')[0];
    document.querySelector('#reply_form_container').remove();
    let reply = document.createElement('div');
    reply.setAttribute('class', 'reply_container');

    reply.innerHTML = "" +
            '<div class="comment_header">' +
                '<div class="cropper">' +
                    '<img class="profileImg" src="../../images/' + data['pic'] + '" alt="Commenter\'s profile image" />' +
                '</div>' +
            '<p class="name extraWidth">' + data['name'] + '</p>' +
            data['reply_date'] +
            '</div>' +
            '<div class="comment_content_container">' +
            data['reply_content'] + 
            '</div>';

    reply_section.append(reply, reply_section.childNodes[0]);
}