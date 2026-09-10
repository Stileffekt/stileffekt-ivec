{
    document.addEventListener('DOMContentLoaded', function () {
        const blocks = document.querySelectorAll('.b-employees-slider');

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
                        autoplay: false,
                        interval: 5000,
                        drag: true,
                        mediaQuery: 'min',
                        gap: gutter,
                        breakpoints: {
                            576: {
                                perPage: 3,
                            },
                            768: {
                                perPage: 4,
                            },
                            1024: {
                                perPage: 5,
                            },
                            1280: {
                                perPage: 6,
                            },
                        }
                    })

                    splide.mount();

                }

            });
        }

    })
}