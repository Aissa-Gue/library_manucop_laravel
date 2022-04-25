//get transcriber1 data-id
$("#transcriber1").change(function () {
    transcriber1_id = $(
        '#transcribers1 option[value="' + $("#transcriber1").val() + '"]'
    ).data("id");
});
//get transcriber2 data-id
$("#transcriber2").change(function () {
    transcriber2_id = $(
        '#transcribers2 option[value="' + $("#transcriber2").val() + '"]'
    ).data("id");
});
//get transcriber3 data-id
$("#transcriber3").change(function () {
    transcriber3_id = $(
        '#transcribers3 option[value="' + $("#transcriber3").val() + '"]'
    ).data("id");
});
//get transcriber4 data-id
$("#transcriber4").change(function () {
    transcriber4_id = $(
        '#transcribers4 option[value="' + $("#transcriber4").val() + '"]'
    ).data("id");
});

var fontMatcher1 = [],
    fontMatcher2 = [],
    fontMatcher3 = [],
    fontMatcher4 = [];

function getFontMatcher1() {
    fontMatcher1["name"] = $("#fontMatcher1").val();
    fontMatcher1["id"] = $(
        '#fontMatchers1 option[value="' + fontMatcher1["name"] + '"]'
    ).data("id");
}

function getFontMatcher2() {
    fontMatcher2["name"] = $("#fontMatcher2").val();
    fontMatcher2["id"] = $(
        '#fontMatchers2 option[value="' + fontMatcher2["name"] + '"]'
    ).data("id");
}

function getFontMatcher3() {
    fontMatcher3["name"] = $("#fontMatcher3").val();
    fontMatcher3["id"] = $(
        '#fontMatchers3 option[value="' + fontMatcher3["name"] + '"]'
    ).data("id");
}

function getFontMatcher4() {
    fontMatcher4["name"] = $("#fontMatcher4").val();
    fontMatcher4["id"] = $(
        '#fontMatchers4 option[value="' + fontMatcher4["name"] + '"]'
    ).data("id");
}

/********** Step 02 **********/

//get book data-id
$("#book").change(function () {
    book_id = $('#books option[value="' + $("#book").val() + '"]').data("id");
});

//get cabinet data-id
$("#cabinet").change(function () {
    cabinet_id = $(
        '#cabinets option[value="' + $("#cabinet").val() + '"]'
    ).data("id");
});

//get city data-id
$("#city").change(function () {
    city_id = $('#cities option[value="' + $("#city").val() + '"]').data("id");
});

//get country data-id
$("#country").change(function () {
    country_id = $(
        '#countries option[value="' + $("#country").val() + '"]'
    ).data("id");
});

/********** Step 03 **********/

var motif = [],
    color = [],
    manutype = [];

function getMotif() {
    motif["name"] = $("#motif").val();
    motif["id"] = $('#motifs option[value="' + motif["name"] + '"]').data("id");
}

function getColor() {
    color["name"] = $("#color").val();
    color["id"] = $('#colors option[value="' + color["name"] + '"]').data("id");
}

function getManutype() {
    manutype["name"] = $("#manutype").val();
    manutype["id"] = $(
        '#manutypes option[value="' + manutype["name"] + '"]'
    ).data("id");
}

/********** Step 04 **********/
window.addEventListener("reloadScripts", (event) => {
    //$(".multidatalist").val(null)
});
