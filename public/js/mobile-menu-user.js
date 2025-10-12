// Mobile Menu User
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const overlay = document.querySelector('.mobile-overlay');

    if (!btn || !menu || !overlay) {
        console.error('Mobile menu elements not found');
        return;
    }

    // Add close button to menu
    const menuContent = menu.querySelector('.mobile-menu-content');
    if (menuContent && !menu.querySelector('.mobile-menu-header')) {
        const header = document.createElement('div');
        header.className = 'mobile-menu-header';
        header.innerHTML = `
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #374151;">القائمة</h3>
            <button class="mobile-menu-close" aria-label="إغلاق القائمة">
                <i class="fas fa-times"></i>
            </button>
        `;
        menu.insertBefore(header, menuContent);
    }

    function openMobileMenu() {
        menu.classList.add('mobile-open');
        btn.classList.add('active');
        menu.style.transition = 'transform 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.3s';
        menu.style.transform = 'translateY(0)';
        menu.style.opacity = '1';
        menu.style.visibility = 'visible';
        // تأكد من أن display ليس none
        menu.style.display = 'block';
    }

    function closeMobileMenu() {
        menu.style.transition = 'transform 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.3s';
        menu.style.transform = 'translateY(-100%)';
        menu.style.opacity = '0';
        menu.style.visibility = 'hidden';
        setTimeout(function() {
            menu.classList.remove('mobile-open');
            btn.classList.remove('active');
            menu.style.display = 'none';
        }, 400);
    }

    // إصلاح منطق الفتح ليتم كل شيء من أول ضغطة
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (!menu.classList.contains('mobile-open')) {
            openMobileMenu();
        } else {
            closeMobileMenu();
        }
    });

    overlay.addEventListener('click', closeMobileMenu);

    // Close button handler
    const closeBtn = menu.querySelector('.mobile-menu-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeMobileMenu);
    }

    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeMobileMenu();
        }
    });
});
