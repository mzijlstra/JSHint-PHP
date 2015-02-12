$(function() {
    $('#check').click(function() {
        var input = { 
            'validator': $('select').val(),
            'jsText': $('#jsText').val(), 
            'incjQuery': $('#incjQuery').is(':checked') ? 'on' : 'off' 
        };
        var callback = function( data ) {
           var res = JSON.parse(data);
           $('#result').empty().text(res.output);
        }; 
        $.post('service.php', input, callback);
    });

    $("select").change(function () {
        $("#validator").val($(this).val());
    });
});

