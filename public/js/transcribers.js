/***** get the id of a datalist option ***/
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
