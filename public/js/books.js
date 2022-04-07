// authors
var author = [];

function getAuthor() {
    author["name"] = $("#author").val();
    author["id"] = $('#authors option[value="' + author["name"] + '"]').data(
        "id"
    );
    console.log(author["id"]);
}

// subjects
var subject = [];

function getSubject() {
    subject["name"] = $("#subject").val();
    subject["id"] = $('#subjects option[value="' + subject["name"] + '"]').data(
        "id"
    );
    console.log(subject["id"]);
}
