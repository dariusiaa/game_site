document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu > ul > li');

    menuItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.classList.add('active');
        });

        item.addEventListener('mouseleave', function() {
            this.classList.remove('active');
        });
    });
});
