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

        .processing-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .processing-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff9800, #ffb74d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.7); }
            50% { transform: scale(1.05); }
            70% { transform: scale(1); box-shadow: 0 0 0 20px rgba(255, 152, 0, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 152, 0, 0); }
        }

        .processing-icon i {
            color: white;
            font-size: 48px;
        }

        h1 {
            color: #ff9800;
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .order-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-weight: 500;
        }

        .info-value {
            color: #333;
            font-weight: 600;
            text-align: right;
            word-break: break-all;
        }

        .status-container {
            margin: 30px 0;
        }

        .status-text {
            color: #ff9800;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .checking-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .dots {
            display: flex;
            gap: 5px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #ff9800;
            border-radius: 50%;
            animation: dotPulse 1.4s infinite ease-in-out both;
        }

        .dot:nth-child(1) { animation-delay: -0.32s; }
        .dot:nth-child(2) { animation-delay: -0.16s; }
        .dot:nth-child(3) { animation-delay: 0s; }

        @keyframes dotPulse {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        .progress-container {
            background: #e0e0e0;
            border-radius: 10px;
            height: 6px;
            margin: 30px 0;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ff9800, #ffb74d);
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 10px;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            color: #666;
            font-size: 14px;
        }

        .timer {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 20px 0;
        }

        .message-box {
            background: #e8f4f8;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            border-radius: 10px;
            margin-top: 25px;
            text-align: left;
        }

        .message-box h4 {
            color: #17a2b8;
            margin-bottom: 10px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-box p {
            color: #555;
            font-size: 14px;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-refresh {
            background: #ff9800;
            color: white;
        }

        .btn-refresh:hover {
            background: #f57c00;
            transform: translateY(-2px);
        }

        .btn-home {
            background: #f8f9fa;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-home:hover {
            background: #e9ecef;
            border-color: #ff9800;
        }

        .status-update {
            background: #fff8e1;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .success-indicator {
            color: #4CAF50;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        @media (max-width: 480px) {
            .processing-card {
                padding: 25px;
            }
            
            h1 {
                font-size: 26px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="processing-card">
        <div class="processing-icon">
            <i class="fas fa-sync-alt"></i>
        </div>
        
        <h1>Payment Processing</h1>
        <p class="subtitle">We're verifying your payment. This usually takes a few seconds.</p>
        
        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Order ID:</span>
                <span class="info-value" id="orderId">{{ $merchant_order_id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Amount:</span>
                <span class="info-value" id="amount">₹{{ number_format($payment->amount, 2) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Donor:</span>
                <span class="info-value" id="donorName">{{ $payment->donor_name }}</span>
            </div>
        </div>
        
        <div class="status-container">
            <div class="status-text" id="statusText">Checking payment status...</div>
            <div class="checking-indicator">
                <span>Checking</span>
                <div class="dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </div>
        
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        
        <div class="stats">
            <span id="checkCount">Checks: 0</span>
            <span id="timeElapsed">Time: 0s</span>
            <span id="maxTime">Max: {{ round($max_checks * $check_interval / 1000) }}s</span>
        </div>
        
        <div class="timer" id="timer">00:00</div>
        
        <div class="status-update" id="statusUpdate" style="display: none;">
            <!-- Status updates will appear here -->
        </div>
        
        <div class="message-box">
            <h4><i class="fas fa-info-circle"></i> What's happening?</h4>
            <p>We're checking your payment status every second. The page will automatically update when the payment is confirmed or failed.</p>
        </div>
        
        <div class="action-buttons">
            <button class="btn btn-refresh" id="manualCheckBtn">
                <i class="fas fa-sync-alt"></i> Check Now
            </button>
            <a href="/" class="btn btn-home">
                <i class="fas fa-home"></i> Go Home
            </a>
        </div>
    </div>

    <script>
        // Configuration
        const config = {
            orderId: "{{ $merchant_order_id }}",
            checkUrl: "{{ $check_status_url }}",
            checkInterval: {{ $check_interval }}, // milliseconds
            maxChecks: {{ $max_checks }},
            csrfToken: "{{ csrf_token() }}"
        };

        // State
        let checkCount = 0;
        let startTime = Date.now();
        let timerInterval;
        let checkInterval;
        let isChecking = true;

        // DOM Elements
        const statusText = document.getElementById('statusText');
        const statusUpdate = document.getElementById('statusUpdate');
        const progressBar = document.getElementById('progressBar');
        const checkCountElement = document.getElementById('checkCount');
        const timeElapsedElement = document.getElementById('timeElapsed');
        const timerElement = document.getElementById('timer');
        const manualCheckBtn = document.getElementById('manualCheckBtn');

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            startTimer();
            startStatusChecking();
            
            // Manual check button
            manualCheckBtn.addEventListener('click', function() {
                if (!isChecking) {
                    startStatusChecking();
                }
                checkStatus();
            });
        });

        // Start timer
        function startTimer() {
            timerInterval = setInterval(updateTimer, 1000);
        }

        // Update timer display
        function updateTimer() {
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const minutes = Math.floor(elapsed / 60).toString().padStart(2, '0');
            const seconds = (elapsed % 60).toString().padStart(2, '0');
            
            timerElement.textContent = `${minutes}:${seconds}`;
            timeElapsedElement.textContent = `Time: ${elapsed}s`;
            
            // Update progress bar
            const progress = Math.min((checkCount / config.maxChecks) * 100, 100);
            progressBar.style.width = `${progress}%`;
            
            // Stop after max time
            if (elapsed >= config.maxChecks * (config.checkInterval / 1000)) {
                stopChecking();
                showFinalMessage('Maximum checking time reached. Please check your payment status manually.');
            }
        }

        // Start status checking
        function startStatusChecking() {
            isChecking = true;
            checkInterval = setInterval(checkStatus, config.checkInterval);
            statusText.textContent = 'Checking payment status...';
            statusUpdate.style.display = 'none';
        }

        // Stop status checking
        function stopChecking() {
            isChecking = false;
            clearInterval(checkInterval);
            clearInterval(timerInterval);
            statusText.textContent = 'Status check completed';
        }

        // Check payment status
        async function checkStatus() {
            if (!isChecking) return;
            
            try {
                const response = await fetch(config.checkUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken
                    },
                    body: JSON.stringify({
                        order_id: config.orderId
                    })
                });

                const data = await response.json();
                
                checkCount++;
                checkCountElement.textContent = `Checks: ${checkCount}`;
                
                if (data.success) {
                    updateStatusDisplay(data);
                    
                    // Redirect if payment completed or failed
                    if (data.redirect_url) {
                        stopChecking();
                        setTimeout(() => {
                            window.location.href = data.redirect_url;
                        }, 2000); // Wait 2 seconds before redirecting
                    }
                } else {
                    showStatusUpdate('error', `Check failed: ${data.message}`);
                }
                
            } catch (error) {
                console.error('Error checking status:', error);
                showStatusUpdate('error', 'Network error. Retrying...');
            }
        }

        // Update status display
        function updateStatusDisplay(data) {
            const status = data.status;
            
            // Update status text
            statusText.textContent = `Status: ${status}`;
            
            // Show status update
            let message = `Payment status: ${status}`;
            let type = 'info';
            
            switch(status) {
                case 'COMPLETED':
                    message = '✅ Payment successful! Redirecting to success page...';
                    type = 'success';
                    break;
                case 'FAILED':
                case 'DECLINED':
                    message = '❌ Payment failed. Redirecting to failure page...';
                    type = 'error';
                    break;
                case 'PENDING':
                    message = '⏳ Payment is still processing...';
                    type = 'info';
                    break;
            }
            
            showStatusUpdate(type, message);
            
            // Add transaction ID if available
            if (data.transaction_id) {
                showStatusUpdate('info', `Transaction ID: ${data.transaction_id}`);
            }
        }

        // Show status update message
        function showStatusUpdate(type, message) {
            const updateDiv = document.createElement('div');
            updateDiv.className = `status-update-message ${type}`;
            updateDiv.innerHTML = `
                <i class="fas fa-${getIconForType(type)}"></i>
                <span>${message}</span>
                <span class="timestamp">${new Date().toLocaleTimeString()}</span>
            `;
            
            statusUpdate.prepend(updateDiv);
            statusUpdate.style.display = 'block';
            
            // Limit to 5 messages
            const messages = statusUpdate.querySelectorAll('.status-update-message');
            if (messages.length > 5) {
                messages[messages.length - 1].remove();
            }
            
            // Auto-remove after 10 seconds for info messages
            if (type === 'info') {
                setTimeout(() => {
                    updateDiv.remove();
                    if (statusUpdate.children.length === 0) {
                        statusUpdate.style.display = 'none';
                    }
                }, 10000);
            }
        }

        // Show final message
        function showFinalMessage(message) {
            statusUpdate.innerHTML = `
                <div class="message-box" style="margin: 0;">
                    <h4><i class="fas fa-exclamation-triangle"></i> Timeout</h4>
                    <p>${message}</p>
                    <div class="action-buttons" style="margin-top: 15px;">
                        <a href="${config.checkUrl}?order_id=${config.orderId}" 
                           class="btn btn-refresh" style="flex: none; padding: 8px 16px;">
                            <i class="fas fa-sync-alt"></i> Check Again
                        </a>
                    </div>
                </div>
            `;
            statusUpdate.style.display = 'block';
        }

        // Get icon for message type
        function getIconForType(type) {
            switch(type) {
                case 'success': return 'check-circle';
                case 'error': return 'exclamation-circle';
                case 'info': return 'info-circle';
                default: return 'info-circle';
            }
        }

        // Add CSS for status update messages
        const style = document.createElement('style');
        style.textContent = `
            .status-update-message {
                padding: 10px 15px;
                margin: 8px 0;
                border-radius: 8px;
                display: flex;
                align-items: center;
                gap: 10px;
                animation: fadeIn 0.3s ease;
            }
            
            .status-update-message.success {
                background: #d4edda;
                color: #155724;
                border-left: 4px solid #28a745;
            }
            
            .status-update-message.error {
                background: #f8d7da;
                color: #721c24;
                border-left: 4px solid #dc3545;
            }
            
            .status-update-message.info {
                background: #d1ecf1;
                color: #0c5460;
                border-left: 4px solid #17a2b8;
            }
            
            .status-update-message .timestamp {
                margin-left: auto;
                font-size: 12px;
                color: #666;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>