/***** get the id of a datalist option ***/

// add hidden input contains data-id of selected value (datalist single select)
function getId(input_id, datalist_id, hidden_input_id) {
    var val = $(input_id).val()
    var dataid = $(datalist_id + ' option').filter(function () {
        return this.value === val;
    }).data('id');
    if(dataid == null){
        document.getElementById(hidden_input_id).value = null;
    }else{
        document.getElementById(hidden_input_id).value = dataid;
    }
    console.log(dataid);
}


//add item to array (datalist multiple selection)
function addItem() {
    var val = $(input_id).val(),
        data_id = $(datalist_id +' option[value="' + val + '"]').data('id');

    //if value doesnt exist
    if (jQuery.inArray(data_id, item_ids) === -1 && data_id !== '' && data_id != null) {
        item_ids.push(data_id);
        //add input ids to hidden div
        $(hidden_div_id).empty();
        item_ids.forEach(item => $(hidden_div_id).append('<input type="hidden" name="' + hidden_input_name + '" value="' + item + '">'))
        console.log(item_ids);
    }

    //if value doesnt exist
    if (jQuery.inArray(val, item_names) === -1 && val !== '') {
        item_names.push(val);
        //add badge
        //show selected items from datalist in badges (in datalist with multiple select)
        $(badges_div_id).append('<span id="' + data_id + '" class="badge bg-success py-2 me-2 mt-2 mb-2">' + val + ' <button type="button" class="btn-close btn-close-white"></button></span>');
        $(badges_div_id + ' span[id=' + data_id + '] button').click(function () {
            deleteElement(data_id, val)
        });
        console.log(item_names);
    }
    //set input value to null after select
    $(input_id).val(null)
}


//delete a specific item from hidden_input/badges (in datalist with multiple select)
function deleteElement(item_id, item_name) {
    //delete element id/name from array of ids/names
    item_ids.splice($.inArray(item_id, item_ids), 1);
    item_names.splice($.inArray(item_name, item_names), 1);
    //delete element badge
    $(badges_div_id + ' span[id="' + item_id + '"]').remove();
    //refresh and add new input ids to hidden div
    $(hidden_div_id).empty();
    item_ids.forEach(item => $(hidden_div_id).append('<input type="hidden" name="' + hidden_input_name + '" value="' + item + '">'))

    //reset hidden input value
    $(hidden_div_id).val(item_ids);
}

