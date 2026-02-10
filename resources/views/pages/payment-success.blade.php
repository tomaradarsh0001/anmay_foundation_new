<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Anmay Foundation</title>
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

        .success-card {
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

        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #00b09b, #96c93d);
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: bounceIn 0.8s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .success-icon i {
            color: white;
            font-size: 36px;
        }

        h1 {
            color: #00b09b;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .amount-box {
            background: linear-gradient(135deg, rgba(0, 176, 155, 0.1), rgba(150, 201, 61, 0.1));
            border: 2px dashed #00b09b;
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
        }

        .amount-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .amount {
            color: #00b09b;
            font-size: 36px;
            font-weight: 700;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
            text-align: left;
        }

        .detail-item {
            padding: 12px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #00b09b;
        }

        .detail-label {
            color: #666;
            font-size: 12px;
            margin-bottom: 5px;
            display: block;
        }

        .detail-value {
            color: #333;
            font-size: 14px;
            font-weight: 600;
            word-break: break-all;
        }

        .countdown-box {
            background: #f0f9ff;
            border-radius: 12px;
            padding: 15px;
            margin: 25px 0;
            border: 1px solid #b3e0ff;
        }

        .countdown-text {
            color: #0066cc;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .countdown {
            color: #00b09b;
            font-size: 24px;
            font-weight: 700;
        }

        .btn-continue {
            display: inline-block;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white;
            padding: 14px 30px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-continue:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 176, 155, 0.3);
        }

        .footer-text {
            margin-top: 25px;
            color: #888;
            font-size: 13px;
            line-height: 1.5;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #00b09b;
            border-radius: 50%;
            opacity: 0;
            z-index: 1;
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .details-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .amount {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <div class="success-card">
        <!-- Confetti elements -->
        <div class="confetti" style="top: 20%; left: 10%; animation-delay: 0.2s;"></div>
        <div class="confetti" style="top: 40%; right: 15%; animation-delay: 0.4s;"></div>
        <div class="confetti" style="top: 60%; left: 20%; animation-delay: 0.6s;"></div>
        
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1>Payment Successful!</h1>
        <p class="subtitle">Thank you for your generous donation to Anmay Foundation</p>
        
        <div class="amount-box">
            <span class="amount-label">Donation Amount</span>
            <div class="amount">₹{{ number_format($amount / 100, 2) }}</div>
        </div>
        
        <div class="details-grid">
            <div class="detail-item">
                <span class="detail-label">Transaction ID</span>
                <span class="detail-value">{{ substr($transaction_id, 0, 12) }}...</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Status</span>
                <span class="detail-value" style="color: #00b09b;">Completed</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Date</span>
                <span class="detail-value">{{ date('d M Y') }}</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Time</span>
                <span class="detail-value">{{ date('h:i A') }}</span>
            </div>
        </div>
        
        <div class="countdown-box">
            <div class="countdown-text">You will be redirected to homepage in</div>
            <div class="countdown" id="countdown">15</div>
            <div style="font-size: 12px; color: #888; margin-top: 5px;">seconds</div>
        </div>
        
        <a href="/" class="btn-continue">
            <i class="fas fa-home"></i> Go to Homepage Now
        </a>
        
        <p class="footer-text">
            A receipt has been sent to your email.<br>
            For any queries, contact support@anmayfoundation.org
        </p>
    </div>

    <script>
        // Countdown timer
        let seconds = 15;
        const countdownElement = document.getElementById('countdown');
        const countdownInterval = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '/';
            }
        }, 1000);

        // Confetti animation
        document.addEventListener('DOMContentLoaded', function() {
            const confettiElements = document.querySelectorAll('.confetti');
            confettiElements.forEach((confetti, index) => {
                setTimeout(() => {
                    confetti.style.animation = 'confettiFall 1s ease-out forwards';
                }, index * 200);
            });
            
            // Create more confetti dynamically
            for (let i = 0; i < 8; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.position = 'absolute';
                confetti.style.width = Math.random() * 8 + 4 + 'px';
                confetti.style.height = Math.random() * 8 + 4 + 'px';
                confetti.style.background = getRandomColor();
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-20px';
                confetti.style.opacity = '0';
                confetti.style.zIndex = '1';
                document.querySelector('.success-card').appendChild(confetti);
                
                // Animate each confetti
                setTimeout(() => {
                    confetti.style.animation = `confettiFall ${Math.random() * 1 + 1}s ease-out forwards`;
                }, i * 100);
            }
        });

        // Add confetti animation CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes confettiFall {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                }
                100% {
                    transform: translateY(100vh) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        function getRandomColor() {
            const colors = ['#00b09b', '#96c93d', '#667eea', '#764ba2', '#f093fb', '#f5576c'];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        // Manual redirect on button click
        document.querySelector('.btn-continue').addEventListener('click', function(e) {
            e.preventDefault();
            clearInterval(countdownInterval);
            window.location.href = '/donate-now';
        });

        // Allow manual skip with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.key === ' ') {
                clearInterval(countdownInterval);
                window.location.href = '/';
            }
        });
    </script>
</body>
</html>