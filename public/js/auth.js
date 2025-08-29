// ===== AUTHENTICATION & NAVIGATION SYSTEM =====

// User data simulation
const users = {
    'admin@unri.ac.id': {
        password: 'admin123',
        role: 'admin',
        name: 'Administrator',
        dashboard: 'dashboard-admin.html'
    },
    'atasan@unri.ac.id': {
        password: 'atasan123',
        role: 'atasan',
        name: 'Ahmad Rahman',
        dashboard: 'dashboard-atasan.html'
    },
    'pemagang@unri.ac.id': {
        password: 'pemagang123',
        role: 'pemagang',
        name: 'Ahmad Fauzi Rahman',
        dashboard: 'dashboard-pemagang.html'
    },
    'pembimbing@unri.ac.id': {
        password: 'pembimbing123',
        role: 'pembimbing',
        name: 'Dr. Siti Nurhaliza',
        dashboard: 'dashboard-pembimbing.html'
    }
};

// Login function
function login(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('rememberMe').checked;
    
    // Clear previous error messages
    clearErrors();
    
    // Validate input
    if (!email || !password) {
        showError('Email dan password harus diisi!');
        return;
    }
    
    // Check credentials
    const user = users[email];
    if (!user || user.password !== password) {
        showError('Email atau password salah!');
        return;
    }
    
    // Store user session
    const sessionData = {
        email: email,
        role: user.role,
        name: user.name,
        loginTime: new Date().toISOString()
    };
    
    if (rememberMe) {
        localStorage.setItem('userSession', JSON.stringify(sessionData));
    } else {
        sessionStorage.setItem('userSession', JSON.stringify(sessionData));
    }
    
    // Show success message
    showSuccess('Login berhasil! Mengalihkan ke dashboard...');
    
    // Redirect to appropriate dashboard
    setTimeout(() => {
        window.location.href = user.dashboard;
    }, 1500);
}

// Logout function
function logout() {
    // Clear session data
    localStorage.removeItem('userSession');
    sessionStorage.removeItem('userSession');
    
    // Show logout message
    showSuccess('Logout berhasil!');
    
    // Redirect to login page
    setTimeout(() => {
        window.location.href = 'login.html';
    }, 1000);
}

// Check if user is logged in
function checkAuth() {
    const sessionData = getSessionData();
    
    if (!sessionData) {
        // Not logged in, redirect to login
        window.location.href = 'login.html';
        return null;
    }
    
    return sessionData;
}

// Get session data
function getSessionData() {
    let sessionData = localStorage.getItem('userSession');
    if (!sessionData) {
        sessionData = sessionStorage.getItem('userSession');
    }
    
    return sessionData ? JSON.parse(sessionData) : null;
}

// Check if user has correct role for current page
function checkRole(requiredRole) {
    const sessionData = getSessionData();
    
    if (!sessionData) {
        window.location.href = 'login.html';
        return false;
    }
    
    if (sessionData.role !== requiredRole) {
        showError('Anda tidak memiliki akses ke halaman ini!');
        setTimeout(() => {
            // Redirect to appropriate dashboard
            const user = users[sessionData.email];
            if (user) {
                window.location.href = user.dashboard;
            } else {
                window.location.href = 'login.html';
            }
        }, 2000);
        return false;
    }
    
    return true;
}

// Update user info in navbar
function updateUserInfo() {
    const sessionData = getSessionData();
    if (sessionData) {
        const userNameElement = document.getElementById('userName');
        if (userNameElement) {
            userNameElement.textContent = sessionData.name;
        }
    }
}

// Show error message
function showError(message) {
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        errorDiv.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }
}

// Show success message
function showSuccess(message) {
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        errorDiv.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }
}

// Clear error messages
function clearErrors() {
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        errorDiv.innerHTML = '';
    }
}

// Show toast notification
function showToast(message, type = 'info') {
    const toastElement = document.getElementById('mainToast');
    const toastMessage = document.getElementById('toastMessage');
    
    if (toastElement && toastMessage) {
        // Update toast content
        toastMessage.textContent = message;
        
        // Update toast header icon based on type
        const toastHeader = toastElement.querySelector('.toast-header i');
        if (toastHeader) {
            toastHeader.className = `fas me-2 ${getToastIcon(type)} text-${type}`;
        }
        
        // Show toast
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
}

// Get toast icon based on type
function getToastIcon(type) {
    switch (type) {
        case 'success': return 'fa-check-circle';
        case 'warning': return 'fa-exclamation-triangle';
        case 'danger': return 'fa-exclamation-circle';
        default: return 'fa-info-circle';
    }
}

// Initialize page based on role
function initializePage() {
    // Get current page
    const currentPage = window.location.pathname.split('/').pop();
    
    // Check authentication for dashboard pages
    if (currentPage.includes('dashboard-')) {
        const sessionData = checkAuth();
        if (sessionData) {
            updateUserInfo();
            
            // Check role-specific access
            if (currentPage === 'dashboard-admin.html' && !checkRole('admin')) return;
            if (currentPage === 'dashboard-atasan.html' && !checkRole('atasan')) return;
            if (currentPage === 'dashboard-pemagang.html' && !checkRole('pemagang')) return;
            if (currentPage === 'dashboard-pembimbing.html' && !checkRole('pembimbing')) return;
        }
    }
    
    // Auto-redirect if already logged in and on login page
    if (currentPage === 'login.html') {
        const sessionData = getSessionData();
        if (sessionData) {
            const user = users[sessionData.email];
            if (user) {
                window.location.href = user.dashboard;
                return;
            }
        }
    }
}

// Demo login function for quick testing
function demoLogin(role) {
    const demoCredentials = {
        'admin': { email: 'admin@unri.ac.id', password: 'admin123' },
        'atasan': { email: 'atasan@unri.ac.id', password: 'atasan123' },
        'pemagang': { email: 'pemagang@unri.ac.id', password: 'pemagang123' },
        'pembimbing': { email: 'pembimbing@unri.ac.id', password: 'pembimbing123' }
    };
    
    const credentials = demoCredentials[role];
    if (credentials) {
        document.getElementById('email').value = credentials.email;
        document.getElementById('password').value = credentials.password;
        
        showToast(`Demo login sebagai ${role}`, 'info');
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializePage();
    
    // Add login form event listener
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', login);
    }
});

// Export functions for global use
window.login = login;
window.logout = logout;
window.checkAuth = checkAuth;
window.checkRole = checkRole;
window.showToast = showToast;
window.demoLogin = demoLogin;

