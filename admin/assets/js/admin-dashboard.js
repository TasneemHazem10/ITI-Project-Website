// Admin Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    if (sidebarToggle && sidebar && mainContent) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Handle RTL layout
            const isRTL = document.documentElement.getAttribute('dir') === 'rtl';
            if (isRTL) {
                if (sidebar.classList.contains('collapsed')) {
                    mainContent.style.marginRight = '80px';
                } else {
                    mainContent.style.marginRight = '280px';
                }
            } else {
                if (sidebar.classList.contains('collapsed')) {
                    mainContent.style.marginLeft = '80px';
                } else {
                    mainContent.style.marginLeft = '280px';
                }
            }
        });
    }

    // Initialize language from localStorage
    const savedLanguage = localStorage.getItem('adminLanguage') || 'en';
    changeLanguage(savedLanguage);
});

// Language switching function
function changeLanguage(lang) {
    const html = document.documentElement;
    const currentLangSpan = document.getElementById('currentLang');
    
    if (lang === 'ar') {
        html.setAttribute('lang', 'ar');
        html.setAttribute('dir', 'rtl');
        currentLangSpan.textContent = 'AR';
        
        // Update sidebar position for RTL
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        if (sidebar && mainContent) {
            sidebar.style.left = 'auto';
            sidebar.style.right = '0';
            mainContent.style.marginLeft = '0';
            mainContent.style.marginRight = '280px';
        }
    } else {
        html.setAttribute('lang', 'en');
        html.setAttribute('dir', 'ltr');
        currentLangSpan.textContent = 'EN';
        
        // Update sidebar position for LTR
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        if (sidebar && mainContent) {
            sidebar.style.left = '0';
            sidebar.style.right = 'auto';
            mainContent.style.marginLeft = '280px';
            mainContent.style.marginRight = '0';
        }
    }
    
    // Update all text content
    updateTextContent(lang);
    
    // Save language preference
    localStorage.setItem('adminLanguage', lang);
}


// Update text content based on language
function updateTextContent(lang) {
    const elements = document.querySelectorAll('[data-en][data-ar]');
    
    elements.forEach(element => {
        if (lang === 'ar') {
            element.textContent = element.getAttribute('data-ar');
        } else {
            element.textContent = element.getAttribute('data-en');
        }
    });
}

// Check if user is logged in
function checkAdminLogin() {
    const isLoggedIn = sessionStorage.getItem('adminLoggedIn');
    if (!isLoggedIn || isLoggedIn !== 'true') {
        window.location.href = 'index.html';
    }
}

// Logout function
function logout() {
    sessionStorage.removeItem('adminLoggedIn');
    sessionStorage.removeItem('adminEmail');
    localStorage.removeItem('adminRememberMe');
    localStorage.removeItem('adminEmail');
    window.location.href = 'index.html';
}

// Initialize on page load
checkAdminLogin();