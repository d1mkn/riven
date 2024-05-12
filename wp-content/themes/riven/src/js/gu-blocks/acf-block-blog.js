document.addEventListener('DOMContentLoaded', () => {
    const splide = new Splide('section.blog .blog__platform', {
        type: 'loop',
        perPage: 2,
        perMove: 1,
        arrows: true,
        pagination: false,
        focus: 0,
        omitEnd: true,
        speed: 800,
        gap: '5.5rem',
        breakpoints: {
            576: { perPage: 1 },
        },
    }).mount();

    const section = document.querySelector('.blog');
    const items = section.querySelectorAll('.blog__item');
    let prevInnerWidth = window.innerWidth;
    let firstRender = true;

    if (items) {
        items.forEach(item => {
            const text = item.querySelector('.blog__item-text');
            const btn = item.querySelector('.blog__item-button');

            buttonsVisibility(text, btn);

            if (firstRender) {
                btn.addEventListener('click', () => {
                    if (text.hasAttribute('style')) {
                        text.removeAttribute('style');
                        item.classList.remove('active');
                        btn.classList.remove('active');
                    } else {
                        text.style.height = text.scrollHeight + 'px';
                        item.classList.add('active');
                        btn.classList.add('active');
                    }
                });
            }
        });

        firstRender = false;

        window.addEventListener('resize', () => {
            if (prevInnerWidth !== window.innerWidth) {
                prevInnerWidth = window.innerWidth;

                items.forEach(item => {
                    const text = item.querySelector('.blog__item-text');
                    const btn = item.querySelector('.blog__item-button');

                    if (item.classList.contains('active')) {
                        text.style.height = 'unset';
                        text.style.height = text.clientHeight + 'px';
                    }

                    if (prevInnerWidth < 576 || !item.classList.contains('is-visible')) {
                        text.removeAttribute('style');
                        btn.classList.remove('active');
                    }

                    item.addEventListener('transitionend', buttonsVisibility(text, btn), { once: true });
                });
            }
        });

        splide.on('inactive', handleInactive);

        function buttonsVisibility(text, btn) {
            text.clientHeight >= text.scrollHeight && !btn.classList.contains('active')
                ? btn.classList.add('hidden')
                : btn.classList.remove('hidden');
        }

        function handleInactive() {
            items.forEach(item => {
                if (!item.classList.contains('is-visible')) {
                    item.querySelector('.blog__item-text').removeAttribute('style');
                    item.querySelector('.blog__item-button').classList.remove('active');
                }
            });
        }
    }
});
