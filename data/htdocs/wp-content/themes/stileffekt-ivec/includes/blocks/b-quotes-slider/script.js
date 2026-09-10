{
    const blocks = document.querySelectorAll('.b-quotes-slider');

    blocks.forEach(function (block) {

        const slider = block.querySelector('.splide')

        if (slider) {

            document.addEventListener('DOMContentLoaded', function () {
                const root = document.documentElement;
                const style = getComputedStyle(root);
                const gutter = style.getPropertyValue('--layout-gutter').trim();

                const splide = new Splide(slider, {
                    perPage: 1,
                    perMove: 1,
                    autoHeight: true,
                    arrows: true,
                    pagination: false,
                    type: 'loop',
                    autoplay: true,
                    pauseOnHover: true,
                    interval: 5000,
                    drag: true,
                    mediaQuery: 'min',
                    gap: gutter,
                })

                splide.mount();
            });
        }
    })
}