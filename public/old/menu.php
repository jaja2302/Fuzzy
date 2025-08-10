<?php
include "atas.php";
?>

<div class="container">
  <div class="content-wrapper">
    <div class="welcome-section text-center mb-5">
      <div class="welcome-icon">
        <i class="fas fa-home"></i>
      </div>
      <h1 class="page-title">Selamat Datang</h1>
      <p class="page-subtitle">Sistem Prediksi Stunting menggunakan Fuzzy Time Series</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon stat-icon-primary">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="stat-content">
            <h3 class="stat-number">
              <?php
              include "sambung.php";
              $query = mysqli_query($link, "SELECT COUNT(*) as total FROM wilayah");
              $result = mysqli_fetch_array($query);
              echo $result['total'];
              ?>
            </h3>
            <p class="stat-label">Data Wilayah</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon stat-icon-success">
            <i class="fas fa-child"></i>
          </div>
          <div class="stat-content">
            <h3 class="stat-number">
              <?php
              $query = mysqli_query($link, "SELECT COUNT(*) as total FROM stunting");
              $result = mysqli_fetch_array($query);
              echo $result['total'];
              ?>
            </h3>
            <p class="stat-label">Data Stunting</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon stat-icon-warning">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="stat-content">
            <h3 class="stat-number">
              <?php
              $query = mysqli_query($link, "SELECT COUNT(DISTINCT tahun) as total FROM stunting");
              $result = mysqli_fetch_array($query);
              echo $result['total'];
              ?>
            </h3>
            <p class="stat-label">Tahun Data</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="stat-card">
          <div class="stat-icon stat-icon-info">
            <i class="fas fa-calculator"></i>
          </div>
          <div class="stat-content">
            <h3 class="stat-number">FTS</h3>
            <p class="stat-label">Metode Prediksi</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-5">
      <div class="col-12">
        <h2 class="section-title">Menu Utama</h2>
        <p class="section-description">Pilih menu yang ingin Anda akses</p>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="wilayah.php" class="action-card">
          <div class="action-icon wilayah-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="action-content">
            <h4 class="action-title">Data Wilayah</h4>
            <p class="action-description">Kelola data wilayah penelitian</p>
            <div class="action-arrow">
              <i class="fas fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="stunting.php" class="action-card">
          <div class="action-icon stunting-icon">
            <i class="fas fa-child"></i>
          </div>
          <div class="action-content">
            <h4 class="action-title">Data Stunting</h4>
            <p class="action-description">Input dan kelola data stunting</p>
            <div class="action-arrow">
              <i class="fas fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="perkiraan_dinamis.php" class="action-card">
          <div class="action-icon prediksi-icon">
            <i class="fas fa-chart-area"></i>
          </div>
          <div class="action-content">
            <h4 class="action-title">Perkiraan FTS</h4>
            <p class="action-description">Perhitungan dinamis real-time</p>
            <div class="action-arrow">
              <i class="fas fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="index.php" class="action-card">
          <div class="action-icon logout-icon">
            <i class="fas fa-sign-out-alt"></i>
          </div>
          <div class="action-content">
            <h4 class="action-title">Keluar</h4>
            <p class="action-description">Logout dari sistem</p>
            <div class="action-arrow">
              <i class="fas fa-arrow-right"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  /* Welcome Section */
  .welcome-section {
    padding: 2rem 0;
  }

  .welcome-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 1.5rem;
    box-shadow: 0 8px 25px rgba(22, 163, 74, 0.3);
  }

  .page-subtitle {
    font-size: 1.1rem;
    color: var(--gray-600);
    margin-bottom: 0;
  }

  /* Statistics Cards */
  .stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
    transition: all 0.3s ease;
    height: 100%;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
  }

  .stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
  }

  .stat-icon-primary {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  }

  .stat-icon-success {
    background: linear-gradient(135deg, var(--success-color), #059669);
  }

  .stat-icon-warning {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
  }

  .stat-icon-info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
  }

  .stat-content {
    flex: 1;
  }

  .stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 0.25rem;
    font-family: 'Poppins', sans-serif;
  }

  .stat-label {
    color: var(--gray-600);
    margin: 0;
    font-size: 0.95rem;
  }

  /* Section Titles */
  .section-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
  }

  .section-description {
    color: var(--gray-600);
    margin-bottom: 2rem;
  }

  /* Action Cards */
  .action-card {
    display: block;
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    text-decoration: none;
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
    transition: all 0.3s ease;
    height: 100%;
  }

  .action-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    text-decoration: none;
  }

  .action-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1rem;
  }

  .wilayah-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  }

  .stunting-icon {
    background: linear-gradient(135deg, #ef4444, #dc2626);
  }

  .prediksi-icon {
    background: linear-gradient(135deg, var(--success-color), #059669);
  }

  .logout-icon {
    background: linear-gradient(135deg, var(--gray-600), var(--gray-700));
  }

  .action-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
  }

  .action-description {
    color: var(--gray-600);
    margin-bottom: 1rem;
    font-size: 0.95rem;
    line-height: 1.5;
  }

  .action-arrow {
    display: flex;
    justify-content: flex-end;
    color: var(--primary-color);
    transition: all 0.3s ease;
  }

  .action-card:hover .action-arrow {
    transform: translateX(5px);
  }
</style>







<?php
include "bawah.php";
?>