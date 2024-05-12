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
});
