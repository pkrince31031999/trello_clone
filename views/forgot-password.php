<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #333;
        }

        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #6a11cb;
        }

        p {
            font-size: 14px;
            margin-bottom: 20px;
            color: #555;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
            transition: border 0.3s;
        }

        input[type="email"]:focus {
            border-color: #6a11cb;
        }

        .btn-reset {
            display: inline-block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-reset:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        .back-link {
            margin-top: 20px;
            display: block;
            font-size: 14px;
            color: #6a11cb;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 25px;
            }

            h2 {
                font-size: 20px;
            }

            input[type="email"],
            .btn-reset {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <p>Enter the email address associated with your account, and we’ll send you a link to reset your password.</p>
        <form action="reset_password.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn-reset">Send Reset Link</button>
        </form>
        <a href="login.php" class="back-link">Back to Login</a>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault();
            const email = document.querySelector("#email").value;

            $.ajax({
            type: 'POST',
            url: 'index.php?action=sendPasswordResetLink&controller=user',
            data: {
                email: email
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'login.php';
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
            });

        });

        document.querySelector(".back-link").addEventListener("click", function(e) {
            e.preventDefault();
            window.location.href = "index.php?action=showLogin&controller=user";
        });
    </script>    
</body>
</html>