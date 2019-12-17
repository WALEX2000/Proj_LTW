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
    document.querySelector('#comment_form_container').remove();
    let comment = document.createElement('div');
    comment.setAttribute('class', 'comment_container');
    
    let given_starts = "";
    for(let i = 0; i < data['rate']; i++){
        given_starts +="★";
    }

    let left_starts = "";
    for(let i = 0; i < 5 - data['rate']; i++){
        left_starts +="★";
    }

    comment.innerHTML = "" +
        '<div class = "comment_header">'+
            '<div class="rating_display">'+
                '<div class="rating_given_display">'+
                    given_starts +
                '</div>' +
                '<div class="rating_left_display">'+ 
                    left_starts+
                '</div>' + 
            '</div>' +
            '<div class="cropper">' +
            '<img class="profileImg" src="../../images/' + data['pic'] + '" alt="Commenter\'s profile image" />' +
            '</div>' +
            '<p class="name">' + data['username'] + '</p>' +
            '<p class="commentDate">'  + data['comment_date'] + '</p>' +
        '</div>' +
        '<div class="comment_content_container">' +
        data['comment_content'] + 
        '</div>';

    comment_section.insertBefore(comment, comment_section.childNodes[0]);
}
