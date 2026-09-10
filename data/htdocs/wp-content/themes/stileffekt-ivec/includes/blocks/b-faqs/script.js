{
    const blocks = document.querySelectorAll('.b-faqs');

    blocks.forEach(function (block) {

        const items = block.querySelectorAll('.c-faq');

        items.forEach(function (item) {

            const button  = item.querySelector('.c-faq__button');
            const content = item.querySelector('.c-faq__content');

            if (!button || !content) return;

            const toggleFaq = function () {
                const isExpanded = button.getAttribute('aria-expanded') === 'true';

                if (isExpanded) {
                    item.classList.remove('c-faq--active');
                    button.setAttribute('aria-expanded', 'false');
                    content.style.maxHeight = 0 + 'px';
                } else {
                    item.classList.add('c-faq--active');
                    button.setAttribute('aria-expanded', 'true');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            };

            button.addEventListener('click', toggleFaq);

        });

    });
}
