jQuery(document).ready(function () {

    jQuery('#fsc_form').validate({
        rules: {
            'fsc_whatsapp_options[whatsapp_number]': {
                required: "#whatsapp_enable:checked",
                number: true
            },
            'fsc_whatsapp_options[whatsapp_message]': {
                required: "#whatsapp_enable:checked",
            },

            'fsc_messenger_options[messenger_id]': {
                required: "#messenger_enable:checked",
            },

            'fsc_mail_options[mail_address]': {
                required: "#mail_enable:checked"
            },

            'fsc_mail_options[mail_subject]': {
                required: "#mail_enable:checked"
            },

            'fsc_layout_options[layout_size]': {
                required: true,
                number: true,
                range: [0, 512]
            },

            'fsc_layout_options[layout_margin]': {
                required: true,
                number: true,
                range: [0, 200]
            }
        }

    });
});