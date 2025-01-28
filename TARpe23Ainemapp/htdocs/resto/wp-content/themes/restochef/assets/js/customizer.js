/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

/* global wp */
(function () {
    const selectors = {
        siteTitle: '.site-title',
        siteDesc: '.site-description',
        siteTitleA: '.site-title a',
    }

    function updateText(selector, value) {
        document.querySelector(selector).textContent = value;
    }

    function updateColor(selector, value) {
        document.querySelector(selector).style.color = value;
    }

    function updateClipAndPosition(selector, value) {
        const el = document.querySelector(selector);
        el.style.clip = value;
        el.style.position = value;
    }

    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            updateText(selectors.siteTitleA, to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            updateText(selectors.siteDesc, to);
        });
    });

    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                updateClipAndPosition(selectors.siteTitle, 'rect(1px, 1px, 1px, 1px)');
                updateClipAndPosition(selectors.siteDesc, 'rect(1px, 1px, 1px, 1px)');
            } else {
                updateClipAndPosition(selectors.siteTitle, 'auto');
                updateClipAndPosition(selectors.siteDesc, 'auto');
                updateColor(selectors.siteTitleA, to);
                updateColor(selectors.siteDesc, to);
            }
        });
    });
})();

