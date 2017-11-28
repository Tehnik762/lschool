jQuery(document).ready(function () {


    jQuery('#submit-button').click(function () {
        form = jQuery('#order-form')[0];
        var info = new FormData(form);
        info.append('avatar', $('input[type=file]')[0].files[0]); 
        

        jQuery.ajax({
            type: 'POST',
            url: 'order.php',
            cache: false,
            contentType: false,
            processData: false,
            data: info,
            success: function (data) {
                alert(data);
            }
        });


    });
});