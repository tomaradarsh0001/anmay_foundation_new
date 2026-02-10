<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Processing - Anmay Foundation</title>
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

        .pending-card {
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

        .pending-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #ff9800, #ffb74d);
        }

        .pending-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff9800, #ffb74d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
        }

        .pending-icon i {
            color: white;
            font-size: 36px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        h1 {
            color: #ff9800;
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

        .info-box {
            background: #fff8e1;
            border: 2px solid #ff9800;
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
        }

        .info-title {
            color: #ff9800;
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-text {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-size: 14px;
        }

        .detail-value {
            color: #333;
            font-size: 14px;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            background: #ff9800;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-check {
            display: inline-block;
            background: linear-gradient(135deg, #ff9800, #ffb74d);
            color: white;
            padding: 14px 30px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .btn-check:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 152, 0, 0.3);
        }

        .auto-refresh {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .refresh-text {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .refresh-countdown {
            color: #ff9800;
            font-size: 18px;
            font-weight: 600;
        }

        .contact-info {
            margin-top: 20px;
            color: #888;
            font-size: 13px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .pending-card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .detail-row {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="pending-card">
        <div class="pending-icon">
            <i class="fas fa-clock"></i>
        </div>
        
        <span class="status-badge">PROCESSING</span>
        <h1>Payment Processing</h1>
        <p class="subtitle">Your donation is being processed. This may take a few moments.</p>
        
        <div class="info-box">
            <div class="info-title">
                <i class="fas fa-info-circle"></i> What's happening?
            </div>
            <p class="info-text">
                We've received your payment request of ₹{{ number_format($amount / 100, 2) }}. 
                The transaction is currently being verified by our payment gateway.
            </p>
        </div>
        
        <div class="details">
            <div class="detail-row">
                <span class="detail-label">Transaction ID:</span>
                <span class="detail-value">{{ substr($transaction_id, 0, 12) }}...</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date & Time:</span>
                <span class="detail-value">{{ date('d M Y, h:i A') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Donor Name:</span>
                <span class="detail-value">{{ $donor_name ?? 'Guest Donor' }}</span>
            </div>
        </div>
        
        <a href="#" class="btn-check" id="checkStatusBtn">
            <i class="fas fa-sync-alt"></i> Check Status Now
        </a>
        
        <div class="auto-refresh">
            <div class="refresh-text">Page will auto-refresh in</div>
            <div class="refresh-countdown" id="countdown">30</div>
            <div style="font-size: 12px; color: #888; margin-top: 5px;">seconds</div>
        </div>
        
        <p class="contact-info">
            If payment doesn't complete within 10 minutes,<br>
            please contact support@anmayfoundation.org
        </p>
    </div>

    <script>
        // Countdown for auto-refresh
        let seconds = 30;
        const countdownElement = document.getElementById('countdown');
        
        const countdownInterval = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                window.location.reload();
            }
        }, 1000);

        // Manual status check
        document.getElementById('checkStatusBtn').addEventListener('click', function(e) {
            e.preventDefault();
            clearInterval(countdownInterval);
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            this.disabled = true;
            
            // Simulate API check (replace with actual API call)
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        });

        // Allow skipping auto-refresh with Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                clearInterval(countdownInterval);
                alert('Auto-refresh cancelled. Please check status manually.');
            }
        });
    </script>
</body>
</html>