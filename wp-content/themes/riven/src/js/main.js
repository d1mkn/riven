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
});
