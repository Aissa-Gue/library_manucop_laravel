/********** subjects : in book_search component **********/
var subject_name = [],
    subjects = [];

function setSubjects() {
    $("#hiddenInputsSubject").empty();
    subjects.forEach((element) => {
        $("#hiddenInputsSubject").append(
            '<input type="hidden" name="subjects[]" value="' + element + '">'
        );
    });
}

function getSubject() {
    subject_name = $("#subject").val();
    if (!subjects.includes(subject_name)) {
        subjects.push(subject_name);
    }
    console.log(subject);
}

function deleteSubject(val) {
    subjects.splice($.inArray(val, subjects), 1);
    setSubjects();
}

/********** Authors : in book_search component **********/
var author_name = [],
    authors = [];

function setAuthors() {
    $("#hiddenInputsAuthor").empty();
    authors.forEach((element) => {
        $("#hiddenInputsAuthor").append(
            '<input type="hidden" name="authors[]" value="' + element + '">'
        );
    });
}

function getAuthor() {
    author_name = $("#author").val();
    if (!authors.includes(author_name)) {
        authors.push(author_name);
    }
    console.log(author);
}

function deleteAuthor(val) {
    author.splice($.inArray(val, author), 1);
    setAuthors();
}
