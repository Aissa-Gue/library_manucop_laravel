// add descent
if (!a) {
    var a = 2;
}
$("#addDescent").click(function () {
    if (a <= 5) {
        var html = "";
        html += '<div class="col-md-2">';
        html += '<label for="descent" class="form-label">&nbsp;</label>';
        html +=
            '<input type="text" class="form-control" name="descent' +
            a +
            '" id="descent" placeholder = "أدخل النسبة ' +
            a +
            '" >';
        html += "</div>";
        //$('#addDescent').append(html);
        $(html).insertBefore("#addDescent");
        if (a == 5) $("#addDescent").remove();
        a++;
    }
});

// add other transcriber name
if (!b) {
    var b = 2;
}
$("#addOther_name").click(function () {
    if (b <= 4) {
        var html = "";
        html += '<div class="col-md-8">';
        html +=
            '<input type="text" class="form-control mt-2" name="other_name' +
            b +
            '" id="other_name" placeholder="أدخل الصيغة ' +
            b +
            '" >';
        html += "</div>";
        $(html).insertBefore("#addOther_name");
        $("#addOther_name").css("margin-top", "17px");
        if (b == 4) $("#addOther_name").remove();
        b++;
    }
});
