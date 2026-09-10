{
    const blocks = document.querySelectorAll('.b-page-title');

    blocks.forEach(function (block) {
        const arrow = block.querySelector('.b__arrow');
        if (!arrow) return;

        arrow.addEventListener('click', function () {
            const scrollTarget = window.scrollY + window.innerHeight * 0.5;
            window.scrollTo({ top: scrollTarget, behavior: 'smooth' });
        }, { once: true });
    });
}