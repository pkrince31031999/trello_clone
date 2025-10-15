<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaaryaHub - Reset Password</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
            pointer-events: none;
        }

        /* Main Container - Horizontal Layout */
        .main-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* Left Side - Branding/Visual */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
            opacity: 0.3;
        }

        .brand-content {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
            animation: slideInLeft 1s ease-out;
        }

        .brand-logo {
            width: 200px;
            height: auto;
            margin-bottom: 30px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            animation: float 3s ease-in-out infinite;
        }

        .brand-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .brand-subtitle {
            font-size: 20px;
            font-weight: 300;
            opacity: 0.9;
            margin-bottom: 40px;
            line-height: 1.5;
        }

        .brand-features {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 400px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 24px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(8px);
        }

        .feature-icon {
            font-size: 24px;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-text {
            font-size: 16px;
            font-weight: 500;
        }

        /* Right Side - Reset Form */
        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            position: relative;
        }

        .reset-container {
            width: 100%;
            max-width: 450px;
            animation: slideInRight 1s ease-out;
        }

        /* Enhanced Form Styling */
        .reset-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .reset-title {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .reset-subtitle {
            color: #718096;
            font-size: 16px;
            margin: 0;
        }

        .reset-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .reset-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .form-group {
            margin-bottom: 28px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #4a5568;
            transition: color 0.3s ease;
        }

        .input-wrapper {
            position: relative;
            transition: all 0.3s ease;
        }

        .input-wrapper:hover {
            transform: translateY(-1px);
        }

        .form-control {
            width: 100%;
            padding: 18px 20px 18px 55px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            color: #2d3748;
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        .form-control:focus + .input-icon {
            color: #667eea;
            transform: translateY(-50%) scale(1.1);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Enhanced Footer */
        .reset-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .reset-footer p {
            color: #718096;
            font-size: 14px;
            margin: 8px 0;
        }

        .reset-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .reset-footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .reset-footer a:hover::after {
            width: 100%;
        }

        .reset-footer a:hover {
            color: #764ba2;
        }

        /* Loading States */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .left-side {
                padding: 40px 30px;
            }

            .brand-title {
                font-size: 40px;
            }

            .brand-subtitle {
                font-size: 18px;
            }

            .right-side {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .left-side {
                flex: 0 0 40%;
                padding: 30px 20px;
            }

            .brand-logo {
                width: 150px;
            }

            .brand-title {
                font-size: 32px;
            }

            .brand-subtitle {
                font-size: 16px;
            }

            .brand-features {
                display: none;
            }

            .right-side {
                flex: 1;
                padding: 20px;
            }

            .reset-form {
                padding: 30px;
            }
        }

        @media (max-width: 480px) {
            .left-side {
                flex: 0 0 35%;
                padding: 20px 15px;
            }

            .brand-logo {
                width: 120px;
            }

            .brand-title {
                font-size: 24px;
            }

            .brand-subtitle {
                font-size: 14px;
            }

            .right-side {
                padding: 15px;
            }

            .reset-form {
                padding: 25px;
            }

            .reset-title {
                font-size: 24px;
            }

            .form-control {
                padding: 16px 18px 16px 50px;
                font-size: 15px;
            }

            .btn {
                padding: 16px;
                font-size: 15px;
            }
        }

        @media (max-width: 360px) {
            .left-side {
                flex: 0 0 30%;
                padding: 15px 10px;
            }

            .brand-logo {
                width: 100px;
            }

            .brand-title {
                font-size: 20px;
            }

            .brand-subtitle {
                font-size: 12px;
            }

            .reset-form {
                padding: 20px;
            }

            .form-control {
                padding: 14px 16px 14px 45px;
                font-size: 14px;
            }

            .btn {
                padding: 14px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Left Side - Branding -->
        <div class="left-side">
            <div class="brand-content">
                <img src="http://localhost/trello_clone/public/images/KaaryaHub_logo.png" alt="KaaryaHub Logo" class="brand-logo" />
                <h1 class="brand-title">Reset Your Password</h1>
                <p class="brand-subtitle">Don't worry, it happens to the best of us</p>
                
                <div class="brand-features">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <span class="feature-text">Secure password reset process</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-envelope feature-icon"></i>
                        <span class="feature-text">Check your email for reset link</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-lock feature-icon"></i>
                        <span class="feature-text">Create a strong new password</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Reset Form -->
        <div class="right-side">
            <div class="reset-container">
                <!-- Reset Header -->
                <div class="reset-header">
                    <h1 class="reset-title">Reset Password</h1>
                    <p class="reset-subtitle">Enter your email address and we'll send you a reset link</p>
                </div>

                <!-- Alert Messages -->
                <div id="alertContainer"></div>

                <!-- Reset Form -->
                <form action="reset_password.php" method="POST" id="resetForm" class="reset-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn" id="resetBtn">
                        <span id="resetBtnText">Send Reset Link</span>
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="reset-footer">
                    <p>
                        Remember your password? <a href="login.php" class="back-link">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced Reset Password Functionality
        let isLoading = false;

        // Enhanced form submission
        document.getElementById('resetForm').addEventListener("submit", function(e) {
            e.preventDefault();
            
            if (isLoading) return;
            
            const email = document.getElementById('email').value.trim();

            // Enhanced validation
            if (!email) {
                showAlert('Please enter your email address', 'error');
                document.getElementById('email').focus();
                return;
            }

            if (!isValidEmail(email)) {
                showAlert('Please enter a valid email address', 'error');
                document.getElementById('email').focus();
                return;
            }

            setLoading(true);

            $.ajax({
                type: 'POST',
                url: 'index.php?action=sendPasswordResetLink&controller=user',
                data: {
                    email: email
                },
                success: function(response) {
                    setLoading(false);
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => {
                            window.location.href = 'login.php';
                        }, 2000);
                    } else {
                        showAlert(response.error || 'Failed to send reset link. Please try again.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    setLoading(false);
                    showAlert('Network error. Please check your connection and try again.', 'error');
                }
            });
        });

        // Email validation
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Set loading state
        function setLoading(loading) {
            const resetBtn = document.getElementById('resetBtn');
            const resetBtnText = document.getElementById('resetBtnText');
            
            if (loading) {
                resetBtn.disabled = true;
                resetBtn.classList.add('loading');
                resetBtnText.textContent = 'Sending...';
                isLoading = true;
            } else {
                resetBtn.disabled = false;
                resetBtn.classList.remove('loading');
                resetBtnText.textContent = 'Send Reset Link';
                isLoading = false;
            }
        }

        // Enhanced notification system
        function showAlert(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification-toast');
            existingNotifications.forEach(notification => notification.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification-toast notification-${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add styles for notification
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
                color: white;
                padding: 16px 20px;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                z-index: 3000;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 400px;
                animation: slideInRight 0.3s ease;
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Enhanced Interactive Features
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth animations to form elements
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Add floating animation to brand logo
            const brandLogo = document.querySelector('.brand-logo');
            if (brandLogo) {
                brandLogo.addEventListener('mouseenter', function() {
                    this.style.animation = 'float 1s ease-in-out infinite';
                });
                
                brandLogo.addEventListener('mouseleave', function() {
                    this.style.animation = 'float 3s ease-in-out infinite';
                });
            }

            // Add interactive effects to feature items
            const featureItems = document.querySelectorAll('.feature-item');
            featureItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.2}s`;
                item.style.animation = 'slideInLeft 0.6s ease forwards';
                
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(12px) scale(1.02)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0) scale(1)';
                });
            });

            // Add typing effect to brand title
            const brandTitle = document.querySelector('.brand-title');
            if (brandTitle) {
                const text = brandTitle.textContent;
                brandTitle.textContent = '';
                let i = 0;
                
                function typeWriter() {
                    if (i < text.length) {
                        brandTitle.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 100);
                    }
                }
                
                setTimeout(typeWriter, 1000);
            }

            // Add parallax effect to left side
            const leftSide = document.querySelector('.left-side');
            if (leftSide) {
                document.addEventListener('mousemove', function(e) {
                    const x = e.clientX / window.innerWidth;
                    const y = e.clientY / window.innerHeight;
                    
                    leftSide.style.transform = `translate(${x * 10}px, ${y * 10}px)`;
                });
            }

            // Add form validation with visual feedback
            const emailInput = document.getElementById('email');
            
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    const isValid = this.value.includes('@') && this.value.includes('.');
                    this.style.borderColor = isValid ? '#10b981' : '#e2e8f0';
                });
            }

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Enter key to submit form
                if (e.key === 'Enter' && !isLoading) {
                    const form = document.getElementById('resetForm');
                    if (form) {
                        form.dispatchEvent(new Event('submit'));
                    }
                }
                
                // Escape key to clear form
                if (e.key === 'Escape') {
                    document.getElementById('email').value = '';
                    document.getElementById('email').focus();
                }
            });

            // Add loading animation to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.classList.contains('loading')) {
                        this.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });
        });

        // Navigation handlers
        document.querySelector(".back-link").addEventListener("click", function(e) {
            e.preventDefault();
            window.location.href = "index.php?action=showLogin&controller=user";
        });

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            
            .notification-toast {
                font-family: 'Inter', sans-serif;
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 8px;
                flex: 1;
            }
            
            .notification-close {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                padding: 4px;
                border-radius: 4px;
                transition: background 0.2s;
            }
            
            .notification-close:hover {
                background: rgba(255, 255, 255, 0.2);
            }
        `;
        document.head.appendChild(style);
    </script>    
</body>
</html>