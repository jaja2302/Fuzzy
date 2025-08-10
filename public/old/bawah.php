		</div>
		</div>

		<!-- Modern Footer -->
		<footer class="modern-footer">
			<div class="container">
				<div class="footer-content">
					<div class="row g-4">
						<!-- About Section -->
						<div class="col-lg-4 col-md-6">
							<div class="footer-section">
								<div class="footer-logo">
									<i class="fas fa-heartbeat"></i>
									<span>FTS BKKBN</span>
								</div>
								<p class="footer-desc">
									Aplikasi prediksi stunting menggunakan Fuzzy Time Series untuk membantu BKKBN SUMUT dalam perencanaan program kesehatan yang lebih efektif.
								</p>
								<div class="footer-social">
									<a href="#" class="social-icon">
										<i class="fab fa-facebook-f"></i>
									</a>
									<a href="#" class="social-icon">
										<i class="fab fa-twitter"></i>
									</a>
									<a href="#" class="social-icon">
										<i class="fab fa-linkedin-in"></i>
									</a>
									<a href="#" class="social-icon">
										<i class="fab fa-instagram"></i>
									</a>
								</div>
							</div>
						</div>

						<!-- Quick Links -->
						<div class="col-lg-2 col-md-6">
							<div class="footer-section">
								<h4 class="footer-title">Menu Utama</h4>
								<ul class="footer-links">
									<li><a href="menu.php">Home</a></li>
									<li><a href="wilayah.php">Data Wilayah</a></li>
									<li><a href="stunting.php">Data Stunting</a></li>
									<li><a href="perkiraan_dinamis.php">Perkiraan</a></li>
								</ul>
							</div>
						</div>

						<!-- Information -->
						<div class="col-lg-3 col-md-6">
							<div class="footer-section">
								<h4 class="footer-title">Informasi</h4>
								<ul class="footer-links">
									<li><a href="#about">Tentang Stunting</a></li>
									<li><a href="#about">Fuzzy Time Series</a></li>
									<li><a href="#about">Tentang BKKBN</a></li>
									<li><a href="index.php">Logout</a></li>
								</ul>
							</div>
						</div>

						<!-- Contact Info -->
						<div class="col-lg-3 col-md-6">
							<div class="footer-section">
								<h4 class="footer-title">Kontak</h4>
								<div class="contact-info">
									<div class="contact-item">
										<i class="fas fa-envelope"></i>
										<span>email@gmail.com</span>
									</div>
									<div class="contact-item">
										<i class="fas fa-phone"></i>
										<span>+62 812-3456-7890</span>
									</div>
									<div class="contact-item">
										<i class="fas fa-map-marker-alt"></i>
										<span>BKKBN Sumatera Utara</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Footer Bottom -->
				<div class="footer-bottom">
					<div class="row align-items-center">
						<div class="col-md-6">
							<p class="copyright">
								&copy; 2025 <strong>Liza</strong> - Fuzzy Time Series Application
							</p>
						</div>
						<div class="col-md-6 text-md-end">
							<p class="developer">
								Designed & Developed by <strong>UPU</strong>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<!-- Scroll to Top Button -->
		<div id="scroll-to-top" class="scroll-to-top">
			<i class="fas fa-chevron-up"></i>
		</div>

		<!-- Additional Styles for Footer -->
		<style>
			/* Modern Footer Styles */
			.modern-footer {
				background: linear-gradient(135deg, rgba(22, 163, 74, 0.95), rgba(21, 128, 61, 0.95));
				backdrop-filter: blur(20px);
				color: white;
				margin-top: 4rem;
				position: relative;
				overflow: hidden;
			}

			.modern-footer::before {
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background:
					radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
					radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
				z-index: 1;
			}

			.footer-content {
				padding: 3rem 0 2rem;
				position: relative;
				z-index: 2;
			}

			.footer-section {
				height: 100%;
			}

			.footer-logo {
				display: flex;
				align-items: center;
				gap: 0.75rem;
				margin-bottom: 1rem;
				font-size: 1.5rem;
				font-weight: 700;
				color: white;
			}

			.footer-logo i {
				width: 40px;
				height: 40px;
				background: rgba(255, 255, 255, 0.2);
				border-radius: 10px;
				display: flex;
				align-items: center;
				justify-content: center;
				font-size: 1.2rem;
			}

			.footer-desc {
				color: rgba(255, 255, 255, 0.9);
				line-height: 1.6;
				margin-bottom: 1.5rem;
				font-size: 0.95rem;
			}

			.footer-social {
				display: flex;
				gap: 0.75rem;
			}

			.social-icon {
				width: 40px;
				height: 40px;
				background: rgba(255, 255, 255, 0.1);
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				color: white;
				text-decoration: none;
				transition: all 0.3s ease;
			}

			.social-icon:hover {
				background: white;
				color: var(--primary-color);
				transform: translateY(-3px) scale(1.1);
			}

			.footer-title {
				font-family: 'Poppins', sans-serif;
				font-size: 1.25rem;
				font-weight: 600;
				margin-bottom: 1.5rem;
				color: white;
				position: relative;
			}

			.footer-title::after {
				content: '';
				position: absolute;
				bottom: -8px;
				left: 0;
				width: 40px;
				height: 3px;
				background: linear-gradient(90deg, #fbbf24, #f59e0b);
				border-radius: 2px;
			}

			.footer-links {
				list-style: none;
				padding: 0;
				margin: 0;
			}

			.footer-links li {
				margin-bottom: 0.75rem;
			}

			.footer-links a {
				color: rgba(255, 255, 255, 0.9);
				text-decoration: none;
				transition: all 0.3s ease;
				font-size: 0.95rem;
				display: inline-flex;
				align-items: center;
				gap: 0.5rem;
			}

			.footer-links a:hover {
				color: white;
				transform: translateX(5px);
			}

			.footer-links a::before {
				content: '→';
				opacity: 0;
				transition: opacity 0.3s ease;
			}

			.footer-links a:hover::before {
				opacity: 1;
			}

			.contact-info .contact-item {
				display: flex;
				align-items: center;
				gap: 0.75rem;
				margin-bottom: 1rem;
				color: rgba(255, 255, 255, 0.9);
				font-size: 0.95rem;
			}

			.contact-info .contact-item i {
				width: 20px;
				text-align: center;
				color: #fbbf24;
			}

			.footer-bottom {
				border-top: 1px solid rgba(255, 255, 255, 0.1);
				padding: 1.5rem 0;
				position: relative;
				z-index: 2;
			}

			.copyright,
			.developer {
				margin: 0;
				color: rgba(255, 255, 255, 0.8);
				font-size: 0.9rem;
			}

			.copyright strong,
			.developer strong {
				color: white;
			}

			/* Scroll to Top Button */
			.scroll-to-top {
				position: fixed;
				bottom: 30px;
				right: 30px;
				width: 50px;
				height: 50px;
				background: var(--primary-color);
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				color: white;
				cursor: pointer;
				transition: all 0.3s ease;
				z-index: 1000;
				box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);
			}

			.scroll-to-top:hover {
				background: var(--primary-dark);
				transform: translateY(-3px) scale(1.1);
				box-shadow: 0 6px 20px rgba(22, 163, 74, 0.4);
			}

			/* Responsive Footer */
			@media (max-width: 768px) {
				.footer-content {
					padding: 2rem 0 1.5rem;
				}

				.footer-section {
					text-align: center;
					margin-bottom: 2rem;
				}

				.footer-links a {
					justify-content: center;
				}

				.footer-bottom {
					text-align: center;
				}

				.footer-bottom .col-md-6:last-child {
					margin-top: 1rem;
				}
			}

			@media (max-width: 576px) {
				.scroll-to-top {
					bottom: 20px;
					right: 20px;
					width: 45px;
					height: 45px;
				}
			}
		</style>

		<!-- Enhanced JavaScript -->
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Scroll to top functionality
				const scrollBtn = document.getElementById('scroll-to-top');

				if (scrollBtn) {
					// Show/hide scroll button
					window.addEventListener('scroll', function() {
						if (window.pageYOffset > 100) {
							scrollBtn.style.opacity = '1';
							scrollBtn.style.visibility = 'visible';
						} else {
							scrollBtn.style.opacity = '0';
							scrollBtn.style.visibility = 'hidden';
						}
					});

					// Smooth scroll to top
					scrollBtn.addEventListener('click', function() {
						window.scrollTo({
							top: 0,
							behavior: 'smooth'
						});
					});
				}

				// Add loading states to form submissions
				const forms = document.querySelectorAll('form');
				forms.forEach(form => {
					form.addEventListener('submit', function(e) {
						const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
						if (submitBtn) {
							submitBtn.disabled = true;
							submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

							// Re-enable after 3 seconds as fallback
							setTimeout(() => {
								submitBtn.disabled = false;
								submitBtn.innerHTML = submitBtn.innerHTML.replace('<i class="fas fa-spinner fa-spin"></i> Memproses...', 'Simpan');
							}, 3000);
						}
					});
				});

				// Enhanced table interactions
				const tableRows = document.querySelectorAll('tbody tr');
				tableRows.forEach(row => {
					row.addEventListener('mouseenter', function() {
						this.style.transform = 'translateX(5px)';
					});

					row.addEventListener('mouseleave', function() {
						this.style.transform = 'translateX(0)';
					});
				});

				// Notification system for success/error messages
				function showNotification(message, type = 'success') {
					const notification = document.createElement('div');
					notification.className = `notification notification-${type}`;
					notification.innerHTML = `
					<div class="notification-content">
						<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
						<span>${message}</span>
						<button class="notification-close" onclick="this.parentElement.parentElement.remove()">
							<i class="fas fa-times"></i>
						</button>
					</div>
				`;

					notification.style.cssText = `
					position: fixed;
					top: 20px;
					right: 20px;
					background: ${type === 'success' ? '#10b981' : '#ef4444'};
					color: white;
					padding: 1rem 1.5rem;
					border-radius: 12px;
					box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
					z-index: 9999;
					transform: translateX(400px);
					transition: transform 0.3s ease;
					max-width: 350px;
				`;

					const style = document.createElement('style');
					style.textContent = `
					.notification-content {
						display: flex;
						align-items: center;
						gap: 0.75rem;
					}
					.notification-close {
						background: none;
						border: none;
						color: white;
						cursor: pointer;
						padding: 0;
						margin-left: auto;
					}
				`;
					document.head.appendChild(style);

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
					}, 4000);
				}

				// Auto-show notifications for PHP messages
				<?php if (isset($_SESSION['message'])): ?>
					showNotification('<?php echo $_SESSION['message']; ?>', '<?php echo $_SESSION['message_type'] ?? 'success'; ?>');
					<?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
				<?php endif; ?>
			});
		</script>

		<!-- Include any additional scripts -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		</body>

		</html>