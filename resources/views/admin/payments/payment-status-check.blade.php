<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Payment Status - Anmay Foundation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .status-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: #00b09b;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .logo p {
            color: #666;
            font-size: 1.1rem;
        }
        
        .result-card {
            border-radius: 15px;
            padding: 0;
            overflow: hidden;
            margin-top: 25px;
            display: none;
        }
        
        .result-header {
            padding: 20px;
            color: white;
            font-weight: 600;
        }
        
        .result-body {
            padding: 25px;
            background: #f8f9fa;
        }
        
        .status-badge {
            font-size: 0.9rem;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .btn-check {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            border: none;
            padding: 14px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-check:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 176, 155, 0.3);
        }
        
        .btn-check:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        
        .loading-spinner {
            display: none;
        }
        
        .info-box {
            background: #e8f4f8;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .order-input {
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .order-input:focus {
            border-color: #00b09b;
            box-shadow: 0 0 0 3px rgba(0, 176, 155, 0.1);
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #666;
            font-weight: 500;
        }
        
        .detail-value {
            color: #333;
            font-weight: 600;
            text-align: right;
        }
        
        .error-alert {
            animation: shake 0.5s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="status-card">
        <div class="logo">
            <h1><i class="fas fa-search-dollar"></i> Payment Status</h1>
            <p>Check the status of your donation payment</p>
        </div>
        
        <form id="statusForm">
            @csrf
            <div class="mb-4">
                <label for="order_id" class="form-label fw-bold mb-2">
                    <i class="fas fa-receipt"></i> Enter your Order ID
                </label>
                <input type="text" 
                       class="form-control order-input" 
                       id="order_id" 
                       name="order_id"
                       placeholder="e.g., ORDER_1706891234_5678"
                       required>
                <div class="form-text">
                    You can find your Order ID in the confirmation email or on the payment receipt.
                </div>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-check" id="checkBtn">
                    <span id="btnText">Check Status</span>
                    <span class="loading-spinner" id="loadingSpinner">
                        <i class="fas fa-spinner fa-spin"></i> Checking...
                    </span>
                </button>
            </div>
        </form>
        
        <div class="info-box">
            <h6><i class="fas fa-info-circle"></i> Need help?</h6>
            <p class="mb-0 small">
                If you don't have your Order ID, please contact us at 
                <strong>support@anmayfoundation.org</strong> or call <strong>+91-XXXXXXXXXX</strong>
            </p>
        </div>
        
        <!-- Results will be displayed here -->
        <div class="result-card" id="resultCard">
            <div class="result-header" id="resultHeader">
                <h5 class="mb-0"><i class="fas fa-file-invoice"></i> Payment Status Result</h5>
            </div>
            <div class="result-body">
                <div id="resultContent">
                    <!-- Results will be dynamically inserted here -->
                </div>
                <div class="mt-4 text-center">
                    <a href="/donate" class="btn btn-outline-primary me-2">
                        <i class="fas fa-heart"></i> Donate Again
                    </a>
                    <a href="/" class="btn btn-outline-secondary">
                        <i class="fas fa-home"></i> Go to Home
                    </a>
                </div>
            </div>
        </div>
        
        <div class="alert alert-danger error-alert mt-3" id="errorAlert" style="display: none;">
            <i class="fas fa-exclamation-triangle"></i>
            <span id="errorMessage"></span>
        </div>
    </div>

    <script>
        document.getElementById('statusForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const orderId = document.getElementById('order_id').value.trim();
            const checkBtn = document.getElementById('checkBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const resultCard = document.getElementById('resultCard');
            const resultContent = document.getElementById('resultContent');
            const resultHeader = document.getElementById('resultHeader');
            const errorAlert = document.getElementById('errorAlert');
            
            if (!orderId) {
                showError('Please enter your Order ID');
                return;
            }
            
            // Show loading
            checkBtn.disabled = true;
            btnText.style.display = 'none';
            loadingSpinner.style.display = 'inline-block';
            errorAlert.style.display = 'none';
            resultCard.style.display = 'none';
            
            try {
                const response = await fetch('/payment/check-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ order_id: orderId })
                });
                
                const data = await response.json();
                
                // Reset button
                checkBtn.disabled = false;
                btnText.style.display = 'inline-block';
                loadingSpinner.style.display = 'none';
                
                if (data.success) {
                    displayResult(data);
                } else {
                    showError(data.message || 'Failed to check status');
                }
                
            } catch (error) {
                console.error('Error:', error);
                checkBtn.disabled = false;
                btnText.style.display = 'inline-block';
                loadingSpinner.style.display = 'none';
                showError('Network error. Please try again.');
            }
        });
        
        function displayResult(data) {
            const resultCard = document.getElementById('resultCard');
            const resultContent = document.getElementById('resultContent');
            const resultHeader = document.getElementById('resultHeader');
            
            // Determine status color
            let statusClass = 'bg-secondary';
            let statusIcon = 'fas fa-question-circle';
            
            switch(data.status) {
                case 'SUCCESS':
                case 'COMPLETED':
                case 'PAYMENT_SUCCESS':
                    statusClass = 'bg-success';
                    statusIcon = 'fas fa-check-circle';
                    break;
                case 'PENDING':
                case 'PROCESSING':
                case 'INITIATED':
                    statusClass = 'bg-warning';
                    statusIcon = 'fas fa-clock';
                    break;
                case 'FAILED':
                case 'DECLINED':
                case 'CANCELLED':
                    statusClass = 'bg-danger';
                    statusIcon = 'fas fa-times-circle';
                    break;
            }
            
            // Update header
            resultHeader.className = `result-header ${statusClass}`;
            
            // Build result HTML
            let html = `
                <div class="text-center mb-4">
                    <i class="${statusIcon} fa-4x mb-3 ${statusClass.replace('bg-', 'text-')}"></i>
                    <h4 class="fw-bold">${data.status}</h4>
                    <p class="text-muted">${data.message || 'Payment status retrieved successfully'}</p>
                </div>
                
                <div class="details">
                    <div class="detail-item">
                        <span class="detail-label">Order ID:</span>
                        <span class="detail-value">${data.order_id}</span>
                    </div>
            `;
            
            if (data.transaction_id) {
                html += `
                    <div class="detail-item">
                        <span class="detail-label">Transaction ID:</span>
                        <span class="detail-value">${data.transaction_id}</span>
                    </div>
                `;
            }
            
            html += `
                    <div class="detail-item">
                        <span class="detail-label">Checked At:</span>
                        <span class="detail-value">${new Date().toLocaleString()}</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="status-badge ${statusClass}">
                        <i class="${statusIcon}"></i> ${data.status}
                    </div>
                </div>
            `;
            
            if (data.data && data.data.message) {
                html += `
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i> ${data.data.message}
                    </div>
                `;
            }
            
            resultContent.innerHTML = html;
            resultCard.style.display = 'block';
            
            // Scroll to result
            resultCard.scrollIntoView({ behavior: 'smooth' });
        }
        
        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');
            
            errorMessage.textContent = message;
            errorAlert.style.display = 'block';
            
            // Scroll to error
            errorAlert.scrollIntoView({ behavior: 'smooth' });
            
            // Auto-hide error after 5 seconds
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 5000);
        }
        
        // Auto-focus on input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('order_id').focus();
            
            // Check if order ID is in URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const orderIdParam = urlParams.get('order_id');
            if (orderIdParam) {
                document.getElementById('order_id').value = orderIdParam;
                document.getElementById('statusForm').dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>
</html>