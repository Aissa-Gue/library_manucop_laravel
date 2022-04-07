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

//************ Switch between transDate range/exact ************//

$("#transDate_range").hide();
$("#transDate_range_m").hide();

function hide_range() {
    localStorage.setItem("transDate_range", "off");
    $("#transDate_exact").show(400);
    $("#transDate_exact_m").show(400);
    $("#transDate_range").hide(400);
    $("#transDate_range_m").hide(400);

    $("#transDate_range input").val(null);
    $("#transDate_range_m input").val(null);
}

function hide_exact() {
    localStorage.setItem("transDate_range", "on");
    $("#transDate_range").show(400);
    $("#transDate_range_m").show(400);
    $("#transDate_exact").hide(400);
    $("#transDate_exact_m").hide(400);

    $("#transDate_exact input").val(null);
    $("#transDate_exact select").prop("selectedIndex", 0);
    $("#transDate_exact_m input").val(null);
    $("#transDate_exact_m select").prop("selectedIndex", 0);
}

$("#hide_Exact").click(function () {
    hide_range();
});
$("#hide_range").click(function () {
    hide_exact();
});

setInterval(() => {
    if (localStorage.getItem("transDate_range") == "off") {
        hide_range();
    } else if (localStorage.getItem("transDate_range") == "on") {
        hide_exact();
    }
}, 0);

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
