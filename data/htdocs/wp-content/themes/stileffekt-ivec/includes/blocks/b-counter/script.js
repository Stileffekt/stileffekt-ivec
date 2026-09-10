{
    document.querySelectorAll('.b-counter').forEach(function (element) {

        const facts = element.querySelectorAll('.c-counter__item').forEach(function (element) {

            gsap.registerPlugin(ScrollTrigger)

            const valueWrapper = element.querySelector('.c-counter__value')
            let value = valueWrapper?.dataset?.value ?? 1
            let duration = valueWrapper?.dataset?.duration ?? 5
            let prefix = valueWrapper?.dataset?.prefix ?? ''
            let suffix = valueWrapper?.dataset?.suffix ?? ''

            gsap.to(valueWrapper, {
                scrollTrigger: {
                    trigger: element,
                    markers: false,
                    start: "top 70%",
                    end: "top 70%",
                },
                innerText: value,
                duration: duration,
                snap: {
                    innerText: 1
                },
                onUpdate: () => {
                    valueWrapper.innerText = Math.floor(valueWrapper.innerText).toLocaleString('de-DE');
                    valueWrapper.innerText += ' ' + suffix;
                }
            })

        })

    })

}
