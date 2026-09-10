{
    document.addEventListener('DOMContentLoaded', function () {

        const blocks = document.querySelectorAll('.b-logo-slider')

        blocks.forEach(function (block) {

            const slider = block.querySelector('.splide')

            if (slider) {

                const root = document.documentElement
                const style = getComputedStyle(root)
                const gutter = style.getPropertyValue('--layout-gutter').trim()

                const splide = new Splide(slider, {
                    perPage: 5,
                    type: 'loop',
                    drag: true,
                    arrows: false,
                    pagination: false,
                    gap: gutter,
                    autoScroll: {
                        speed: 1,
                        pauseOnHover: true,
                        pauseOnFocus: false,
                    },
                })

                splide.mount(window.splide.Extensions);
            }
        })
    })
}