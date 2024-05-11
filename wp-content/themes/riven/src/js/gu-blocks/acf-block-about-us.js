document.addEventListener('DOMContentLoaded', () => {
    const leftSlider = document.querySelector('section.about-us .about-us__left-platform');
    const rightSlider = document.querySelector('section.about-us .about-us__right-platform');

    if (leftSlider) {
        new Splide(leftSlider, {
            type: 'loop',
            perPage: 1,
            perMove: 1,
            arrows: true,
            pagination: false,
            focus: 0,
            omitEnd: true,
            speed: 800,
            gap: '1.3rem',
        }).mount();
    }

    if (rightSlider) {
        new Splide(rightSlider, {
            type: 'loop',
            perPage: 1,
            perMove: 1,
            arrows: true,
            pagination: false,
            focus: 0,
            omitEnd: true,
            speed: 800,
            gap: '1.3rem',
            fixedWidth: '29.475rem',
            breakpoints: {
                576: { fixedWidth: '100%' },
            },
        }).mount();
    }
});
