require('./bootstrap');


function calc_form_data()
{
    let arr = $('#calc-form input[type="text"], #calc-form select').serializeArray();

    return arr.concat(
        $('#calc-form input[type=checkbox]').map(
            function() {
                return {"name": this.name, "value": this.checked}
            }).get()
    );
}


$('#calculate-button').on('click', function(button) {
    $.get({
        url: '/api/calc',
        data: calc_form_data(),
        complete: function(response) {
            let area = $('#textAreaResult');

            area.parent().removeClass('visually-hidden');
            area.val(JSON.stringify(response.responseJSON, null, 4));
        }
    })
});