
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaaryaHub - Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Google Identity Services -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            display: flex;
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

        /* Right Side - Login Form */
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

        .login-container {
            width: 100%;
            max-width: 450px;
            animation: slideInRight 1s ease-out;
        }

        /* Enhanced Form Styling */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-title {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            color: #718096;
            font-size: 16px;
            margin: 0;
        }

        .login-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-form::before {
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

        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #a0aec0;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
        }

        .password-toggle:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-50%) scale(1.1);
        }

        /* Enhanced Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
            cursor: pointer;
        }

        .remember-me label {
            font-size: 14px;
            color: #4a5568;
            cursor: pointer;
            margin: 0;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
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

        /* Enhanced Social Login */
        .social-login {
            margin-top: 30px;
        }

        .social-login-title {
            text-align: center;
            color: #718096;
            font-size: 14px;
            margin-bottom: 20px;
            position: relative;
        }

        .social-login-title::before,
        .social-login-title::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: #e2e8f0;
        }

        .social-login-title::before {
            left: 0;
        }

        .social-login-title::after {
            right: 0;
        }

        .social-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            background: white;
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .social-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }

        .social-button:hover::before {
            left: 100%;
        }

        .social-button i {
            font-size: 20px;
        }

        .google {
            border-color: #ea4335;
        }

        .google:hover {
            border-color: #d93025;
            background: #fef7f7;
        }

        .google i {
            color: #ea4335;
        }

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

        /* Enhanced Footer */
        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .login-footer p {
            color: #718096;
            font-size: 14px;
            margin: 8px 0;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .login-footer a:hover::after {
            width: 100%;
        }

        .login-footer a:hover {
            color: #764ba2;
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

            .login-form {
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

            .login-form {
                padding: 25px;
            }

            .login-title {
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

            .social-button {
                padding: 14px;
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

            .login-form {
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

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            padding: 0 20px;
            background: rgba(255, 255, 255, 0.95);
            font-size: 14px;
            color: #a0aec0;
            font-weight: 500;
        }

        .social-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            gap: 12px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            color: #4a5568;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .social-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }

        .social-button:hover::before {
            left: 100%;
        }

        .social-button i {
            font-size: 20px;
        }

        .google {
            border-color: #ea4335;
        }

        .google:hover {
            border-color: #d93025;
            background: #fef7f7;
        }

        .google i {
            color: #ea4335;
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .footer-links p {
            margin: 8px 0;
            font-size: 14px;
            color: #718096;
        }

        .footer-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .footer-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .footer-links a:hover::after {
            width: 100%;
        }

        .footer-links a:hover {
            color: #764ba2;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            display: none;
        }

        .alert-success {
            background: #f0fff4;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #feb2b2;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .container {
                padding: 30px;
                max-width: 400px;
            }

            .welcome-text h1 {
                font-size: 24px;
            }

            .welcome-text p {
                font-size: 14px;
            }

            .form-control {
                padding: 14px 18px 14px 45px;
                font-size: 15px;
            }

            .btn {
                padding: 14px;
                font-size: 15px;
            }

            .social-button {
                padding: 14px;
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 25px;
                border-radius: 16px;
            }

            .logo-container img {
                max-width: 150px;
            }

            .welcome-text h1 {
                font-size: 22px;
            }

            .welcome-text p {
                font-size: 13px;
            }

            .form-control {
                padding: 12px 16px 12px 40px;
                font-size: 14px;
            }

            .input-icon {
                font-size: 16px;
                left: 15px;
            }

            .btn {
                padding: 12px;
                font-size: 14px;
            }

            .social-button {
                padding: 12px;
                font-size: 14px;
            }

            .footer-links p {
                font-size: 13px;
            }
        }

        @media (max-width: 360px) {
            .container {
                padding: 20px;
            }

            .welcome-text h1 {
                font-size: 20px;
            }

            .form-control {
                padding: 10px 14px 10px 35px;
                font-size: 13px;
            }

            .input-icon {
                font-size: 14px;
                left: 12px;
            }

            .btn {
                padding: 10px;
                font-size: 13px;
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
                <h1 class="brand-title">Welcome to KaaryaHub</h1>
                <p class="brand-subtitle">Your ultimate project management solution</p>
                
                <div class="brand-features">
                    <div class="feature-item">
                        <i class="fas fa-tasks feature-icon"></i>
                        <span class="feature-text">Organize your tasks efficiently</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users feature-icon"></i>
                        <span class="feature-text">Collaborate with your team</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <span class="feature-text">Track your progress</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="right-side">
            <div class="login-container">
                <!-- Login Header -->
                <div class="login-header">
                    <h1 class="login-title">Welcome Back!</h1>
                    <p class="login-subtitle">Sign in to your account to continue</p>
                </div>

                <!-- Alert Messages -->
                <div id="alertContainer"></div>

                <!-- Login Form -->
                <form method="POST" id="loginForm" class="login-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="passwordToggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Form Options -->
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="rememberMe" name="rememberMe">
                            <label for="rememberMe">Remember me</label>
                        </div>
                        <a href="forgot_password.php" class="forgot-password-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn" id="loginBtn">
                        <span id="loginBtnText">Sign In</span>
                    </button>
                </form>

                <!-- Social Login -->
                <div class="social-login">
                    <div class="social-login-title">Or continue with</div>
                    <div class="social-buttons">
                        <button class="social-button google" id="googleSignInBtn">
                            <i class="fab fa-google"></i>
                            Continue with Google
                        </button>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="login-footer">
                    <p>
                        Don't have an account? <a href="register.php" class="register-link">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Enhanced Login Functionality
        let isLoading = false;

        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('passwordToggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Show alert function
        function showAlert(message, type = 'error') {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
            
            alertContainer.innerHTML = `
                <div class="alert ${alertClass}">
                    ${message}
                </div>
            `;
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        // Set loading state
        function setLoading(loading) {
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');
            
            if (loading) {
                loginBtn.disabled = true;
                loginBtn.classList.add('loading');
                loginBtnText.textContent = 'Signing In...';
                isLoading = true;
            } else {
                loginBtn.disabled = false;
                loginBtn.classList.remove('loading');
                loginBtnText.textContent = 'Sign In';
                isLoading = false;
            }
        }

        // Enhanced form submission
        document.getElementById('loginForm').addEventListener("submit", function(e) {
            e.preventDefault();
            
            if (isLoading) return;
            
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            // Basic validation
            if (!email || !password) {
                showAlert('Please fill in all fields');
                return;
            }

            if (!isValidEmail(email)) {
                showAlert('Please enter a valid email address');
                return;
            }

            setLoading(true);

            $.ajax({
                type: 'POST',
                url: 'index.php?action=login&controller=user',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    setLoading(false);
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => {
                            window.location.href = 'index.php?action=showDashboard&controller=board';
                        }, 1500);
                    } else {
                        showAlert(response.error || 'Login failed. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    setLoading(false);
                    showAlert('Network error. Please check your connection and try again.');
                }
            });
        });

        // Email validation
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Google Sign-In Integration
        function initializeGoogleSignIn() {
            if (typeof google !== 'undefined' && google.accounts) {
                google.accounts.id.initialize({
                    client_id: 'YOUR_GOOGLE_CLIENT_ID', // Replace with your actual Google Client ID
                    callback: handleGoogleSignIn
                });

                document.getElementById('googleSignInBtn').addEventListener('click', function() {
                    if (isLoading) return;
                    
                    setLoading(true);
                    google.accounts.id.prompt();
                });
            } else {
                // Fallback for when Google API is not loaded
                document.getElementById('googleSignInBtn').addEventListener('click', function() {
                    showAlert('Google Sign-In is not available. Please use email and password.');
                });
            }
        }

        // Handle Google Sign-In response
        function handleGoogleSignIn(response) {
            try {
                const credential = response.credential;
                const payload = JSON.parse(atob(credential.split('.')[1]));
                
                // Send Google user data to your backend
                $.ajax({
                    type: 'POST',
                    url: 'index.php?action=googleLogin&controller=user',
                    data: {
                        google_token: credential,
                        email: payload.email,
                        name: payload.name,
                        picture: payload.picture
                    },
                    success: function(response) {
                        setLoading(false);
                        if (response.success) {
                            showAlert('Welcome! Signing you in...', 'success');
                            setTimeout(() => {
                                window.location.href = 'index.php?action=showDashboard&controller=board';
                            }, 1500);
                        } else {
                            showAlert(response.error || 'Google Sign-In failed. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        setLoading(false);
                        showAlert('Google Sign-In failed. Please try again.');
                    }
                });
            } catch (error) {
                setLoading(false);
                showAlert('Google Sign-In failed. Please try again.');
            }
        }

        // Navigation handlers
        document.querySelector(".forgot-password-link").addEventListener("click", function(e) {
            e.preventDefault();
            window.location.href = "index.php?action=showForgotPassword&controller=user";
        });

        document.querySelector(".register-link").addEventListener("click", function(e) {
            e.preventDefault();
            window.location.href = "index.php?action=showRegister&controller=user";
        });

        // Initialize Google Sign-In when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for Google API to load
            if (typeof google !== 'undefined') {
                initializeGoogleSignIn();
            } else {
                // Retry after a short delay
                setTimeout(initializeGoogleSignIn, 1000);
            }
        });

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
            const passwordInput = document.getElementById('password');
            
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    const isValid = this.value.includes('@') && this.value.includes('.');
                    this.style.borderColor = isValid ? '#10b981' : '#e2e8f0';
                });
            }
            
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const isValid = this.value.length >= 6;
                    this.style.borderColor = isValid ? '#10b981' : '#e2e8f0';
                });
            }

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Enter key to submit form
                if (e.key === 'Enter' && !isLoading) {
                    const form = document.getElementById('loginForm');
                    if (form) {
                        form.dispatchEvent(new Event('submit'));
                    }
                }
                
                // Escape key to clear form
                if (e.key === 'Escape') {
                    document.getElementById('email').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('email').focus();
                }
            });

            // Add loading animation to buttons
            const buttons = document.querySelectorAll('.btn, .social-button');
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

        // Enhanced form submission with better UX
        document.getElementById('loginForm').addEventListener("submit", function(e) {
            e.preventDefault();
            
            if (isLoading) return;
            
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;

            // Enhanced validation
            if (!email || !password) {
                showAlert('Please fill in all fields', 'error');
                return;
            }

            if (!isValidEmail(email)) {
                showAlert('Please enter a valid email address', 'error');
                document.getElementById('email').focus();
                return;
            }

            if (password.length < 6) {
                showAlert('Password must be at least 6 characters', 'error');
                document.getElementById('password').focus();
                return;
            }

            setLoading(true);

            $.ajax({
                type: 'POST',
                url: 'index.php?action=login&controller=user',
                data: {
                    email: email,
                    password: password,
                    rememberMe: rememberMe
                },
                success: function(response) {
                    setLoading(false);
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => {
                            window.location.href = 'index.php?action=showDashboard&controller=board';
                        }, 1500);
                    } else {
                        showAlert(response.error || 'Login failed. Please try again.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    setLoading(false);
                    showAlert('Network error. Please check your connection and try again.', 'error');
                }
            });
        });
    </script>
</body>
</html>