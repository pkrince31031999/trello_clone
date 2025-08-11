
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg,, #d1ca6df7, #f0a80eff);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #6a11cb;
            outline: none;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #c7cb11, #b57009f7);;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn:hover {
            background: linear-gradient(135deg, #e7eb10ff, #e08d10f7);
            transform: scale(1.02);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #ddd;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            padding: 0 10px;
            background: white;
            font-size: 14px;
            color: #777;
        }

        .social-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            gap: 10px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #555;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: 0.3s;
        }

        .social-button img {
            width: 20px;
            height: 20px;
        }

        .social-button:hover {
            background: #f9f9f9;
            transform: translateY(-3px);
        }

        .google {
            border-color: #ea4335;
        }

        .google:hover {
            border-color: #d93025;
        }

        .microsoft {
            border-color: #0067b8;
        }

        .microsoft:hover {
            border-color: #004a8f;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        p a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
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

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: center; margin-bottom: 20px;">
            <img src="http://localhost/trello_clone/public/images/KaaryaHub_logo.png" alt="Logo" style="width: 180px; height: 120px;" />
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>

        <!-- <div class="divider">
            <span>OR</span>
        </div> -->

        <!-- <div class="social-buttons">
            <button class="social-button google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google Logo">
                Continue with Google
            </button>
            <button class="social-button microsoft">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft Logo">
                Continue with Microsoft
            </button>
        </div> -->

        <p>
            Don't have an account? <a href="register.php" class="register-link">Sign up</a><br>
            Forgot password? <a href="forgot_password.php" class="forgot-password-link">Click here</a>
        </p>
    </div>
    
    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault();
            const email = document.querySelector("#email").value;
            const password = document.querySelector("#password").value;

            $.ajax({
            type: 'POST',
            url: 'index.php?action=login&controller=user',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'index.php?action=showDashboard&controller=board';
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
            });
        });

        document.querySelector(".forgot-password-link").addEventListener("click", function(e) {
            e.preventDefault();
            window.location.href = "index.php?action=showForgotPassword&controller=user";
        });

        document.querySelector(".register-link").addEventListener("click", function(e) {
            e.preventDefault();
            window.location.href = "index.php?action=showRegister&controller=user";
        });
    </script>
</body>
</html>