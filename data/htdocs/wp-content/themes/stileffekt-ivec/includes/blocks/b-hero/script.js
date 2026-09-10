{
    const blocks = document.querySelectorAll('.b-hero');

    blocks.forEach(function (block) {
        const arrow = block.querySelector('.b__arrow');
        if (!arrow) return;

        arrow.addEventListener('click', function () {
            const scrollTarget = window.scrollY + window.innerHeight * 0.5;
            window.scrollTo({top: scrollTarget, behavior: 'smooth'});
        }, {once: true});
    });
}