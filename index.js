$(function () {
    'use strict';
    $('#check').click(function () {
        $.post(
            'service.php',
            {
                'validator': $('select').val(),
                'jsText': $('#jsText').val(),
                'incjQuery': $('#incjQuery').is(':checked') ? 'on' : 'off'
            },
            function (data) {
                var res = JSON.parse(data);
                $('#result').empty().text(res.output);
            }
        );
    });

    $("select").change(function () {
        $("#validator").val($(this).val());
    });
});

