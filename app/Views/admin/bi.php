<?php

/** @var CodeIgniter\View\View $this */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin AKITA</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
    .chart-container {
  position: relative;
  height: 400px;
  margin: 20px 0;
}

.chart-filters {
  display: flex;
  gap: 15px;
  margin-bottom: 20px;
  flex-wrap: wrap;
}

.chart-filters select {
  padding: 8px 12px;
  border: 2px solid #e0e0e0;
  border-radius: 8px;
  background: white;
  font-size: 14px;
  cursor: pointer;
}

.chart-filters select:focus {
  outline: none;
  border-color: #667eea;
}

@media (max-width: 768px) {
  .chart-container {
    height: 300px;
  }
  
  .chart-filters {
    justify-content: center;
  }
}
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
    }

    .sidebar {
      width: 250px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-right: 1px solid rgba(255, 255, 255, 0.2);
      padding: 20px;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 1000;
      transition: transform 0.3s ease;
    }

    .sidebar h2 {
      color: #fff;
      font-size: 24px;
      margin-bottom: 30px;
      text-align: center;
      font-weight: 600;
    }

    .sidebar a {
      display: block;
      color: #fff;
      text-decoration: none;
      margin-bottom: 15px;
      padding: 12px 16px;
      border-radius: 12px;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar a:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateX(5px);
    }

    .sidebar a.active {
      background: rgba(255, 255, 255, 0.3);
      border-color: rgba(255, 255, 255, 0.4);
    }

    .main-content {
      flex: 1;
      margin-left: 250px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(5px);
      min-height: 100vh;
    }

    .header {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 20px;
      margin-bottom: 30px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header h1 {
      color: #fff;
      font-size: 28px;
      margin-bottom: 10px;
    }

    .header p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 16px;
    }

    .content-section {
      display: none;
    }

    .content-section.active {
      display: block;
    }

    .card {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card h2 {
      color: #333;
      margin-bottom: 20px;
      font-size: 24px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 12px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #667eea;
    }

    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-right: 10px;
    }

    .btn-primary {
      background: #667eea;
      color: #fff;
    }

    .btn-primary:hover {
      background: #5a6fd8;
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: #6c757d;
      color: #fff;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .btn-danger {
      background: #dc3545;
      color: #fff;
    }

    .btn-danger:hover {
      background: #c82333;
    }

    .btn-warning {
      background: #ffc107;
      color: #212529;
    }

    .btn-warning:hover {
      background: #e0a800;
    }

    .table-container {
      overflow-x: auto;
      border-radius: 10px;
      background: #fff;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    th {
      background: #667eea;
      color: #fff;
      padding: 15px;
      text-align: left;
      font-weight: 600;
    }

    td {
      padding: 12px 15px;
      border-bottom: 1px solid #e0e0e0;
    }

    tr:hover {
      background: #f8f9ff;
    }

    .filter-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .tab {
      padding: 10px 20px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.1);
      color: #000;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .tab:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .tab.active {
      background: rgba(255, 255, 255, 0.3);
      border-color: rgba(0, 0, 0, 0.5);
    }

    .hidden {
      display: none;
    }

    .form-row {
      display: flex;
      gap: 15px;
      margin-bottom: 15px;
    }

    .form-row .form-group {
      flex: 1;
      margin-bottom: 0;
    }

    .edit-form {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 20px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stat-card h3 {
      color: #fff;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .stat-card p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 14px;
    }

    /* Toast Notifications */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 10000;
    }

    .toast {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 16px 20px;
      margin-bottom: 10px;
      border-left: 4px solid #28a745;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      transform: translateX(400px);
      opacity: 0;
      transition: all 0.3s ease;
      min-width: 300px;
    }

    .toast.show {
      transform: translateX(0);
      opacity: 1;
    }

    .toast.error {
      border-left-color: #dc3545;
    }

    .toast.warning {
      border-left-color: #ffc107;
    }

    .toast-content {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .toast-icon {
      font-size: 20px;
    }

    .toast-message {
      color: #333;
      font-weight: 500;
      flex: 1;
    }

    .toast-close {
      background: none;
      border: none;
      font-size: 18px;
      cursor: pointer;
      color: #666;
      opacity: 0.7;
    }

    .toast-close:hover {
      opacity: 1;
    }

    /* Loading States */
    .btn.loading {
      position: relative;
      pointer-events: none;
      opacity: 0.7;
    }

    .btn.loading::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 50%;
      width: 16px;
      height: 16px;
      margin: -8px 0 0 -8px;
      border: 2px solid transparent;
      border-top: 2px solid currentColor;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .table-loading {
      position: relative;
      pointer-events: none;
      opacity: 0.6;
    }

    .table-loading::after {
      content: 'Memuat data...';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 8px;
      font-weight: 500;
      color: #666;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Search Functionality */
    .search-container {
      margin-bottom: 20px;
      position: relative;
    }

    .search-box {
      width: 100%;
      max-width: 400px;
      padding: 12px 16px 12px 45px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      color: #000;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .search-box:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.5);
      background: rgba(255, 255, 255, 0.2);
    }

    .search-box::placeholder {
      color: rgba(0, 0, 0, 0.6);
    }

    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(0, 0, 0, 0.6);
      font-size: 16px;
    }

    .search-clear {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: rgba(0, 0, 0, 0.6);
      cursor: pointer;
      font-size: 18px;
      display: none;
    }

    .search-clear:hover {
      color: rgba(0, 0, 0, 0.8);
    }

    .highlight {
      background-color: #ffeb3b;
      padding: 2px 4px;
      border-radius: 3px;
      font-weight: 600;
    }

    .no-results {
      text-align: center;
      padding: 40px 20px;
      color: #666;
      font-style: italic;
    }

    .no-results-icon {
      font-size: 48px;
      margin-bottom: 10px;
      opacity: 0.5;
    }

    .search-stats {
      margin-top: 10px;
      font-size: 12px;
      color: rgba(0, 0, 0, 0.6);
    }

    /* Hamburger Menu Button */
    .hamburger-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1001;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      width: 45px;
      height: 45px;
      display: none;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .hamburger-btn:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .hamburger-btn span {
      width: 20px;
      height: 2px;
      background: #fff;
      margin: 2px 0;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .hamburger-btn.active span:nth-child(1) {
      transform: rotate(45deg) translate(4px, 4px);
    }

    .hamburger-btn.active span:nth-child(2) {
      opacity: 0;
    }

    .hamburger-btn.active span:nth-child(3) {
      transform: rotate(-45deg) translate(4px, -4px);
    }

    /* Sidebar Overlay */
    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
      z-index: 999;
      display: none;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .sidebar-overlay.active {
      display: block;
      opacity: 1;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .hamburger-btn {
        display: flex;
      }

      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0;
        padding: 80px 20px 20px;
      }

      .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
      }

      .form-row {
        flex-direction: column;
        gap: 0;
      }
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 80px 15px 15px;
      }

      .header h1 {
        font-size: 24px;
      }

      .card {
        padding: 20px;
      }

      .table-container {
        overflow-x: auto;
      }

      .filter-tabs {
        flex-wrap: wrap;
        gap: 8px;
      }

      .tab {
        padding: 8px 16px;
        font-size: 14px;
      }

      .search-box {
        max-width: 100%;
      }

      .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
      }

      .stat-card {
        padding: 15px;
      }

      .stat-card h3 {
        font-size: 20px;
      }

      th,
      td {
        padding: 8px;
        font-size: 12px;
      }

      .btn {
        padding: 8px 12px;
        font-size: 12px;
        margin: 2px;
      }
    }

    @media (max-width: 480px) {
      .main-content {
        padding: 80px 10px 10px;
      }

      .header {
        padding: 15px;
      }

      .card {
        padding: 15px;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .filter-tabs {
        justify-content: center;
      }

      .search-box {
        padding: 10px 12px 10px 35px;
      }

      .table-container {
        border-radius: 8px;
      }

      th,
      td {
        padding: 6px;
        font-size: 11px;
      }

      .btn {
        padding: 6px 10px;
        font-size: 11px;
      }

      .form-group input,
      .form-group textarea {
        padding: 10px;
        font-size: 14px;
      }

      .toast {
        min-width: 280px;
        margin: 0 10px;
      }
    }
    .kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 20px;
}

