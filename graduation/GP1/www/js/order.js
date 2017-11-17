jQuery(document).ready(function () {


    jQuery('#submit-button').click(function () {
        info = {
            name: jQuery("[name=name]").val(),
            phone: jQuery("[name=phone]").val(),
            email: jQuery("[name=email]").val(),
            street: jQuery("[name=street]").val(),
            home: jQuery("[name=home]").val(),
            part: jQuery("[name=part]").val(),
            appt: jQuery("[name=appt]").val(),
            floor: jQuery("[name=floor]").val(),
            comment: jQuery("[name=comment]").val(),
            callback: jQuery("[name=callback]").prop("checked"),
            payment: jQuery("[name=payment]").prop("checked"),
            payment_card: jQuery("[name=payment_card]").prop("checked"),
            'g-recaptcha-response': jQuery("[name=g-recaptcha-response]").val()
        };

        jQuery.ajax({
            type: 'POST',
            url: 'order.php',
            data: info,
            success: function (data) {
                alert(data);
            }
        });


    });
});