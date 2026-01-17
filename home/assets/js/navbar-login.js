// Navbar Login JavaScript

// Check if user is logged in
function checkLoginStatus() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const userName = localStorage.getItem('userName');
    const userType = localStorage.getItem('userType');
    
    if (isLoggedIn === 'true' && userName) {
        showUserDropdown(userName, userType);
    } else {
        showLoginButton();
    }
}

// Show login button
function showLoginButton() {
    const loginBtn = document.querySelector('.login-section a[href="login.html"]');
    if (loginBtn) {
        loginBtn.style.display = 'inline-block';
    }
    document.getElementById('userDropdown').style.display = 'none';
}

// Show user dropdown
function showUserDropdown(name, type) {
    const loginBtn = document.querySelector('.login-section a[href="login.html"]');
    if (loginBtn) {
        loginBtn.style.display = 'none';
    }
    document.getElementById('userDropdown').style.display = 'inline-block';
    document.getElementById('userName').textContent = name;
    
    // Update profile link based on user type
    const profileLink = document.querySelector('#userDropdown .dropdown-item[href="profile.html"]');
    if (type === 'instructor') {
        profileLink.href = 'admin/profile.html';
    } else {
        profileLink.href = 'profile.html';
    }
}

// Show login modal
function showLoginModal() {
    const modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();
}

// Handle successful login
function handleLoginSuccess(name, type) {
    localStorage.setItem('isLoggedIn', 'true');
    localStorage.setItem('userName', name);
    localStorage.setItem('userType', type);
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
    modal.hide();
    
    // Show user dropdown
    showUserDropdown(name, type);
}

// Logout function
function logout() {
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('userName');
    localStorage.removeItem('userType');
    
    // Show login button
    showLoginButton();
    
    // Redirect to home page
    window.location.href = 'courses.html';
}

// Update login functions to use handleLoginSuccess
function updateLoginFunctions() {
    // Override check1 function for student login
    window.check1 = function(e) {
        const email = document.getElementById('studentEmail');
        const password = document.getElementById('studentPassword');
        let emailVal = email.value.trim();
        let passVal = password.value.trim();
        
        if (!emailPattern.test(emailVal) || passVal == "") {
            e.preventDefault();
        }

        if (!emailPattern.test(emailVal)) {
            const label_email = document.querySelector("label[for='studentEmail']");
            email.style.cssText = "animation: move .4s;border-color: var(--main-color);";
            label_email.innerText = "invalid Email";
            firEmail = false;
        }

        if (passVal == "") {
            const label_pass = document.querySelector("label[for='studentPassword']");
            password.style.cssText = "animation: move .4s;border-color: var(--main-color);";
            label_pass.innerText = "invalid password";
            firPass = false;
        }
        
        // If validation passes, handle login success
        if (emailPattern.test(emailVal) && passVal !== "") {
            e.preventDefault();
            handleLoginSuccess(emailVal.split('@')[0], 'student');
        }
    };

    // Override checkInstructor function for instructor login
    window.checkInstructor = function(e) {
        const email = document.getElementById('instructorEmail');
        const password = document.getElementById('instructorPassword');
        let emailVal = email.value.trim();
        let passVal = password.value.trim();
        
        if (!emailPattern.test(emailVal) || passVal == "") {
            e.preventDefault();
        }

        if (!emailPattern.test(emailVal)) {
            const label_email = document.querySelector("label[for='instructorEmail']");
            email.style.cssText = "animation: move .4s;border-color: var(--main-color);";
            label_email.innerText = "invalid Email";
        }

        if (passVal == "") {
            const label_pass = document.querySelector("label[for='instructorPassword']");
            password.style.cssText = "animation: move .4s;border-color: var(--main-color);";
            label_pass.innerText = "invalid password";
        }
        
        // If validation passes, handle login success
        if (emailPattern.test(emailVal) && passVal !== "") {
            e.preventDefault();
            handleLoginSuccess(emailVal.split('@')[0], 'instructor');
            // Redirect to instructor dashboard
            setTimeout(() => {
                window.location.href = '../instructor/dashboard.html';
            }, 1000);
        }
    };
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    checkLoginStatus();
    updateLoginFunctions();
});
