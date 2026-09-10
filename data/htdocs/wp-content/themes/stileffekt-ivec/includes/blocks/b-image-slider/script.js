{
    document.addEventListener('DOMContentLoaded', function () {
        const blocks = document.querySelectorAll('.b-image-slider');

        if (blocks) {

            blocks.forEach(function (block) {

                const slider = block.querySelector('.splide')

                if (slider) {

                    const root = document.documentElement;
                    const style = getComputedStyle(root);
                    const gutter = style.getPropertyValue('--layout-gutter').trim();

                    const splide = new Splide(slider, {
                        perPage: 2,
                        perMove: 1,
                        focus: 0,
                        arrows: true,
                        pagination: true,
                        type: 'loop',
                        autoplay: true,
                        pauseOnHover: true,
                        interval: 5000,
                        drag: true,
                        mediaQuery: 'min',
                        gap: gutter,
                        breakpoints: {
                            1280: {
                                perPage: 3,
                            },
                        }
                    })

                    splide.mount();

                }

            });
        }

    })
}