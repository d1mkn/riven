document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.services');
    const trigger = section.querySelector('[data-see-more="trigger"]');
    const items = section.querySelectorAll('[data-see-more="item"]');

    if (trigger) {
        trigger.addEventListener('click', e => {
            e.currentTarget.classList.toggle('active');

            if (items) toggleItemsVisibility(items);
        });
    }

    function toggleItemsVisibility(items) {
        for (let i = 2; i < items.length; i++) {
            const item = items[i];

            item.classList.toggle('hidden');
        }
    }

    function hideItems(items) {
        if (items) {
            for (let i = 2; i < items.length; i++) {
                const item = items[i];

                item.classList.add('hidden');
            }
        }
    }
    hideItems(items);
});