.kpi-card {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 20px;
  border-radius: 12px;
  text-align: center;
  color: white;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.kpi-value {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 8px;
}

.kpi-label {
  font-size: 14px;
  opacity: 0.9;
  margin-bottom: 8px;
}

.kpi-trend {
  font-size: 12px;
  background: rgba(255,255,255,0.2);
  padding: 4px 8px;
  border-radius: 20px;
  display: inline-block;
}

.heatmap-container {
  padding: 20px;
}

.heatmap-legend {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-bottom: 20px;
  font-size: 12px;
}

.legend-scale {
  display: flex;
  gap: 2px;
}

.legend-item {
  width: 12px;
  height: 12px;
  border-radius: 2px;
}

.heatmap-day {
  width: 12px;
  height: 12px;
  margin: 1px;
  border-radius: 2px;
  cursor: pointer;
  transition: all 0.2s;
}

.heatmap-day:hover {
  transform: scale(1.2);
  box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.insight-card {
  background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
  color: white;
  padding: 20px;
  border-radius: 12px;
  margin: 10px 0;
}

.insight-title {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
}

.insight-text {
  font-size: 14px;
  opacity: 0.9;
}

.metric-comparison {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 15px;
  margin: 20px 0;
}

.metric-item {
  text-align: center;
  padding: 15px;
  background: rgba(255,255,255,0.1);
  border-radius: 8px;
  backdrop-filter: blur(5px);
}

.metric-value {
  font-size: 24px;
  font-weight: bold;
  color: #333;
  margin-bottom: 5px;
}

.metric-label {
  font-size: 12px;
  color: #666;
  text-transform: uppercase;
}
  </style>
</head>

<body>
  <!-- Mobile Hamburger Button -->
  <button class="hamburger-btn" onclick="toggleSidebar()">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <!-- Sidebar Overlay for Mobile -->
  <div class="sidebar-overlay" onclick="closeSidebar()"></div>

  <div class="sidebar" id="sidebar">
    <h2>Admin AKITA</h2>
    <a href="#" onclick="showSection('dashboard')" class="nav-link active">📊 Dashboard</a>
    <a href="#" onclick="showSection('kelola')" class="nav-link">📋 Kelola Agenda</a>
    <a href="#" onclick="showSection('tambah')" class="nav-link">➕ Tambah Agenda</a>
    <a href="/auth/logout" style="margin-top: 20px; background: rgba(220, 53, 69, 0.2); border-color: rgba(220, 53, 69, 0.3);">🚪 Logout</a>
  </div>

  <div class="main-content">

    <div class="toast-container" id="toast-container"></div>
    <div class="header">
      <h1>Agenda Kita</h1>
      <p>Sistem Manajemen Agenda Kantor</p>
    </div>

    <div id="dashboard" class="content-section active">
      <div class="stats-grid">
        <div class="card">
  <h2>Analisa Hari Tersibuk</h2>
  <div style="display: flex; gap: 20px; margin-bottom: 20px;">
    <select id="monthFilter" onchange="updateChart()" style="padding: 8px; border-radius: 5px; border: 1px solid #ddd;">
      <option value="all">Semua Bulan</option>
      <option value="1">Januari</option>
      <option value="2">Februari</option>
      <option value="3">Maret</option>
      <option value="4">April</option>
      <option value="5">Mei</option>
      <option value="6">Juni</option>
      <option value="7">Juli</option>
      <option value="8">Agustus</option>
      <option value="9">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
    </select>
    <select id="chartType" onchange="updateChart()" style="padding: 8px; border-radius: 5px; border: 1px solid #ddd;">
      <option value="bar">Bar Chart</option>
      <option value="line">Line Chart</option>
      <option value="doughnut">Doughnut Chart</option>
    </select>
  </div>
  <div style="position: relative; height: 400px;">
    <canvas id="busyDaysChart"></canvas>
  </div>
</div>
<div class="card">
  <h2>Tren Agenda Bulanan & Prediksi</h2>
  <div class="chart-filters">
    <select id="yearFilter" onchange="updateMonthlyTrend()">
      <option value="2024">2024</option>
      <option value="2023">2023</option>
      <option value="all">Semua Tahun</option>
    </select>
  </div>
  <div class="chart-container">
    <canvas id="monthlyTrendChart"></canvas>
  </div>
</div>
<div class="card">
  <h2>Analisa Beban Kerja PIC</h2>
  <div class="chart-filters">
    <select id="picPeriod" onchange="updatePICAnalysis()">
      <option value="month">Bulan Ini</option>
      <option value="quarter">Quarter Ini</option>
      <option value="year">Tahun Ini</option>
    </select>
  </div>
  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="chart-container">
      <canvas id="picWorkloadChart"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="picEfficiencyChart"></canvas>
    </div>
  </div>
</div>
<div class="card">
  <h2>Analisa Utilitas Tempat</h2>
  <div class="chart-filters">
    <button class="tab" onclick="switchLocationView('usage')">Penggunaan Ruang</button>
    <button class="tab" onclick="switchLocationView('efficiency')">Efisiensi Ruang</button>
    <button class="tab" onclick="switchLocationView('peak')">Peak Hours</button>
  </div>
  <div class="chart-container">
    <canvas id="locationChart"></canvas>
  </div>
</div>
<div class="card">
  <h2>Key Performance Indicators</h2>
  <div class="kpi-grid">
    <div class="kpi-card">
      <div class="kpi-value" id="avgDaily">0</div>
      <div class="kpi-label">Rata-rata Agenda/Hari</div>
      <div class="kpi-trend" id="avgDailyTrend">📈 +5%</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-value" id="busyScore">0</div>
      <div class="kpi-label">Busy Score</div>
      <div class="kpi-trend" id="busyScoreTrend">📊 Normal</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-value" id="efficiency">0%</div>
      <div class="kpi-label">Efisiensi Waktu</div>
      <div class="kpi-trend" id="efficiencyTrend">⚡ Optimal</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-value" id="utilization">0%</div>
      <div class="kpi-label">Utilitas Ruang</div>
      <div class="kpi-trend" id="utilizationTrend">🏢 High</div>
    </div>
  </div>
</div>
<div class="card">
  <h2>Calendar Heatmap - Intensitas Kegiatan</h2>
  <div class="heatmap-container">
    <div class="heatmap-legend">
      <span>Rendah</span>
      <div class="legend-scale">
        <div class="legend-item" style="background: #ebedf0;"></div>
        <div class="legend-item" style="background: #c6e48b;"></div>
        <div class="legend-item" style="background: #7bc96f;"></div>
        <div class="legend-item" style="background: #239a3b;"></div>
        <div class="legend-item" style="background: #196127;"></div>
      </div>
      <span>Tinggi</span>
    </div>
    <div id="heatmapCalendar"></div>
  </div>
</div>
        <div class="stat-card">
          <h3 id="total-agenda">0</h3>
          <p>Total Agenda</p>
        </div>
        <div class="stat-card">
          <h3 id="agenda-hari-ini">0</h3>
          <p>Agenda Hari Ini</p>
        </div>
        <div class="stat-card">
          <h3 id="agenda-minggu">0</h3>
          <p>Agenda Minggu Ini</p>
        </div>
      </div>

      <div class="card">
        <h2>Selamat datang, <?= session('adminName') ?>!</h2>
        <p>Gunakan menu di samping untuk mengelola agenda kantor. Sistem ini membantu Anda mengorganisir dan mengelola semua kegiatan kantor dengan mudah.</p>
      </div>
    </div>

    <div id="kelola" class="content-section">
      <div class="card">
        <h2>Kelola Agenda</h2>

        <div class="filter-tabs">
          <div class="tab active" onclick="filterAgenda('all')">Semua</div>
          <div class="tab" onclick="filterAgenda('today')">Hari Ini</div>
          <div class="tab" onclick="filterAgenda('week')">Minggu Ini</div>
        </div>
        <div class="search-container">
          <span class="search-icon">🔍</span>
          <input type="text" class="search-box" id="searchInput" placeholder="Cari agenda, PIC, atau tempat...">
          <button class="search-clear" id="searchClear" onclick="clearSearch()">×</button>
          <div class="search-stats" id="searchStats"></div>
        </div>

        <div class="table-container">
          <table id="agenda-table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Agenda</th>
                <th>PIC</th>
                <th>Tempat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div id="editForm" class="edit-form hidden">
          <h3>Edit Agenda</h3>
          <form onsubmit="submitEdit(event)">
            <input type="hidden" id="edit-id">
            <div class="form-row">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" id="edit-tanggal" required>
              </div>
              <div class="form-group">
                <label>Jam</label>
                <input type="text" id="edit-jam" placeholder="Jam" required>
              </div>
            </div>
            <div class="form-group">
              <label>Agenda</label>
              <input type="text" id="edit-kegiatan" placeholder="Agenda" required>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>PIC</label>
                <input type="text" id="edit-pic" placeholder="PIC">
              </div>
              <div class="form-group">
                <label>Tempat</label>
                <input type="text" id="edit-tempat" placeholder="Tempat">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Batal</button>
          </form>
        </div>
      </div>
    </div>

    <div id="tambah" class="content-section">
      <div class="card">
        <h2>Tambah Agenda</h2>
        <form onsubmit="submitTambah(event)">
          <div class="form-row">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" id="Tanggal" required>
            </div>
            <div class="form-group">
              <label>Jam Mulai</label>
              <input type="time" id="JamMulai" required>
            </div>
            <div class="form-group">
              <label>Jam Selesai</label>
              <input type="time" id="JamSelesai">
            </div>
          </div>
          <div class="form-group">
            <label>Agenda</label>
            <input type="text" id="Agenda" placeholder="Masukkan agenda" required>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>PIC</label>
              <input type="text" id="PIC" placeholder="Person in Charge">
            </div>
            <div class="form-group">
              <label>Tempat</label>
              <input type="text" id="Tempat" placeholder="Lokasi kegiatan">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Agenda</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    let busyDaysChart = null;
let chartData = [];
// Fungsi untuk menganalisa hari tersibuk
function analyzeBusyDays(data) {
  const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const dayCounts = [0, 0, 0, 0, 0, 0, 0];
  
  const monthFilter = document.getElementById('monthFilter').value;
  
  data.forEach(item => {
    const date = new Date(convertToISODate(item.tanggal));
    const month = date.getMonth() + 1;
    
    // Filter berdasarkan bulan jika dipilih
    if (monthFilter !== 'all' && month !== parseInt(monthFilter)) {
      return;
    }
    
    const dayIndex = date.getDay();
    dayCounts[dayIndex]++;
  });
  
  return {
    labels: dayNames,
    data: dayCounts
  };
}

// Fungsi untuk membuat/update chart
function createBusyDaysChart(data) {
  const ctx = document.getElementById('busyDaysChart').getContext('2d');
  const chartType = document.getElementById('chartType').value;
  
  // Hapus chart yang ada
  if (busyDaysChart) {
    busyDaysChart.destroy();
  }
  
  const analyzedData = analyzeBusyDays(data);
  
  const colors = [
    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
    '#9966FF', '#FF9F40', '#FF6384'
  ];
  
  const config = {
    type: chartType,
    data: {
      labels: analyzedData.labels,
      datasets: [{
        label: 'Jumlah Agenda',
        data: analyzedData.data,
        backgroundColor: chartType === 'doughnut' ? colors : 'rgba(102, 126, 234, 0.8)',
        borderColor: chartType === 'doughnut' ? colors : 'rgba(102, 126, 234, 1)',
        borderWidth: 2,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: chartType === 'doughnut',
          position: 'bottom'
        },
        title: {
          display: true,
          text: `Distribusi Agenda per Hari ${getMonthName()}`
        }
      },
      scales: chartType !== 'doughnut' ? {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      } : {}
    }
  };
  
  busyDaysChart = new Chart(ctx, config);
}

// Fungsi untuk mendapatkan nama bulan
function getMonthName() {
  const monthFilter = document.getElementById('monthFilter').value;
  if (monthFilter === 'all') return '(Semua Bulan)';
  
  const months = [
    '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  
  return `(${months[parseInt(monthFilter)]})`;
}

// Fungsi untuk update chart
function updateChart() {
  if (chartData.length > 0) {
    createBusyDaysChart(chartData);
  }
}
    const API = '/agenda';
    // Toast Notification System
    function showToast(message, type = 'success') {
      const container = document.getElementById('toast-container');

      const toast = document.createElement('div');
      toast.className = `toast ${type}`;

      const icons = {
        success: '✅',
        error: '❌',
        warning: '⚠️',
        info: 'ℹ️'
      };

      toast.innerHTML = `
    <div class="toast-content">
      <span class="toast-icon">${icons[type]}</span>
      <span class="toast-message">${message}</span>
      <button class="toast-close" onclick="closeToast(this)">×</button>
    </div>
  `;

      container.appendChild(toast);

      // Trigger animation
      setTimeout(() => toast.classList.add('show'), 100);

      // Auto remove after 4 seconds
      setTimeout(() => closeToast(toast), 4000);
    }

    function closeToast(element) {
      const toast = element.closest ? element.closest('.toast') : element;
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 300);
    }

    // Loading State Helper
    function setButtonLoading(button, isLoading, loadingText = 'Memproses...') {
      if (isLoading) {
        button.originalText = button.textContent;
        button.textContent = loadingText;
        button.classList.add('loading');
        button.disabled = true;
      } else {
        button.textContent = button.originalText;
        button.classList.remove('loading');
        button.disabled = false;
      }
    }

    function setTableLoading(tableId, isLoading) {
      const table = document.getElementById(tableId);
      if (isLoading) {
        table.classList.add('table-loading');
      } else {
        table.classList.remove('table-loading');
      }
    }

    // Search Functionality
    let searchQuery = '';
    let allAgendaData = [];

    function initSearch() {
      const searchInput = document.getElementById('searchInput');
      const searchClear = document.getElementById('searchClear');

      searchInput.addEventListener('input', function() {
        searchQuery = this.value.toLowerCase();

        // Show/hide clear button
        if (searchQuery.length > 0) {
          searchClear.style.display = 'block';
        } else {
          searchClear.style.display = 'none';
        }

        // Filter and display results
        displayFilteredAgenda();
      });
    }

    function clearSearch() {
      const searchInput = document.getElementById('searchInput');
      const searchClear = document.getElementById('searchClear');
      const searchStats = document.getElementById('searchStats');

      searchInput.value = '';
      searchQuery = '';
      searchClear.style.display = 'none';
      searchStats.textContent = '';

      displayFilteredAgenda();
    }

    function highlightText(text, query) {
      if (!query || !text) return text;

      const regex = new RegExp(`(${query})`, 'gi');
      return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function searchAgenda(data, query) {
      if (!query) return data;

      return data.filter(item => {
        const searchableText = [
          item.kegiatan || '',
          item.pic || '',
          item.tempat || '',
          item.tanggal || '',
          item.jam || ''
        ].join(' ').toLowerCase();

        return searchableText.includes(query);
      });
    }

    function displayFilteredAgenda() {
      const tbody = document.querySelector("#agenda-table tbody");
      const searchStats = document.getElementById('searchStats');

      // Filter berdasarkan tab yang aktif
      let filteredData = filterAgendaData(allAgendaData);

      // Filter berdasarkan search query
      if (searchQuery) {
        filteredData = searchAgenda(filteredData, searchQuery);
      }

      // Clear table
      tbody.innerHTML = "";

      // Display results
      if (filteredData.length === 0) {
        tbody.innerHTML = `
      <tr>
        <td colspan="6" class="no-results">
          <div class="no-results-icon">😔</div>
          <div>Tidak ditemukan agenda yang sesuai</div>
        </td>
      </tr>
    `;
        searchStats.textContent = '';
      } else {
        filteredData.forEach(row => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
        <td>${highlightText(row.tanggal, searchQuery)}</td>
        <td>${highlightText(row.jam, searchQuery)}</td>
        <td>${highlightText(row.kegiatan, searchQuery)}</td>
        <td>${highlightText(row.pic || '', searchQuery)}</td>
        <td>${highlightText(row.tempat || '', searchQuery)}</td>
        <td>
          <button onclick='edit(${JSON.stringify(row)})' class="btn btn-warning">Edit</button>
          <button onclick='hapus(${row.id})' class="btn btn-danger">Hapus</button>
        </td>
      `;
          tbody.appendChild(tr);
        });

        // Update search stats
        if (searchQuery) {
          const totalResults = filteredData.length;
          const totalData = allAgendaData.length;
          searchStats.textContent = `Menampilkan ${totalResults} dari ${totalData} agenda`;
        } else {
          searchStats.textContent = '';
        }
      }
    }
    let currentFilter = 'all';


    function getTodayDate() {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }

    function getWeekFromNow() {
      const weekFromNow = new Date();
      weekFromNow.setDate(weekFromNow.getDate() + 7);
      const year = weekFromNow.getFullYear();
      const month = String(weekFromNow.getMonth() + 1).padStart(2, '0');
      const day = String(weekFromNow.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }

    function showSection(id) {
  // Update navigation active state
  document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
  event.target.classList.add('active');

  // Show selected section
  document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
  document.getElementById(id).classList.add('active');

  if (id === 'kelola') loadAgenda();
  if (id === 'dashboard') {
    loadDashboardStats();
    // Refresh chart jika sudah ada data
    if (chartData.length > 0) {
      setTimeout(() => updateChart(), 100);
    }
  }
}

    function loadAgenda() {
      const table = document.getElementById('agenda-table');
      setTableLoading('agenda-table', true);

      fetch(API)
        .then(res => res.json())
        .then(data => {
          allAgendaData = data; // Store all data for search
          displayFilteredAgenda(); // Display filtered results
        })
        .catch(() => {
          showToast("Gagal memuat data agenda!", "error");
        })
        .finally(() => {
          setTableLoading('agenda-table', false);
        });
    }

    function filterAgenda(type) {
      currentFilter = type;
      document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
      event.target.classList.add('active');
      displayFilteredAgenda(); // Use new display function
    }

    function filterAgendaData(data) {
      const today = getTodayDate();
      const weekFromNow = getWeekFromNow();

      switch (currentFilter) {
        case 'today':
          return data.filter(item => {
            const itemDate = convertToISODate(item.tanggal);
            return itemDate === today;
          });
        case 'week':
          return data.filter(item => {
            const itemDate = convertToISODate(item.tanggal);
            return itemDate >= today && itemDate <= weekFromNow;
          });
        default:
          return data;
      }
    }

    function convertToISODate(dateString) {
      // Cek apakah sudah dalam format ISO (yyyy-mm-dd)
      if (dateString.match(/^\d{4}-\d{2}-\d{2}$/)) {
        return dateString;
      }

      // Konversi dari format Indonesia (dd-Bulan-yyyy)
      const parts = dateString.split('-');
      if (parts.length !== 3) return null;

      const [day, month, year] = parts;
      const monthMap = {
        'Januari': '01',
        'Februari': '02',
        'Maret': '03',
        'April': '04',
        'Mei': '05',
        'Juni': '06',
        'Juli': '07',
        'Agustus': '08',
        'September': '09',
        'Oktober': '10',
        'November': '11',
        'Desember': '12'
      };

      if (!monthMap[month]) return null;

      return `${year}-${monthMap[month]}-${day.padStart(2, '0')}`;
    }

    function loadDashboardStats() {
  fetch(API)
    .then(res => res.json())
    .then(data => {
      const today = getTodayDate();
      const weekFromNow = getWeekFromNow();

      const todayAgenda = data.filter(item => {
        const itemDate = convertToISODate(item.tanggal);
        return itemDate === today;
      });

      const weekAgenda = data.filter(item => {
        const itemDate = convertToISODate(item.tanggal);
        return itemDate >= today && itemDate <= weekFromNow;
      });

      document.getElementById('total-agenda').textContent = data.length;
      document.getElementById('agenda-hari-ini').textContent = todayAgenda.length;
      document.getElementById('agenda-minggu').textContent = weekAgenda.length;

      // Simpan data untuk chart dan buat chart
      chartData = data;
      createBusyDaysChart(data);
       createBusyDaysChart(data);
      createMonthlyTrendChart(data);
      createPICAnalysis(data);
      createLocationChart(data);
      createHeatmapCalendar(data);
      calculateKPIs(data);
    })
    .catch(() => {
      showToast("Gagal memuat statistik!", "error");
    });
}

    function edit(data) {
      showSection('kelola');
      document.getElementById("editForm").classList.remove("hidden");
      document.getElementById("edit-id").value = data.id;
      document.getElementById("edit-tanggal").value = toYMD(data.tanggal);
      document.getElementById("edit-jam").value = data.jam;
      document.getElementById("edit-kegiatan").value = data.kegiatan;
      document.getElementById("edit-pic").value = data.pic || '';
      document.getElementById("edit-tempat").value = data.tempat || '';
    }

    function toYMD(tglIndo) {
      const [d, b, y] = tglIndo.split("-");
      const bulan = {
        Januari: "01",
        Februari: "02",
        Maret: "03",
        April: "04",
        Mei: "05",
        Juni: "06",
        Juli: "07",
        Agustus: "08",
        September: "09",
        Oktober: "10",
        November: "11",
        Desember: "12"
      };
      return `${y}-${bulan[b]}-${d.padStart(2, '0')}`;
    }

    function cancelEdit() {
      document.getElementById("editForm").classList.add("hidden");
    }

    function submitEdit(e) {
      e.preventDefault();
      const submitBtn = e.target.querySelector('button[type="submit"]');
      setButtonLoading(submitBtn, true, 'Menyimpan...');

      const id = document.getElementById("edit-id").value;
      const data = {
        tanggal: document.getElementById("edit-tanggal").value,
        jam: document.getElementById("edit-jam").value,
        kegiatan: document.getElementById("edit-kegiatan").value,
        pic: document.getElementById("edit-pic").value,
        tempat: document.getElementById("edit-tempat").value
      };

      fetch(`${API}/${id}`, {
          method: "PUT",
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(() => {
          showToast("Agenda berhasil diupdate!", "success");
          cancelEdit();
          loadAgenda();
        })
        .catch(() => {
          showToast("Gagal mengupdate agenda!", "error");
        })
        .finally(() => {
          setButtonLoading(submitBtn, false);
        });
    }

    function hapus(id) {
      if (confirm("Yakin ingin menghapus agenda ini?")) {
        // Cari tombol hapus yang diklik
        const deleteBtn = event.target;
        setButtonLoading(deleteBtn, true, 'Menghapus...');

        fetch(`${API}/${id}`, {
            method: 'DELETE'
          })
          .then(() => {
            showToast("Agenda berhasil dihapus!", "success");
            loadAgenda();
            loadDashboardStats();
          })
          .catch(() => {
            showToast("Gagal menghapus agenda!", "error");
          })
          .finally(() => {
            setButtonLoading(deleteBtn, false);
          });
      }
    }

    function submitTambah(e) {
      e.preventDefault();
      const submitBtn = e.target.querySelector('button[type="submit"]');
      setButtonLoading(submitBtn, true, 'Menambahkan...');

      const formData = new FormData();

      // Modifikasi bagian ini untuk handle jam selesai opsional
      const jamMulai = document.getElementById("JamMulai").value;
      const jamSelesai = document.getElementById("JamSelesai").value;

      // Jika jam selesai tidak diisi, hanya gunakan jam mulai
      const jam = jamSelesai ? `${jamMulai} - ${jamSelesai}` : jamMulai;

      formData.append("tanggal", document.getElementById("Tanggal").value);
      formData.append("jam", jam);
      formData.append("kegiatan", document.getElementById("Agenda").value);
      formData.append("pic", document.getElementById("PIC").value);
      formData.append("tempat", document.getElementById("Tempat").value);

      fetch(API, {
          method: "POST",
          body: formData
        })
        .then(() => {
          showToast("Agenda berhasil ditambahkan!", "success");
          e.target.reset();
          loadDashboardStats();
        })
        .catch(() => {
          showToast("Gagal menambahkan agenda!", "error");
        })
        .finally(() => {
          setButtonLoading(submitBtn, false);
        });
    }

    // Initialize
    loadDashboardStats();
    initSearch();
    // Responsive Sidebar Functions
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const hamburger = document.querySelector('.hamburger-btn');
      const overlay = document.querySelector('.sidebar-overlay');

      sidebar.classList.toggle('active');
      hamburger.classList.toggle('active');
      overlay.classList.toggle('active');
    }

    function closeSidebar() {
      const sidebar = document.getElementById('sidebar');
      const hamburger = document.querySelector('.hamburger-btn');
      const overlay = document.querySelector('.sidebar-overlay');

      sidebar.classList.remove('active');
      hamburger.classList.remove('active');
      overlay.classList.remove('active');
    }

    // Auto close sidebar when clicking nav links on mobile
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 1024) {
          closeSidebar();
        }
      });
    });

    // Close sidebar on window resize if desktop
    window.addEventListener('resize', () => {
      if (window.innerWidth > 1024) {
        closeSidebar();
      }
    });

    // Touch gestures for mobile (swipe to close)
    let touchStartX = 0;
    let touchEndX = 0;

    document.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    });

    document.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
    });

    function handleSwipe() {
      const sidebar = document.getElementById('sidebar');
      const swipeThreshold = 50;

      if (touchEndX < touchStartX - swipeThreshold && sidebar.classList.contains('active')) {
        // Swipe left to close
        closeSidebar();
      }
    }

    // Variabel global untuk charts
let monthlyTrendChart = null;
let picWorkloadChart = null;
let picEfficiencyChart = null;
let locationChart = null;

// Analisa Tren Bulanan
function createMonthlyTrendChart(data) {
  const ctx = document.getElementById('monthlyTrendChart').getContext('2d');
  
  if (monthlyTrendChart) monthlyTrendChart.destroy();
  
  const monthlyData = analyzeMonthlyTrend(data);
  const prediction = predictNextMonth(monthlyData.data);
  
  monthlyTrendChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [...monthlyData.labels, 'Prediksi'],
      datasets: [
        {
          label: 'Agenda Aktual',
          data: [...monthlyData.data, null],
          borderColor: '#667eea',
          backgroundColor: 'rgba(102, 126, 234, 0.1)',
          tension: 0.4,
          fill: true
        },
        {
          label: 'Prediksi',
          data: [...Array(monthlyData.data.length).fill(null), prediction],
          borderColor: '#ff6b6b',
          backgroundColor: 'rgba(255, 107, 107, 0.1)',
          borderDash: [5, 5],
          pointStyle: 'triangle'
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Tren Agenda Bulanan dengan Prediksi'
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

// Analisa PIC Performance
function createPICAnalysis(data) {
  const picData = analyzePICWorkload(data);
  
  // Workload Chart
  const ctx1 = document.getElementById('picWorkloadChart').getContext('2d');
  if (picWorkloadChart) picWorkloadChart.destroy();
  
  picWorkloadChart = new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: picData.names,
      datasets: [{
        label: 'Jumlah Agenda',
        data: picData.counts,
        backgroundColor: '#4ecdc4',
        borderColor: '#26d0ce',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Beban Kerja per PIC'
        }
      }
    }
  });
  
  // Efficiency Chart
  const ctx2 = document.getElementById('picEfficiencyChart').getContext('2d');
  if (picEfficiencyChart) picEfficiencyChart.destroy();
  
  picEfficiencyChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: picData.names,
      datasets: [{
        data: picData.efficiency,
        backgroundColor: ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#ff99cc'],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Efisiensi PIC (%)'
        }
      }
    }
  });
}

// Analisa Lokasi
function createLocationChart(data, viewType = 'usage') {
  const ctx = document.getElementById('locationChart').getContext('2d');
  if (locationChart) locationChart.destroy();
  
  const locationData = analyzeLocation(data, viewType);
  
  const config = {
    usage: {
      type: 'bar',
      title: 'Penggunaan Ruang',
      color: '#667eea'
    },
    efficiency: {
      type: 'line',
      title: 'Efisiensi Ruang (%)',
      color: '#4ecdc4'
    },
    peak: {
      type: 'radar',
      title: 'Peak Hours per Lokasi',
      color: '#ff6b6b'
    }
  };
  
  locationChart = new Chart(ctx, {
    type: config[viewType].type,
    data: {
      labels: locationData.labels,
      datasets: [{
        label: config[viewType].title,
        data: locationData.data,
        backgroundColor: config[viewType].color,
        borderColor: config[viewType].color,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: config[viewType].title
        }
      }
    }
  });
}

// Heatmap Calendar
function createHeatmapCalendar(data) {
  const heatmapContainer = document.getElementById('heatmapCalendar');
  const heatmapData = analyzeHeatmap(data);
  
  // Generate calendar grid
  let heatmapHTML = '<div style="display: grid; grid-template-columns: repeat(53, 1fr); gap: 2px;">';
  
  // Generate 365 days
  for (let week = 0; week < 53; week++) {
    for (let day = 0; day < 7; day++) {
      const date = new Date(2024, 0, week * 7 + day);
      const dateStr = date.toISOString().split('T')[0];
      const intensity = heatmapData[dateStr] || 0;
      const color = getHeatmapColor(intensity);
      
      heatmapHTML += `
        <div class="heatmap-day" 
             style="background: ${color};" 
             title="${dateStr}: ${intensity} agenda"
             onclick="showDayDetails('${dateStr}')">
        </div>`;
    }
  }
  
  heatmapHTML += '</div>';
  heatmapContainer.innerHTML = heatmapHTML;
}

// KPI Calculations
function calculateKPIs(data) {
  const kpis = {
    avgDaily: calculateAvgDaily(data),
    busyScore: calculateBusyScore(data),
    efficiency: calculateEfficiency(data),
    utilization: calculateUtilization(data)
  };
  
  // Update KPI display
  document.getElementById('avgDaily').textContent = kpis.avgDaily.toFixed(1);
  document.getElementById('busyScore').textContent = kpis.busyScore;
  document.getElementById('efficiency').textContent = kpis.efficiency + '%';
  document.getElementById('utilization').textContent = kpis.utilization + '%';
  
  // Update trends
  updateKPITrends(kpis);
}

// Helper Functions
function analyzeMonthlyTrend(data) {
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  const monthlyCounts = new Array(12).fill(0);
  
  data.forEach(item => {
    const date = new Date(convertToISODate(item.tanggal));
    const month = date.getMonth();
    monthlyCounts[month]++;
  });
  
  return {
    labels: months,
    data: monthlyCounts
  };
}

function predictNextMonth(monthlyData) {
  // Simple linear regression for prediction
  const n = monthlyData.length;
  const sumX = n * (n - 1) / 2;
  const sumY = monthlyData.reduce((a, b) => a + b, 0);
  const sumXY = monthlyData.reduce((sum, y, x) => sum + x * y, 0);
  const sumX2 = monthlyData.reduce((sum, _, x) => sum + x * x, 0);
  
  const slope = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
  const intercept = (sumY - slope * sumX) / n;
  
  return Math.round(slope * n + intercept);
}

function analyzePICWorkload(data) {
  const picMap = {};
  
  data.forEach(item => {
    const pic = item.pic || 'Tidak Ada PIC';
    picMap[pic] = (picMap[pic] || 0) + 1;
  });
  
  const names = Object.keys(picMap);
  const counts = Object.values(picMap);
  const total = counts.reduce((a, b) => a + b, 0);
  const efficiency = counts.map(count => Math.round((count / total) * 100));
  
  return { names, counts, efficiency };
}

function analyzeLocation(data, viewType) {
  const locationMap = {};
  
  data.forEach(item => {
    const location = item.tempat || 'Tidak Ada Lokasi';
    locationMap[location] = (locationMap[location] || 0) + 1;
  });
  
  const labels = Object.keys(locationMap);
  let chartData = Object.values(locationMap);
  
  if (viewType === 'efficiency') {
    const max = Math.max(...chartData);
    chartData = chartData.map(value => Math.round((value / max) * 100));
  }
  
  return { labels, data: chartData };
}

function analyzeHeatmap(data) {
  const heatmapData = {};
  
  data.forEach(item => {
    const date = convertToISODate(item.tanggal);
    heatmapData[date] = (heatmapData[date] || 0) + 1;
  });
  
  return heatmapData;
}

function getHeatmapColor(intensity) {
  const colors = ['#ebedf0', '#c6e48b', '#7bc96f', '#239a3b', '#196127'];
  const index = Math.min(Math.floor(intensity / 2), colors.length - 1);
  return colors[index];
}

function calculateAvgDaily(data) {
  const days = new Set();
  data.forEach(item => days.add(convertToISODate(item.tanggal)));
  return data.length / days.size;
}

function calculateBusyScore(data) {
  const avgDaily = calculateAvgDaily(data);
  if (avgDaily <= 2) return 'Low';
  if (avgDaily <= 5) return 'Medium';
  return 'High';
}

function calculateEfficiency(data) {
  // Mock calculation - bisa disesuaikan dengan logika bisnis
  const totalHours = data.length * 2; // asumsi 2 jam per agenda
  const workingHours = 8 * 30; // 8 jam x 30 hari
  return Math.min(Math.round((totalHours / workingHours) * 100), 100);
}

function calculateUtilization(data) {
  const locations = new Set();
  data.forEach(item => {
    if (item.tempat) locations.add(item.tempat);
  });
  
  const totalRooms = 10; // asumsi total ruang
  return Math.round((locations.size / totalRooms) * 100);
}

// Update functions
function updateMonthlyTrend() {
  if (chartData.length > 0) {
    createMonthlyTrendChart(chartData);
  }
}

function updatePICAnalysis() {
  if (chartData.length > 0) {
    createPICAnalysis(chartData);
  }
}

function switchLocationView(viewType) {
  document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
  event.target.classList.add('active');
  
  if (chartData.length > 0) {
    createLocationChart(chartData, viewType);
  }
}

function updateKPITrends(kpis) {
  // Mock trend calculations
  const trends = {
    avgDaily: '+5%',
    busyScore: 'Stable',
    efficiency: '+12%',
    utilization: '+8%'
  };
  
  document.getElementById('avgDailyTrend').textContent = `📈 ${trends.avgDaily}`;
  document.getElementById('busyScoreTrend').textContent = `📊 ${trends.busyScore}`;
  document.getElementById('efficiencyTrend').textContent = `⚡ ${trends.efficiency}`;
  document.getElementById('utilizationTrend').textContent = `🏢 ${trends.utilization}`;
}
  </script>
</body>

</html>