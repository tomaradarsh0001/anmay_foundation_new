<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - Anmay Foundation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .failed-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            max-width: 450px;
            width: 100%;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            animation: slideIn 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .failed-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #f44336, #ef5350);
        }

        .failed-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f44336, #ef5350);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: shake 0.8s ease;
        }

        .failed-icon i {
            color: white;
            font-size: 36px;
        }

        h1 {
            color: #f44336;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .error-box {
            background: #ffebee;
            border: 2px solid #f44336;
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
        }

        .error-title {
            color: #f44336;
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .error-text {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .reason-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }

        .reason-title {
            color: #333;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .reason-list {
            list-style: none;
            padding-left: 0;
        }

        .reason-list li {
            color: #666;
            font-size: 14px;
            padding: 6px 0;
            padding-left: 20px;
            position: relative;
        }

        .reason-list li:before {
            content: '•';
            color: #f44336;
            position: absolute;
            left: 0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin: 25px 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
            min-width: 140px;
        }

        .btn-retry {
            background: linear-gradient(135deg, #f44336, #ef5350);
            color: white;
            border: none;
        }

        .btn-retry:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(244, 67, 54, 0.3);
        }

        .btn-home {
            background: white;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-home:hover {
            background: #f8f9fa;
            transform: translateY(-3px);
            border-color: #f44336;
        }

        .support-box {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .support-title {
            color: #333;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .support-info {
            color: #666;
            font-size: 13px;
            line-height: 1.5;
        }

        .auto-redirect {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .redirect-text {
            color: #666;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .redirect-countdown {
            color: #f44336;
            font-size: 16px;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .failed-card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="failed-card">
        <div class="failed-icon">
            <i class="fas fa-times"></i>
        </div>
        
        <h1>Payment Failed</h1>
        <p class="subtitle">We couldn't process your donation. Please try again.</p>
        
        <div class="error-box">
            <div class="error-title">
                <i class="fas fa-exclamation-triangle"></i> Error Details
            </div>
            <p class="error-text">
                Transaction ID: <strong>{{ $transaction_id ?? 'N/A' }}</strong><br>
                Error: <strong>{{ $error_message ?? 'Payment declined' }}</strong><br>
                Amount: <strong>₹{{ number_format($amount / 100, 2) }}</strong>
            </p>
        </div>
        
        <div class="reason-box">
            <div class="reason-title">Possible Reasons:</div>
            <ul class="reason-list">
                <li>Insufficient funds in your account</li>
                <li>Incorrect card details entered</li>
                <li>Transaction timeout exceeded</li>
                <li>Bank server is temporarily down</li>
                <li>Daily transaction limit reached</li>
            </ul>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('donate') ?? '#' }}" class="btn btn-retry">
                <i class="fas fa-redo"></i> Try Again
            </a>
            <a href="/" class="btn btn-home">
                <i class="fas fa-home"></i> Go to Homepage
            </a>
        </div>
        
        <div class="auto-redirect">
            <div class="redirect-text">You will be redirected to donation page in</div>
            <div class="redirect-countdown" id="countdown">15</div>
            <div style="font-size: 11px; color: #888; margin-top: 3px;">seconds</div>
        </div>
        
        <div class="support-box">
            <div class="support-title">Need Help?</div>
            <p class="support-info">
                Contact our support team:<br>
                ✉️ support@anmayfoundation.org<br>
                📞 +91-XXXXXXXXXX (10 AM - 6 PM)
            </p>
        </div>
    </div>

    <script>
        // Countdown for auto-redirect
        let seconds = 15;
        const countdownElement = document.getElementById('countdown');
        
        const countdownInterval = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "{{ route('donate') ?? '/' }}";
            }
        }, 1000);

        // Cancel auto-redirect if user clicks any button
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                clearInterval(countdownInterval);
            });
        });

        // Allow skipping with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                clearInterval(countdownInterval);
                document.querySelector('.auto-redirect').innerHTML = 
                    '<div style="color: #666; font-size: 13px;">Auto-redirect cancelled</div>';
            }
        });
    </script>
</body>
</html>