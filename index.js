plaap = poep

$(function() {
    $('#check').click(function() {
        var input = { 
            'jsText': $('#jsText').val(), 
            'incjQuery': $('#incjQuery').is(':checked') ? 'on' : 'off' 
        };
        var callback = function( data ) {
           var res = $.parseJSON(data);
           $('#result').html(res.output);
        }; 
        $.post('service.php', input, callback);
    });
});

