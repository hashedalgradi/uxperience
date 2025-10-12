// Smooth Cursor Dot Effect
document.addEventListener('DOMContentLoaded', function() {
    let cursorDot = null;
    
    // Create cursor dot
    function createCursor() {
        cursorDot = document.createElement('div');
        cursorDot.className = 'cursor-dot';
        cursorDot.style.cssText = `
            position: fixed;
            width: 10px;
            height: 10px;
            background: radial-gradient(circle, #6366f1, #ec4899);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            will-change: transform;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
        `;
        
        document.body.appendChild(cursorDot);
    }
    
    // Ultra smooth cursor animation
    let currentX = 0, currentY = 0;
    let targetX = 0, targetY = 0;
    
    function updateCursor(e) {
        targetX = e.clientX;
        targetY = e.clientY;
    }
    
    function animateCursor() {
        // Very smooth interpolation
        currentX += (targetX - currentX) * 0.08;
        currentY += (targetY - currentY) * 0.08;
        
        if (cursorDot) {
            cursorDot.style.left = currentX + 'px';
            cursorDot.style.top = currentY + 'px';
        }
        
        requestAnimationFrame(animateCursor);
    }
    
    // Handle hover effects
    function handleHover(e) {
        if (cursorDot) {
            cursorDot.style.transform = 'translate(-50%, -50%) scale(1.5)';
            cursorDot.style.boxShadow = '0 0 20px rgba(236, 72, 153, 0.8)';
        }
    }
    
    function handleLeave(e) {
        if (cursorDot) {
            cursorDot.style.transform = 'translate(-50%, -50%) scale(1)';
            cursorDot.style.boxShadow = '0 0 10px rgba(99, 102, 241, 0.5)';
        }
    }
    
    // Initialize cursor effect
    createCursor();
    animateCursor();
    
    // Event listeners
    document.addEventListener('mousemove', updateCursor);
    
    // Add hover effects to interactive elements
    const interactiveElements = document.querySelectorAll('a, button, .btn-primary, .btn-secondary, .card-hover');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', handleHover);
        el.addEventListener('mouseleave', handleLeave);
    });
    
    // Hide cursor when mouse leaves window
    document.addEventListener('mouseleave', function() {
        if (cursorDot) {
            cursorDot.style.opacity = '0';
        }
    });
    
    document.addEventListener('mouseenter', function() {
        if (cursorDot) {
            cursorDot.style.opacity = '1';
        }
    });
});