// Simple Mobile Menu Handler
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const sidebar = document.getElementById('sidebar');
    
    console.log('Mobile menu script loaded');
    console.log('Mobile toggle:', mobileToggle);
    console.log('Sidebar:', sidebar);
    
    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Mobile toggle clicked');
            
            const isOpen = sidebar.classList.contains('mobile-open');
            console.log('Sidebar is open:', isOpen);
            
            if (isOpen) {
                // Close sidebar
                sidebar.classList.remove('mobile-open');
                removeOverlay();
            } else {
                // Open sidebar
                sidebar.classList.add('mobile-open');
                createOverlay();
            }
        });
    }
    
    function createOverlay() {
        let overlay = document.querySelector('.mobile-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'mobile-overlay';
            document.body.appendChild(overlay);
        }
        
        overlay.classList.add('active');
        
        overlay.onclick = function() {
            sidebar.classList.remove('mobile-open');
            removeOverlay();
        };
    }
    
    function removeOverlay() {
        const overlay = document.querySelector('.mobile-overlay');
        if (overlay) {
            overlay.classList.remove('active');
        }
    }
});