document.addEventListener('DOMContentLoaded', function () {
    const expandableItems = document.querySelectorAll('[data-expandable]');

    expandableItems.forEach(function (item) {
        const content = item.querySelector('[data-expandable-content]');
        const button = item.querySelector('[data-expand-toggle]');

        if (!content || !button) return;

        function checkContentHeight() {
            content.removeAttribute('data-collapsed');
            content.style.removeProperty('max-height');
            content.style.removeProperty('overflow');

            const actualHeight = content.scrollHeight;
            const isOverflowing = actualHeight > 260;

            if (isOverflowing) {
                button.hidden = false;
                content.setAttribute('data-collapsed', 'true');
            } else {
                button.hidden = true;
                content.removeAttribute('data-collapsed');
            }
        }

        function toggleExpand() {
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            const moreText = button.querySelector('[data-text="more"]');
            const lessText = button.querySelector('[data-text="less"]');

            if (isExpanded) {
                const currentHeight = content.scrollHeight;
                content.style.maxHeight = currentHeight + 'px';

                button.setAttribute('aria-expanded', 'false');
                button.classList.remove('active');
                moreText.hidden = false;
                lessText.hidden = true;

                setTimeout(function () {
                    content.style.maxHeight = '260px';
                    content.setAttribute('data-collapsed', 'true');
                }, 10);
            } else {
                if (!content.style.maxHeight || content.style.maxHeight === 'none') {
                    content.style.maxHeight = '260px';
                }

                content.setAttribute('data-collapsed', 'false');

                setTimeout(function () {
                    const targetHeight = content.scrollHeight;
                    content.style.maxHeight = targetHeight + 'px';
                }, 10);

                button.setAttribute('aria-expanded', 'true');
                button.classList.add('active');
                moreText.hidden = true;
                lessText.hidden = false;
            }
        }

        button.addEventListener('click', toggleExpand);

        checkContentHeight();

        let resizeTimeout;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function () {
                content.setAttribute('data-collapsed', 'true');
                button.setAttribute('aria-expanded', 'false');
                button.classList.remove('active');
                const moreText = button.querySelector('[data-text="more"]');
                const lessText = button.querySelector('[data-text="less"]');
                if (moreText) moreText.hidden = false;
                if (lessText) lessText.hidden = true;

                checkContentHeight();
            }, 250);
        });
    });
});
