<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin AKITA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4e73df, #667eea);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .app-title {
            color: #4e73df;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .app-subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4e73df, #667eea);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #dc3545;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 12px;
        }

        .date-display {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #4e73df;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .date-display .month {
            font-size: 10px;
            margin-bottom: 2px;
        }

        .date-display .day {
            font-size: 16px;
            font-weight: 700;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .date-display {
                position: static;
                margin-bottom: 20px;
                display: inline-block;
            }
        }
    </style>
</head>
<body>


    <div class="login-container">
        <div class="logo-section">
            <div class="logo">AK</div>
            <div class="app-title">Agenda Kita</div>
            <div class="app-subtitle">Admin Login</div>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/auth/login">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Masukkan email Anda">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password Anda">
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="footer">
            <p>© 2025 Agenda Kita. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Auto-refresh current date
        function updateDate() {
            const now = new Date();
            const months = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];
            const month = months[now.getMonth()];
            const day = now.getDate();
            
            document.querySelector('.date-display .month').textContent = month;
            document.querySelector('.date-display .day').textContent = day;
        }

        // Update date on page load
        updateDate();

        // Add smooth focus animations
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>