(function (document) {
    'use strict';

    /**
     * Prevent links in Stilpress block previews from navigating the editor iframe.
     * WordPress currently does not reliably intercept regular links outside of
     * contenteditable elements. Re-test and remove this workaround once the
     * supported WordPress versions handle these links themselves.
     *
     * @see https://github.com/WordPress/gutenberg/issues/82012
     * @see https://github.com/WordPress/gutenberg/pull/82136
     */
    function preventBlockPreviewLinkNavigation(event) {
        if (!(event.target instanceof Element)) {
            return;
        }

        const link = event.target.closest('a[href]');

        if (!link || !link.closest('.b, .w')) {
            return;
        }

        event.preventDefault();
    }

    document.addEventListener('click', preventBlockPreviewLinkNavigation);
}(document));
