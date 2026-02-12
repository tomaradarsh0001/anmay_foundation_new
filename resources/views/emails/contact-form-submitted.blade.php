<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thank You for Contacting Us</title>
    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .email-wrapper {
            max-width: 650px;
            margin: 0 auto;
            width: 100%;
        }
        
        .container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            position: relative;
        }
        
        /* Decorative elements */
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            background-size: 200% 100%;
            animation: gradient 3s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Header styles */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 48px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '✉️';
            position: absolute;
            font-size: 120px;
            opacity: 0.1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
            position: relative;
            animation: slideIn 0.5s ease-out;
        }
        
        .header p {
            margin-top: 12px;
            font-size: 18px;
            opacity: 0.95;
            position: relative;
            font-weight: 300;
        }
        
        .success-icon {
            font-size: 48px;
            margin-bottom: 16px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Content styles */
        .content {
            padding: 48px 40px;
            background: white;
        }
        
        .greeting {
            font-size: 20px;
            margin-bottom: 24px;
            color: #1e293b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .greeting i {
            color: #667eea;
            font-size: 24px;
        }
        
        .greeting strong {
            color: #4f46e5;
            font-weight: 700;
        }
        
        .message-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-left: 6px solid #667eea;
            padding: 28px;
            margin: 32px 0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .message-box::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 80px;
            color: #667eea;
            opacity: 0.2;
            font-family: Georgia, serif;
        }
        
        .message-box h3 {
            margin-top: 0;
            color: #1e293b;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        
        .message-box h3 i {
            color: #667eea;
        }
        
        .message-box p {
            margin-bottom: 0;
            font-style: italic;
            color: #475569;
            font-size: 16px;
            line-height: 1.8;
            position: relative;
            z-index: 1;
        }
        
        /* Card styles */
        .summary-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 28px;
            margin: 32px 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        
        .summary-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            color: #1e293b;
            font-size: 20px;
            font-weight: 600;
        }
        
        .summary-title i {
            color: #667eea;
            font-size: 24px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 16px 24px;
        }
        
        .info-label {
            font-weight: 600;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-label i {
            width: 20px;
            color: #667eea;
        }
        
        .info-value {
            color: #1e293b;
            font-weight: 500;
        }
        
        /* Timeline styles */
        .timeline {
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f7ff 100%);
            padding: 28px;
            border-radius: 20px;
            margin: 32px 0;
            border: 1px solid #bae6fd;
        }
        
        .timeline h4 {
            color: #0369a1;
            font-size: 18px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .timeline h4 i {
            color: #0284c7;
        }
        
        .timeline-steps {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .step {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        
        .step i {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0284c7;
            color: white;
            border-radius: 50%;
            font-size: 14px;
        }
        
        .step span {
            color: #1e293b;
            font-weight: 500;
        }
        
        .step .fa-check-circle {
            background: #10b981;
            margin-left: auto;
        }
        
        /* Button styles */
        .cta-section {
            text-align: center;
            margin: 40px 0 20px;
        }
        
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
            border: none;
            cursor: pointer;
        }
        
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -5px rgba(102, 126, 234, 0.5);
        }
        
        .button i {
            font-size: 18px;
        }
        
        /* Footer styles */
        .footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 40px;
            text-align: center;
            color: #cbd5e1;
        }
        
        .footer-content {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        
        .footer-logo span {
            color: #667eea;
        }
        
        .social-links {
            margin: 24px 0;
            display: flex;
            justify-content: center;
            gap: 16px;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 50%;
            transition: all 0.3s ease;
            font-size: 18px;
        }
        
        .social-link:hover {
            background: #667eea;
            transform: translateY(-3px);
        }
        
        .footer-text {
            font-size: 14px;
            line-height: 1.8;
            color: #94a3b8;
        }
        
        .footer-text i {
            color: #ef4444;
            margin: 0 2px;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            margin: 24px 0;
        }
        
        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            body {
                padding: 20px 10px;
            }
            
            .header {
                padding: 40px 20px;
            }
            
            .header h1 {
                font-size: 26px;
            }
            
            .content {
                padding: 32px 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .info-label {
                margin-bottom: -8px;
            }
            
            .footer {
                padding: 32px 20px;
            }
        }
        
        /* Utility classes */
        .text-accent {
            color: #667eea;
        }
        
        .bg-accent-light {
            background: rgba(102, 126, 234, 0.1);
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="container">
            <!-- Header Section -->
            <div class="header">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1>Thank You for Contacting Us!</h1>
                <p>We've received your message and appreciate you reaching out</p>
            </div>
            
            <!-- Content Section -->
            <div class="content">
                <!-- Greeting -->
                <div class="greeting">
                    <i class="fas fa-hand-wave"></i>
                    Dear <strong>{{ $contact->first_name }} {{ $contact->last_name }}</strong>,
                </div>
                
                <!-- Thank You Message -->
                <p style="color: #475569; font-size: 16px; line-height: 1.8;">
                    Thank you for taking the time to contact us. Your inquiry is important to us, and we're committed to providing you with the best possible support.
                </p>
                
                <!-- Message Box -->
                <div class="message-box">
                    <h3>
                        <i class="fas fa-quote-right"></i>
                        Your Message
                    </h3>
                    <p>"{{ $contact->message }}"</p>
                </div>
                
                <!-- Summary Card -->
                <div class="summary-card">
                    <div class="summary-title">
                        <i class="fas fa-clipboard-list"></i>
                        Submission Summary
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-label">
                            <i class="fas fa-user"></i>
                            Full Name:
                        </div>
                        <div class="info-value">
                            {{ $contact->first_name }} {{ $contact->last_name }}
                        </div>
                        
                        <div class="info-label">
                            <i class="fas fa-envelope"></i>
                            Email:
                        </div>
                        <div class="info-value">
                            <a href="mailto:{{ $contact->email }}" style="color: #667eea; text-decoration: none;">
                                {{ $contact->email }}
                            </a>
                        </div>
                        
                        @if($contact->phone)
                        <div class="info-label">
                            <i class="fas fa-phone-alt"></i>
                            Phone:
                        </div>
                        <div class="info-value">
                            <a href="tel:{{ $contact->phone }}" style="color: #667eea; text-decoration: none;">
                                {{ $contact->phone }}
                            </a>
                        </div>
                        @endif
                        
                        <div class="info-label">
                            <i class="fas fa-calendar"></i>
                            Submitted:
                        </div>
                        <div class="info-value">
                            {{ $contact->created_at->format('l, F j, Y') }}
                            <span style="display: block; font-size: 14px; color: #64748b;">
                                {{ $contact->created_at->format('g:i A') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Timeline / What happens next -->
                <div class="timeline">
                    <h4>
                        <i class="fas fa-clock"></i>
                        What happens next?
                    </h4>
                    <div class="timeline-steps">
                        <div class="step">
                            <i class="fas fa-check"></i>
                            <span>We've received your message</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="step">
                            <i class="fas fa-users"></i>
                            <span>Our team is reviewing your inquiry</span>
                            <i class="fas fa-spinner fa-pulse"></i>
                        </div>
                        <div class="step">
                            <i class="fas fa-reply"></i>
                            <span>We'll respond within 24-48 hours</span>
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <p style="color: #0369a1; margin-top: 20px; margin-bottom: 0; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-info-circle"></i>
                        You'll receive a response directly to your email address.
                    </p>
                </div>
                
                <!-- CTA Button -->
                <div class="cta-section">
                    <a href="{{ url('/') }}" class="button">
                        <i class="fas fa-globe"></i>
                        Visit Our Website
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <p style="color: #64748b; font-size: 14px; margin-top: 16px;">
                        <i class="fas fa-star"></i>
                        We're here to help 24/7
                    </p>
                </div>
            </div>
            
            <!-- Footer Section -->
            <div class="footer">
                <div class="footer-content">
                    <div class="footer-logo">
                        <span>Anmay</span>Foundation
                    </div>
                    
                    <p style="color: #cbd5e1; margin-bottom: 24px; font-size: 15px;">
                        Making a difference, one step at a time.
                    </p>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="footer-text">
                        <p style="margin-bottom: 12px;">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:{{ $contact->email }}" style="color: #94a3b8; text-decoration: none;">
                                {{ $contact->email }}
                            </a>
                        </p>
                        <p style="margin-bottom: 16px;">
                            This email was sent because you submitted a contact form on our website.
                        </p>
                        <p style="color: #64748b; font-size: 13px;">
                            <i class="far fa-copyright"></i>
                            {{ date('Y') }} Anmay Foundation. All rights reserved.
                            <br>
                            <span style="display: inline-block; margin-top: 8px;">
                                Made with <i class="fas fa-heart"></i> for our community
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>