(function (api) {
    api.sectionConstructor["upsell"] = api.Section.extend({
        // No events for this type of section.
        attachEvents: function () {
        },

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        },
    });
})(wp.customize);

jQuery(document).ready(function ($) {
    // MultiCheckbox
    jQuery('.customize-control-checkbox-multiple input[type="checkbox"]').on(
        "change",
        function () {
            let checkbox_values = jQuery(this)
                .parents(".customize-control")
                .find('input[type="checkbox"]:checked')
                .map(function () {
                    return this.value;
                })
                .get()
                .join(",");

            jQuery(this)
                .parents(".customize-control")
                .find('input[type="hidden"]')
                .val(checkbox_values)
                .trigger("change");
        }
    );
});
