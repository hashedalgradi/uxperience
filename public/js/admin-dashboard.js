/**
 * Enhanced Admin Dashboard JavaScript
 */

class AdminDashboard {
    constructor() {
        this.sidebar = document.getElementById('sidebar');
        this.sidebarToggle = document.getElementById('sidebar-toggle');
        this.mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.restoreSidebarState();
        this.initCounters();
        this.initCharts();
        this.handleResponsive();
    }
    
    bindEvents() {
        // Sidebar toggle
        if (this.sidebarToggle) {
            this.sidebarToggle.addEventListener('click', () => {
                this.toggleSidebar();
            });
        }
        
            // Mobile menu toggle
        if (this.mobileMenuToggle) {
            this.mobileMenuToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggleMobileSidebar();
            });
        }
        
        // Window resize handler
        window.addEventListener('resize', () => {
            this.handleResponsive();
        });
        
        // Initialize margin
        this.updateMainContentMargin();
        
        // Form enhancements
        this.enhanceForms();
        
        // Table enhancements
        this.enhanceTables();
    }
    
    toggleSidebar() {
        if (this.sidebar) {
            this.sidebar.classList.toggle('collapsed');
            
            // Save state
            const isCollapsed = this.sidebar.classList.contains('collapsed');
            localStorage.setItem('adminSidebarCollapsed', isCollapsed);
            
            // Update main content margin
            this.updateMainContentMargin();
        }
    }
    
    toggleMobileSidebar() {
        if (this.sidebar) {
            const isOpen = this.sidebar.classList.contains('mobile-open');
            
            if (isOpen) {
                this.closeMobileSidebar();
            } else {
                this.openMobileSidebar();
            }
        }
    }
    
    openMobileSidebar() {
        if (this.sidebar) {
            this.sidebar.classList.add('mobile-open');
            
            // Add overlay
            let overlay = document.querySelector('.mobile-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'mobile-overlay';
                document.body.appendChild(overlay);
                
                overlay.addEventListener('click', () => {
                    this.closeMobileSidebar();
                });
            }
            
            overlay.classList.add('active');
        }
    }
    
    restoreSidebarState() {
        const savedState = localStorage.getItem('adminSidebarCollapsed');
        if (savedState === 'true' && this.sidebar && window.innerWidth >= 768) {
            this.sidebar.classList.add('collapsed');
        }
        this.updateMainContentMargin();
    }
    
    closeMobileSidebar() {
        if (this.sidebar) {
            this.sidebar.classList.remove('mobile-open');
        }
        const overlay = document.querySelector('.mobile-overlay');
        if (overlay) {
            overlay.classList.remove('active');
        }
    }
    
    updateMainContentMargin() {
        const mainContent = document.querySelector('.main-content');
        if (mainContent && this.sidebar) {
            const isCollapsed = this.sidebar.classList.contains('collapsed');
            if (window.innerWidth >= 768) {
                mainContent.style.marginRight = isCollapsed ? '80px' : '280px';
                mainContent.style.marginLeft = '0';
            } else {
                mainContent.style.marginRight = '0';
                mainContent.style.marginLeft = '0';
            }
        }
    }
    
    handleResponsive() {
        if (window.innerWidth <= 768) {
            // Mobile view
            if (this.sidebar) {
                this.sidebar.classList.remove('collapsed');
                if (this.sidebar.classList.contains('mobile-open')) {
                    // Keep mobile menu open if it was open
                } else {
                    this.closeMobileSidebar();
                }
            }
        } else {
            // Desktop view
            this.closeMobileSidebar();
        }
        this.updateMainContentMargin();
    }
    
    initCounters() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target') || counter.textContent);
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            // Start animation when element is visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe(counter);
        });
    }
    
    initCharts() {
        // Placeholder for chart initialization
        // You can integrate Chart.js or other charting libraries here
        console.log('Charts initialized');
    }
    
    enhanceForms() {
        // Add floating labels
        const formInputs = document.querySelectorAll('.form-input');
        
        formInputs.forEach(input => {
            // Add focus/blur handlers for enhanced UX
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', () => {
                if (!input.value) {
                    input.parentElement.classList.remove('focused');
                }
            });
            
            // Check if input has value on load
            if (input.value) {
                input.parentElement.classList.add('focused');
            }
        });
        
        // Form validation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });
        });
    }
    
    validateForm(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                this.showFieldError(field, 'هذا الحقل مطلوب');
                isValid = false;
            } else {
                this.clearFieldError(field);
            }
        });
        
        return isValid;
    }
    
    showFieldError(field, message) {
        this.clearFieldError(field);
        
        field.classList.add('error');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error text-red-500 text-sm mt-1';
        errorDiv.textContent = message;
        
        field.parentElement.appendChild(errorDiv);
    }
    
    clearFieldError(field) {
        field.classList.remove('error');
        const existingError = field.parentElement.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }
    
    enhanceTables() {
        // Add sorting functionality
        const sortableHeaders = document.querySelectorAll('[data-sortable]');
        
        sortableHeaders.forEach(header => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                this.sortTable(header);
            });
        });
        
        // Add row selection
        const selectableRows = document.querySelectorAll('[data-selectable]');
        
        selectableRows.forEach(row => {
            row.addEventListener('click', () => {
                row.classList.toggle('selected');
            });
        });
    }
    
    sortTable(header) {
        const table = header.closest('table');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const columnIndex = Array.from(header.parentElement.children).indexOf(header);
        const isAscending = header.classList.contains('sort-asc');
        
        // Clear all sort classes
        header.parentElement.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
        });
        
        // Add appropriate sort class
        header.classList.add(isAscending ? 'sort-desc' : 'sort-asc');
        
        // Sort rows
        rows.sort((a, b) => {
            const aValue = a.children[columnIndex].textContent.trim();
            const bValue = b.children[columnIndex].textContent.trim();
            
            if (isAscending) {
                return bValue.localeCompare(aValue, 'ar');
            } else {
                return aValue.localeCompare(bValue, 'ar');
            }
        });
        
        // Reorder rows in DOM
        rows.forEach(row => tbody.appendChild(row));
    }
    
    // Utility methods
    showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification fixed top-4 left-4 z-50 p-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Show notification
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Hide notification
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
    
    showLoader(element) {
        element.classList.add('loading');
        element.disabled = true;
    }
    
    hideLoader(element) {
        element.classList.remove('loading');
        element.disabled = false;
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.adminDashboard = new AdminDashboard();
});

// Additional utility functions
function confirmDelete(message = 'هل أنت متأكد من الحذف؟') {
    return confirm(message);
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        window.adminDashboard.showNotification('تم النسخ بنجاح');
    });
}

// Export for module use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AdminDashboard;
}