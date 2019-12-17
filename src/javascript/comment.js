"use strict";
if (document.getElementById('comment_form') != null) {
    document.getElementById('comment_form').addEventListener('submit', function (event) {
        let comment = document.getElementById("commentTextArea").value;
        let rate = document.querySelector(".rate input").value;
        let request = new XMLHttpRequest();
        request.open('post', '../actions/action_add_comment.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        //request.addEventListener('load', reload_comment_section);
        request.onload = reload_comment_section;
        request.send(encodeForAjax({ 'comment': comment , 'rate': rate}));
        event.preventDefault();
    });
}

function reload_comment_section() {
    console.log(this.responseText);
    let data = JSON.parse(this.responseText);
    console.log(data);

    let comment_section = document.getElementsByClassName('all_comments')[0];
    let comments_container = document.getElementById('allComments');
    document.querySelector('#comment_form_container').remove();
    let comment = document.createElement('div');
    
    comment.innerHTML = '<div class="comment_header"> </div>' +
    '<div class = "comment_content_container">' + data['name'] + '</div>';

    comment_section.appendChild(comment);
}
