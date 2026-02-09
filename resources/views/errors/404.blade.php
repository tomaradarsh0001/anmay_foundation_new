<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ea7100ea 0%, #fe9544bd 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: white;
            position: relative;
        }

        .container {
            max-width: 800px;
            width: 90%;
            text-align: center;
            padding: 40px;
            z-index: 10;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 1s ease-out;
        }

        .error-code {
            font-size: 12rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 10px;
            background: linear-gradient(to right, #ffffff, #e4e4e4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            animation: float 3s ease-in-out infinite;
        }

        .error-code::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .error-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 40px;
            line-height: 1.6;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .home-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(255, 126, 95, 0.3);
            text-decoration: none;
            overflow: hidden;
            position: relative;
            margin-top: 20px;
            animation: pulse 2s infinite;
        }

        .home-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(255, 126, 95, 0.4);
            animation: none;
        }

        .home-btn:active {
            transform: translateY(0);
        }

        .home-btn i {
            margin-right: 10px;
            font-size: 1.4rem;
        }

        .home-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .home-btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatAround 20s infinite linear;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-duration: 25s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 80%;
            animation-duration: 30s;
            animation-direction: reverse;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 85%;
            animation-duration: 20s;
        }

        .floating-element:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 15%;
            animation-duration: 35s;
            animation-direction: reverse;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .search-box {
            display: flex;
            width: 100%;
            max-width: 500px;
        }

        .search-input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 50px 0 0 50px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
        }

        .search-btn {
            background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            color: white;
            border: none;
            padding: 0 25px;
            border-radius: 0 50px 50px 0;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: linear-gradient(to right, #00f2fe 0%, #4facfe 100%);
        }

        .links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 15px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.1);
        }

        .link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 10px 20px rgba(255, 126, 95, 0.3);
            }
            50% {
                box-shadow: 0 10px 25px rgba(255, 126, 95, 0.5);
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(50, 50);
                opacity: 0;
            }
        }

        @keyframes floatAround {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(20px, 50px) rotate(90deg);
            }
            50% {
                transform: translate(40px, 0) rotate(180deg);
            }
            75% {
                transform: translate(20px, -50px) rotate(270deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }
            
            .error-code {
                font-size: 8rem;
            }
            
            .error-title {
                font-size: 2rem;
            }
            
            .error-message {
                font-size: 1rem;
                padding: 0 10px;
            }
            
            .home-btn {
                padding: 15px 30px;
                font-size: 1.1rem;
            }
            
            .search-box {
                flex-direction: column;
                gap: 10px;
            }
            
            .search-input {
                border-radius: 50px;
            }
            
            .search-btn {
                border-radius: 50px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    
    <div class="container">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Page Not Found</h2>
        <p class="error-message">
            Oops! The page you are looking for seems to have wandered off into the digital void. 
            It might have been moved, deleted, or perhaps it never existed in the first place.
        </p>
        
      
        
        <a href="/" class="home-btn">
            <i class="fas fa-home"></i> Go Back to Homepage
        </a>
        
        <div class="links">
            <a href="/about" class="link">About Us</a>
            <a href="/contact" class="link">Contact</a>
            <a href="/causes" class="link">Causes</a>
            <a href="/volunteer" class="link">Volunteer</a>
        </div>
    </div>

    <script>
        // Add animation to the search button
        document.querySelector('.search-btn').addEventListener('click', function() {
            const searchInput = document.querySelector('.search-input');
            if(searchInput.value.trim() !== '') {
                // In a real implementation, this would trigger a search
                alert(`Searching for: "${searchInput.value}"`);
            } else {
                searchInput.focus();
            }
        });
        
        // Add enter key support for search
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                document.querySelector('.search-btn').click();
            }
        });
        
        // Add ripple effect to the home button
        document.querySelector('.home-btn').addEventListener('click', function(e) {
            // Create ripple element
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');
            
            // Style the ripple
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.7);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                top: ${y}px;
                left: ${x}px;
                pointer-events: none;
            `;
            
            // Add to button
            this.appendChild(ripple);
            
            // Remove ripple after animation
            setTimeout(() => {
                ripple.remove();
            }, 600);
            
            // In a real implementation, this would navigate to homepage
            // For demo purposes, we'll show an alert
            e.preventDefault();
            alert('Navigating to homepage...');
        });
        
        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Add floating animation to links
        const links = document.querySelectorAll('.link');
        links.forEach((link, index) => {
            link.style.animationDelay = `${index * 0.1}s`;
            link.style.animation = `fadeIn 0.8s ${index * 0.1}s both`;
        });
    </script>
</body>
</html>