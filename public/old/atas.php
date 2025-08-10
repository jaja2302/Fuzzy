<?php
session_start();
include_once "sambung.php";

// Optional: handle logout trigger from any page that includes this header
if (isset($_GET['logout'])) {
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(
			session_name(),
			'',
			time() - 42000,
			$params['path'],
			$params['domain'],
			$params['secure'],
			$params['httponly']
		);
	}
	session_destroy();
	header('Location: index.php');
	exit;
}

// If login form just submitted (from masuk.php flow), validate and set session
if (isset($_POST['sandi'])) {
	$passwordAttempt = $_POST['sandi'];
	$res = mysqli_query($link, "SELECT sandi FROM login WHERE id_login='1'");
	if ($res) {
		$row = mysqli_fetch_assoc($res);
		if ($row && $passwordAttempt === $row['sandi']) {
			$_SESSION['is_logged_in'] = true;
		}
	}
}

// List of pages that require auth
$protectedPages = array(
	'menu.php',
	'wilayah.php',
	'wilayah_ganti.php',
	'stunting.php',
	'stunting_ganti.php',
	'hapus_tabel_perkiraan.php'
);

$currentScript = basename($_SERVER['PHP_SELF']);
if (in_array($currentScript, $protectedPages) && empty($_SESSION['is_logged_in'])) {
	header('Location: index.php');
	exit;
}
?>
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
			position: relative;
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
			padding: 2rem 0 1rem;
			color: white;
		}

		.logo-section {
			margin-bottom: 1.5rem;
		}

		.logo {
			width: 70px;
			height: 70px;
			background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(220, 252, 231, 0.8));
			border-radius: 18px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 1.8rem;
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
			font-size: clamp(1.25rem, 3vw, 2rem);
			font-weight: 600;
			margin-bottom: 0.5rem;
			text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			line-height: 1.2;
		}

		/* Navigation Styles */
		.main-menu {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(20px);
			border-radius: 0;
			box-shadow: var(--shadow-lg);
			border: 1px solid rgba(255, 255, 255, 0.2);
			margin-bottom: 0;
			position: relative;
			z-index: 999;
		}

		.navbar-nav {
			display: flex;
			justify-content: center;
			width: 100%;
			gap: 1rem;
		}

		.navbar-nav li {
			list-style: none;
		}

		.navbar-nav a {
			color: var(--gray-700);
			text-decoration: none;
			padding: 1rem 1.5rem;
			font-weight: 500;
			border-radius: 10px;
			transition: all 0.3s ease;
			position: relative;
			display: block;
		}

		.navbar-nav a:hover {
			background: var(--primary-color);
			color: white;
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);
		}

		.navbar-nav a.active {
			background: var(--primary-color);
			color: white;
		}

		/* Content Area Styles */
		.content-wrapper {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(20px);
			border-radius: 24px;
			padding: 2rem;
			margin: 2rem auto;
			max-width: 1200px;
			box-shadow: var(--shadow-xl);
			border: 1px solid rgba(255, 255, 255, 0.2);
		}

		.page-title {
			font-family: 'Poppins', sans-serif;
			font-size: 2rem;
			font-weight: 600;
			color: var(--gray-800);
			margin-bottom: 2rem;
			text-align: center;
		}

		.highlight.primary {
			color: var(--primary-color);
			background: linear-gradient(135deg, var(--health-light), rgba(22, 163, 74, 0.1));
			padding: 0.2rem 0.5rem;
			border-radius: 6px;
			font-weight: 600;
		}

		/* Modern Table Styles */
		.table-container {
			background: white;
			border-radius: 16px;
			overflow: hidden;
			box-shadow: var(--shadow);
			border: 1px solid var(--gray-200);
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 0.95rem;
		}

		thead {
			background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
			color: white;
		}

		th {
			padding: 1rem;
			text-align: left;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			font-size: 0.875rem;
		}

		tbody tr {
			border-bottom: 1px solid var(--gray-200);
			transition: all 0.3s ease;
		}

		tbody tr:hover {
			background: var(--health-light);
			transform: scale(1.01);
		}

		td {
			padding: 1rem;
			vertical-align: middle;
		}

		/* Modern Form Styles */
		.form-control,
		input[type="text"],
		input[type="number"],
		input[type="hidden"] {
			border: 2px solid var(--gray-200);
			border-radius: 10px;
			padding: 0.75rem 1rem;
			font-size: 1rem;
			transition: all 0.3s ease;
			background: white;
			width: 100%;
		}

		.form-control:focus,
		input[type="text"]:focus,
		input[type="number"]:focus {
			outline: none;
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
			transform: translateY(-1px);
		}

		.form-select,
		select {
			border: 2px solid var(--gray-200);
			border-radius: 10px;
			padding: 0.75rem 1rem;
			font-size: 1rem;
			transition: all 0.3s ease;
			background: white;
			width: 100%;
		}

		.form-select:focus,
		select:focus {
			outline: none;
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
		}

		/* Modern Button Styles */
		.btn {
			padding: 0.75rem 1.5rem;
			border-radius: 10px;
			font-weight: 500;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			font-size: 0.95rem;
		}

		.btn-simpan,
		button[name="simpan"] {
			background: var(--success-color);
			color: white;
		}

		.btn-simpan:hover,
		button[name="simpan"]:hover {
			background: #059669;
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
		}

		.btn-ganti {
			background: var(--warning-color);
			color: white;
		}

		.btn-ganti:hover {
			background: #d97706;
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
		}

		.btn-hapus {
			background: var(--danger-color);
			color: white;
		}

		.btn-hapus:hover {
			background: #dc2626;
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
		}

		/* Pagination Styles */
		.pagination-container {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-top: 1rem;
			padding: 1rem;
			background: white;
			border-radius: 0 0 16px 16px;
			border: 1px solid var(--gray-200);
			border-top: none;
		}

		.pagination-info {
			color: var(--gray-600);
			font-size: 0.9rem;
		}

		.pagination {
			display: flex;
			gap: 0.5rem;
			list-style: none;
			margin: 0;
			padding: 0;
		}

		.pagination li {
			margin: 0;
		}

		.pagination a,
		.pagination span {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			height: 40px;
			border: 1px solid var(--gray-300);
			border-radius: 8px;
			text-decoration: none;
			color: var(--gray-700);
			font-weight: 500;
			transition: all 0.3s ease;
		}

		.pagination a:hover {
			background: var(--primary-color);
			color: white;
			border-color: var(--primary-color);
			transform: translateY(-1px);
		}

		.pagination .current {
			background: var(--primary-color);
			color: white;
			border-color: var(--primary-color);
		}

		.pagination .disabled {
			color: var(--gray-400);
			cursor: not-allowed;
		}

		.pagination .disabled:hover {
			background: transparent;
			color: var(--gray-400);
			transform: none;
		}

		/* Records per page */
		.records-per-page {
			display: flex;
			align-items: center;
			gap: 0.5rem;
			color: var(--gray-600);
			font-size: 0.9rem;
		}

		.records-per-page select {
			border: 1px solid var(--gray-300);
			border-radius: 6px;
			padding: 0.25rem 0.5rem;
			font-size: 0.9rem;
			background: white;
		}

		/* Text Color Utilities */
		.text-success {
			color: var(--success-color) !important;
		}

		.text-danger {
			color: var(--danger-color) !important;
		}

		.text-warning {
			color: var(--warning-color) !important;
		}

		.text-primary {
			color: var(--primary-color) !important;
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.contact-info {
				justify-content: center;
			}

			.main-header {
				padding: 1rem 0;
			}

			.content-wrapper {
				margin: 1rem;
				padding: 1.5rem;
			}

			.navbar-nav {
				flex-direction: column;
				gap: 0.5rem;
			}

			.table-container {
				overflow-x: auto;
			}

			.pagination-container {
				flex-direction: column;
				gap: 1rem;
				text-align: center;
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

			.main-title {
				font-size: 1.5rem;
			}

			.pagination {
				justify-content: center;
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
	<section class="main-header">
		<div class="container">
			<div class="logo-section">
				<div class="logo">
					<img src="images/logo.png" alt="Logo" class="logo-image">
				</div>
			</div>
			<h1 class="main-title">
				Penerapan Metode Fuzzy Time Series (FTS) Pada Perkiraan Kenaikan Stunting di BKKBN SUMUT
			</h1>
		</div>
	</section>

	<!-- Navigation Menu -->
	<header class="main-menu">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar-collapse">
						<ul class="navbar-nav">
							<?php if (!empty($_SESSION['is_logged_in'])): ?>
								<li><a href="menu.php">HOME</a></li>
								<li><a href="wilayah.php">WILAYAH</a></li>
								<li><a href="stunting.php">STUNTING</a></li>
							<?php endif; ?>
							<li><a href="perkiraan_dinamis.php">PERKIRAAN</a></li>
							<li><a href="?logout=1">EXIT</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>

	<!-- Content Start -->
	<div class="container">
		<div class="content-wrapper">

			<!-- JavaScript -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
			<script>
				// Add active class to current page
				document.addEventListener('DOMContentLoaded', function() {
					const currentPath = window.location.pathname;
					const menuItems = document.querySelectorAll('.navbar-nav a');

					menuItems.forEach(item => {
						if (item.getAttribute('href') && currentPath.includes(item.getAttribute('href'))) {
							item.classList.add('active');
						}
					});
				});
			</script>