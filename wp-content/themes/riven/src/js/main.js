'use strict';
document.addEventListener('DOMContentLoaded', function () {
    // Function open/close popups
    function togglePopups() {
        const triggers = document.querySelectorAll('[data-popup-trigger]');
        if (triggers) {
            triggers.forEach(trigger => {
                const popupName = trigger.dataset.popupTrigger,
                    popup = document.querySelector(`[data-popup-name='${popupName}']`);
                //

                trigger.addEventListener('click', () => {
                    popup.classList.add('active');
                    if (popupName !== 'message') {
                        document.documentElement.classList.add('fixed');
                    }
                });

                popup.addEventListener('click', e => {
                    if (e.target === popup || e.target.dataset.popupClose === popupName) {
                        popup.classList.remove('active');
                        if (popupName !== 'message') {
                            document.documentElement.classList.remove('fixed');
                        }
                    }
                });
            });
        }
    }
    togglePopups();
    //#############################################################################

    // go to the page after clicking on the tag with attribute [data-url]
    function behaviorLink(selector) {
        const items = document.querySelectorAll(selector);

        if (items.length > 0) {
            items.forEach(item => {
                item.addEventListener('click', () => {
                    const link = item.dataset.url;

                    if (item.dataset.link === 'to-form') {
                        appendGetParam(item, link);
                    } else if (item.dataset.target === '_blank') {
                        window.open(link, '_blank');
                    } else {
                        window.location.href = link;
                    }
                });
            });
        }
    }
    behaviorLink('[data-url]');
    // #############################################

    // add current class to nav item
    function addCurrentClassToNav() {
        const sections = document.querySelectorAll('section[id], footer');

        function checkIntersection() {
            for (let i = 0; i < sections.length; i++) {
                const section = sections[i];
                const sectionTop = section.getBoundingClientRect().top;

                let statement;

                if (window.innerWidth > 576) {
                    statement = sectionTop > 0 && (sectionTop + 60 < window.innerHeight / 2 || sectionTop + 60 < window.innerHeight);
                } else {
                    statement = sectionTop > 0;
                }

                if (statement) {
                    const navItems = document.querySelectorAll(`[data-url="#${section.id}"]`);
                    const currentNavItems = document.querySelectorAll('[data-nav].current');

                    if (currentNavItems.length > 0) {
                        currentNavItems.forEach(currNavItem => currNavItem.classList.remove('current'));
                    }

                    if (navItems) {
                        navItems.forEach(navItem => {
                            navItem.classList.add('current');
                        });
                    }

                    break;
                }

                if (
                    section.scrollHeight >= window.innerHeight &&
                    document.querySelector(`[data-url="#${section.id}"]`).classList.contains('current')
                ) {
                    continue;
                }
            }
        }

        function handleScroll() {
            checkIntersection();
        }
        handleScroll();
        window.addEventListener('scroll', _.throttle(handleScroll, 250));
    }
    addCurrentClassToNav();
    // #############################################

    // add current class to nav item
    function toggleBurger() {
        const header = document.querySelector('.header');
        const burger = header.querySelector('.header__burger');

        header.addEventListener('click', () => {
            if (burger.classList.contains('active')) {
                burger.classList.remove('active');
            } else {
                burger.classList.add('active');

                document.querySelector('body').addEventListener('click', bodyClickHandler);
            }
        });

        function bodyClickHandler(e) {
            if (e.target.closest('.header') === null) {
                burger.classList.remove('active');
                document.querySelector('body').removeEventListener('click', bodyClickHandler);
            }
        }
    }
    toggleBurger();
    // #############################################
});
