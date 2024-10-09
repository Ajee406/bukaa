(function ($) {
    "use strict";

    var formAddFieldSelector = document.getElementById("form-builder-form");
    var options = {
        disableHTMLLabels: false,
        controlPosition: "left",
        disabledActionButtons: ["data"],
        onCloseFieldEdit: false,
        disableFields: ["autocomplete", "file", "hidden", "header", "date", "paragraph", "button"],
        controlOrder: ["text", "number", "select", "checkbox-group", "radio-group"],
        showActionButtons: false,
        defaultFields: typeof editFields == 'object' ? editFields : JSON.parse(editFields),
        i18n: {
            locale: $('#lang_code').val(),
            location: '/assets/lang/',
            extension: '.lang'
        }
    };
    var formBuilder = $(formAddFieldSelector).formBuilder(options);
    $(document).on('click', '#reg-form-save-btn', function() {
        $(this).closest('form').find('input[name=custom_fields]').val(formBuilder.actions.getData('json'))
    });

})(jQuery)
