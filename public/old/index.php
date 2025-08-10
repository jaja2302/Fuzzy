<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>FTS - Fuzzy Time Series</title>
	<meta name="description" content="Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT">
	<meta name="author" content="Liza">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome 6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Custom Styles -->
	<style>
		:root {
			--primary-color: #16a34a;
			--primary-dark: #15803d;
			--secondary-color: #059669;
			--accent-color: #fbbf24;
			--success-color: #10b981;
			--warning-color: #f59e0b;
			--danger-color: #ef4444;
			--dark-color: #1f2937;
			--light-color: #f8fafc;
			--gray-100: #f1f5f9;
			--gray-200: #e2e8f0;
			--gray-300: #cbd5e1;
			--gray-600: #475569;
			--gray-700: #334155;
			--gray-800: #1e293b;
			--health-light: #dcfce7;
			--health-medium: #4ade80;
			--health-dark: #166534;
			--shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
			--shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
			--shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
			--shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		html {
			scroll-behavior: smooth;
		}

		body {
			font-family: 'Inter', sans-serif;
			line-height: 1.6;
			color: var(--gray-700);
			background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 20%, #86efac 40%, #4ade80 60%, #22c55e 80%, #16a34a 100%);
			min-height: 100vh;
			overflow-x: hidden;
			-webkit-overflow-scrolling: touch;
			position: relative;
		}

		/* Health-themed Static Background */
		body::before {
			content: '';
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: -2;
			background:
				radial-gradient(circle at 20% 80%, rgba(34, 197, 94, 0.1) 0%, transparent 50%),
				radial-gradient(circle at 80% 20%, rgba(16, 163, 74, 0.15) 0%, transparent 50%),
				radial-gradient(circle at 40% 40%, rgba(74, 222, 128, 0.1) 0%, transparent 50%),
				radial-gradient(circle at 60% 80%, rgba(187, 247, 208, 0.2) 0%, transparent 50%);
		}

		/* Health pattern overlay for texture */
		body::after {
			content: '';
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: -1;
			opacity: 0.03;
			background-image:
				url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(22,163,74,0.4)"/><circle cx="50" cy="30" r="1.5" fill="rgba(34,197,94,0.3)"/><circle cx="80" cy="40" r="1" fill="rgba(74,222,128,0.5)"/><circle cx="30" cy="60" r="1.5" fill="rgba(16,163,74,0.3)"/><circle cx="70" cy="70" r="2" fill="rgba(22,163,74,0.4)"/><circle cx="40" cy="80" r="1" fill="rgba(34,197,94,0.3)"/></svg>');
			background-size: 100px 100px;
		}

		/* Header Styles */
		.top-header {
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(10px);
			border-bottom: 1px solid rgba(255, 255, 255, 0.2);
			padding: 12px 0;
			position: sticky;
			top: 0;
			z-index: 1000;
		}

		.contact-info {
			display: flex;
			align-items: center;
			gap: 2rem;
			flex-wrap: wrap;
		}

		.contact-item {
			display: flex;
			align-items: center;
			gap: 0.5rem;
			color: white;
			text-decoration: none;
			font-size: 0.875rem;
			transition: all 0.3s ease;
		}

		.contact-item:hover {
			color: var(--accent-color);
			transform: translateY(-1px);
		}

		.contact-icon {
			width: 32px;
			height: 32px;
			background: rgba(255, 255, 255, 0.2);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 0.875rem;
		}

		.social-links {
			display: flex;
			gap: 0.75rem;
		}

		.social-link {
			width: 36px;
			height: 36px;
			background: rgba(255, 255, 255, 0.2);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			text-decoration: none;
			transition: all 0.3s ease;
		}

		.social-link:hover {
			background: white;
			color: var(--primary-color);
			transform: translateY(-2px) scale(1.1);
		}

		/* Main Header */
		.main-header {
			text-align: center;
			padding: 4rem 0 2rem;
			color: white;
		}

		.logo-section {
			margin-bottom: 2rem;
		}

		.logo {
			width: 80px;
			height: 80px;
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(220, 252, 231, 0.8));
			border-radius: 20px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 2rem;
			margin-bottom: 1rem;
			backdrop-filter: blur(10px);
			border: 2px solid rgba(22, 163, 74, 0.3);
			color: var(--primary-color);
			box-shadow: 0 8px 25px rgba(22, 163, 74, 0.2);
		}

		/* Ensure the logo image fits nicely */
		.logo img,
		.logo-image {
			width: 100%;
			height: 100%;
			object-fit: contain;
			display: block;
			border-radius: inherit;
		}

		.main-title {
			font-family: 'Poppins', sans-serif;
			font-size: clamp(1.5rem, 4vw, 2.5rem);
			font-weight: 600;
			margin-bottom: 1rem;
			text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			line-height: 1.2;
		}

		.subtitle {
			font-size: 1.1rem;
			opacity: 0.9;
			max-width: 600px;
			margin: 0 auto;
		}

		/* Login Section */
		.login-section {
			padding: 2rem 0 4rem;
		}

		.login-card {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(20px);
			border-radius: 24px;
			padding: 3rem;
			box-shadow: var(--shadow-xl);
			border: 1px solid rgba(255, 255, 255, 0.2);
			max-width: 450px;
			margin: 0 auto;
			transform: translate3d(0, 0, 0);
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			will-change: transform;
		}

		.login-card:hover {
			transform: translate3d(0, -5px, 0);
			box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
		}

		.login-header {
			text-align: center;
			margin-bottom: 2rem;
		}

		.login-title {
			font-family: 'Poppins', sans-serif;
			font-size: 1.75rem;
			font-weight: 600;
			color: var(--gray-800);
			margin-bottom: 0.5rem;
		}

		.login-subtitle {
			color: var(--gray-600);
			font-size: 0.95rem;
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		.form-label {
			display: block;
			font-weight: 500;
			color: var(--gray-700);
			margin-bottom: 0.5rem;
			font-size: 0.95rem;
		}

		.form-input {
			width: 100%;
			padding: 0.875rem 1rem;
			border: 2px solid var(--gray-200);
			border-radius: 12px;
			font-size: 1rem;
			transition: all 0.3s ease;
			background: white;
		}

		.form-input:focus {
			outline: none;
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
			transform: translate3d(0, -1px, 0);
		}

		.input-icon {
			position: relative;
		}

		.input-icon i {
			position: absolute;
			left: 1rem;
			top: 50%;
			transform: translateY(-50%);
			color: var(--gray-600);
			z-index: 2;
		}

		.input-icon .form-input {
			padding-left: 3rem;
		}

		.btn-login {
			width: 100%;
			padding: 0.875rem 1.5rem;
			background: var(--primary-color);
			color: white;
			border: none;
			border-radius: 12px;
			font-size: 1rem;
			font-weight: 500;
			cursor: pointer;
			transition: all 0.3s ease;
			position: relative;
			overflow: hidden;
		}

		.btn-login:hover {
			background: var(--primary-dark);
			transform: translate3d(0, -2px, 0);
			box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
		}

		.btn-login:active {
			transform: translate3d(0, 0, 0);
		}

		.login-footer {
			text-align: center;
			margin-top: 2rem;
			padding-top: 1.5rem;
			border-top: 1px solid var(--gray-200);
		}

		.perkiraan-link {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			color: var(--primary-color);
			text-decoration: none;
			font-weight: 500;
			transition: all 0.3s ease;
		}

		.perkiraan-link:hover {
			color: var(--primary-dark);
			transform: translateX(3px);
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.contact-info {
				justify-content: center;
			}

			.login-card {
				margin: 1rem;
				padding: 2rem;
			}

			.main-header {
				padding: 2rem 0 1rem;
			}
		}

		@media (max-width: 576px) {
			.contact-info {
				flex-direction: column;
				gap: 1rem;
			}

			.social-links {
				justify-content: center;
			}
		}

		/* Animation Classes */
		.fade-in {
			animation: fadeIn 0.8s ease-out;
		}

		.slide-up {
			animation: slideUp 0.8s ease-out;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}

		@keyframes slideUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* Loading Animation */
		.loading-spinner {
			display: none;
			width: 20px;
			height: 20px;
			border: 2px solid rgba(255, 255, 255, 0.3);
			border-radius: 50%;
			border-top-color: white;
			animation: spin 1s ease-in-out infinite;
		}

		@keyframes spin {
			to {
				transform: rotate(360deg);
			}
		}
	</style>
</head>

<body>
	<!-- Top Header -->
	<header class="top-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<div class="contact-info">
						<a href="#" class="contact-item">
							<div class="contact-icon">
								<i class="fas fa-chart-line"></i>
							</div>
							<span>Fuzzy Time Series</span>
						</a>
						<a href="mailto:email@gmail.com" class="contact-item">
							<div class="contact-icon">
								<i class="fas fa-envelope"></i>
							</div>
							<span>email@gmail.com</span>
						</a>
						<a href="tel:+6281234567890" class="contact-item">
							<div class="contact-icon">
								<i class="fas fa-phone"></i>
							</div>
							<span>+62 812-3456-7890</span>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="social-links d-flex justify-content-md-end justify-content-center">
						<a href="#" class="social-link">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-link">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-link">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Main Header -->
	<section class="main-header fade-in">
		<div class="container">
			<div class="logo-section">
				<div class="logo">
					<img src="images/logo.png" alt="Logo" class="logo-image">
				</div>
			</div>
			<h1 class="main-title">
				Penerapan Metode Fuzzy Time Series (FTS)
			</h1>
			<p class="subtitle">
				Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT
			</p>
		</div>
	</section>

	<!-- Login Section -->
	<section class="login-section">
		<div class="container">
			<div class="login-card slide-up">
				<div class="login-header">
					<h2 class="login-title">Selamat Datang</h2>
					<p class="login-subtitle">Silakan masuk untuk mengakses sistem</p>
				</div>

				<form action="masuk.php" method="POST" id="loginForm">
					<div class="form-group">
						<label for="username" class="form-label">
							<i class="fas fa-user me-2"></i>Username
						</label>
						<div class="input-icon">
							<i class="fas fa-user"></i>
							<input type="text"
								name="admin"
								id="username"
								class="form-input"
								placeholder="Masukkan username Anda"
								required>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="form-label">
							<i class="fas fa-lock me-2"></i>Password
						</label>
						<div class="input-icon">
							<i class="fas fa-lock"></i>
							<input type="password"
								name="sandi"
								id="password"
								class="form-input"
								placeholder="Masukkan password Anda"
								required>
						</div>
					</div>

					<button type="submit" class="btn-login">
						<span class="btn-text">Masuk ke Sistem</span>
						<div class="loading-spinner"></div>
					</button>

					<div class="login-footer">
						<a href="perkiraan_dinamis.php" class="perkiraan-link">
							<i class="fas fa-chart-area"></i>
							<span>Lihat Perkiraan Data</span>
							<i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</section>

	<!-- JavaScript for Enhanced Functionality -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<script>
		// Modern JavaScript for enhanced interactivity
		document.addEventListener('DOMContentLoaded', function() {
			// Enhanced login form functionality
			const loginForm = document.getElementById('loginForm');
			const loginButton = loginForm.querySelector('.btn-login');
			const buttonText = loginButton.querySelector('.btn-text');
			const loadingSpinner = loginButton.querySelector('.loading-spinner');

			// Form validation and enhanced UX
			loginForm.addEventListener('submit', function(e) {
				const username = document.getElementById('username').value.trim();
				const password = document.getElementById('password').value.trim();

				if (!username || !password) {
					e.preventDefault();
					showNotification('Mohon lengkapi username dan password', 'error');
					return;
				}

				// Show loading state
				buttonText.textContent = 'Memproses...';
				loadingSpinner.style.display = 'inline-block';
				loginButton.disabled = true;
			});

			// Input field enhancements
			const inputs = document.querySelectorAll('.form-input');
			inputs.forEach(input => {
				input.addEventListener('focus', function() {
					this.parentElement.classList.add('focused');
				});

				input.addEventListener('blur', function() {
					if (!this.value) {
						this.parentElement.classList.remove('focused');
					}
				});

				input.addEventListener('input', function() {
					if (this.value.trim()) {
						this.classList.add('valid');
						this.classList.remove('invalid');
					} else {
						this.classList.remove('valid');
						this.classList.add('invalid');
					}
				});
			});

			// Removed heavy background animation for better performance

			// Intersection Observer for animations
			const observerOptions = {
				threshold: 0.1,
				rootMargin: '0px 0px -50px 0px'
			};

			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('animated');
					}
				});
			}, observerOptions);

			// Observe animated elements
			document.querySelectorAll('.login-card, .main-header, .contact-item').forEach(el => {
				observer.observe(el);
			});

			// Keyboard shortcuts
			document.addEventListener('keydown', function(e) {
				if (e.altKey && e.key === 'l') {
					e.preventDefault();
					document.getElementById('username').focus();
				}

				if (e.key === 'Escape') {
					inputs.forEach(input => input.value = '');
					inputs[0].focus();
				}
			});
		});

		// Notification system
		function showNotification(message, type = 'info') {
			const notification = document.createElement('div');
			notification.className = `notification notification-${type}`;
			notification.innerHTML = `
				<div class="notification-content">
					<i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
					<span>${message}</span>
              </div>
			`;

			notification.style.cssText = `
				position: fixed;
				top: 20px;
				right: 20px;
				background: ${type === 'error' ? '#ef4444' : '#10b981'};
				color: white;
				padding: 1rem 1.5rem;
				border-radius: 12px;
				box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
				z-index: 9999;
				transform: translateX(400px);
				transition: transform 0.3s ease;
			`;

			document.body.appendChild(notification);

			setTimeout(() => {
				notification.style.transform = 'translateX(0)';
			}, 100);

			setTimeout(() => {
				notification.style.transform = 'translateX(400px)';
				setTimeout(() => {
					if (notification.parentNode) {
						notification.parentNode.removeChild(notification);
					}
				}, 300);
			}, 3000);
		}

		// Enhanced CSS for form states
		const additionalCSS = `
			/* Performance Optimizations */
			* {
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
			}

			/* Optimized form states */
			.form-input.valid {
				border-color: var(--success-color);
				box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
			}

			.form-input.invalid {
				border-color: var(--danger-color);
				box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
			}

			.input-icon.focused i {
				color: var(--primary-color);
			}

			/* Optimized animations */
			.animated {
				animation: slideUpFadeIn 0.4s ease-out forwards;
				will-change: transform, opacity;
			}

			@keyframes slideUpFadeIn {
				from {
					opacity: 0;
					transform: translate3d(0, 20px, 0);
				}
				to {
					opacity: 1;
					transform: translate3d(0, 0, 0);
				}
			}

			.notification-content {
				display: flex;
				align-items: center;
				gap: 0.75rem;
			}

			/* Optimized hover effects */
			.social-link {
				position: relative;
				overflow: hidden;
				will-change: transform;
			}

			.social-link::before {
				content: '';
				position: absolute;
				top: 0;
				left: -100%;
				width: 100%;
				height: 100%;
				background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
				transition: left 0.3s ease;
			}

			.social-link:hover::before {
				left: 100%;
			}

			.btn-login:disabled {
				opacity: 0.7;
				cursor: not-allowed;
			}

			.btn-login:disabled:hover {
				transform: none;
				box-shadow: none;
			}

			/* Scroll performance improvements */
			.top-header {
				transform: translate3d(0, 0, 0);
			}

			/* Reduce motion for users who prefer it */
			@media (prefers-reduced-motion: reduce) {
				*,
				*::before,
				*::after {
					animation-duration: 0.01ms !important;
					animation-iteration-count: 1 !important;
					transition-duration: 0.01ms !important;
				}
				
				/* No background animation needed */
			}
		`;

		const styleSheet = document.createElement('style');
		styleSheet.textContent = additionalCSS;
		document.head.appendChild(styleSheet);
	</script>
</body>

</html>
<?php
include "bawah.php";
?>