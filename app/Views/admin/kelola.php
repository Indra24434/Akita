<?php

/** @var CodeIgniter\View\View $this */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Dashboard Admin AKITA</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
.chart-container {
  position: relative;
  height: 280px;
  margin: 15px 0;
}

.chart-filters {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
  flex-wrap: wrap;
}

.chart-filters select {
  padding: 6px 10px;
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  background: white;
  font-size: 13px;
  cursor: pointer;
  min-width: 120px;
}

.chart-filters select:focus {
  outline: none;
  border-color: #667eea;
}

@media (max-width: 768px) {
  .chart-container {
    height: 220px;
  }

  .chart-filters {
    justify-content: center;
    gap: 8px;
  }

  .chart-filters select {
    font-size: 12px;
    padding: 5px 8px;
    min-width: 100px;
  }
}

/* Dashboard specific styles */
.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 15px;
  margin-bottom: 15px;
}

@media (max-width: 768px) {
  .dashboard-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  .dashboard-grid .card {
    margin-bottom: 12px;
  }
}

/* Ensure proper spacing for dashboard elements */
#dashboard .card {
  margin-bottom: 15px;
}

#dashboard .stats-grid {
  margin-bottom: 20px;
}

/* PIC Analysis Grid */
.pic-analysis-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;
}

@media (max-width: 768px) {
  .pic-analysis-grid {
    grid-template-columns: 1fr;
    gap: 12px;
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
  border-radius: 12px;
  padding: 18px;
  margin-bottom: 15px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.card h2 {
  color: #333;
  margin-bottom: 15px;
  font-size: 20px;
  font-weight: 600;
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
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  margin-bottom: 25px;
}

.stat-card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 12px;
  padding: 25px 20px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.2);
  min-height: 120px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.stat-card h3 {
  color: #fff;
  font-size: 22px;
  margin-bottom: 8px;
  font-weight: 600;
}

.stat-card p {
  color: rgba(255, 255, 255, 0.8);
  font-size: 13px;
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

  .stats-grid {
    grid-template-columns: 1fr 1fr;
    gap: 15px;
  }

  .stat-card {
    padding: 20px 15px;
    min-height: 100px;
  }

  .stat-card h3 {
    font-size: 26px !important;
    margin-bottom: 8px;
  }

  .stat-card p {
    font-size: 14px !important;
  }

  .card {
    padding: 20px !important;
  }

  .card h2 {
    font-size: 18px !important;
  }

  .btn {
    padding: 10px 16px !important;
    font-size: 14px !important;
    margin: 3px !important;
  }

  th, td {
    padding: 10px 8px !important;
    font-size: 13px !important;
  }
}

@media (max-width: 480px) {
  .main-content {
    padding: 80px 15px 15px !important;
  }

  .header {
    padding: 20px !important;
  }

  .header h1 {
    font-size: 22px !important;
  }

  .card {
    padding: 20px !important;
    margin-bottom: 20px !important;
  }

  .card h2 {
    font-size: 20px !important;
    margin-bottom: 15px !important;
  }

  .stats-grid {
    grid-template-columns: 1fr !important;
    gap: 15px !important;
  }

  .stat-card {
    padding: 25px 20px !important;
    min-height: 100px !important;
  }

  .stat-card h3 {
    font-size: 32px !important;
    margin-bottom: 10px !important;
  }

  .stat-card p {
    font-size: 16px !important;
  }

  .filter-tabs {
    justify-content: center;
    flex-wrap: wrap;
  }

  .tab {
    padding: 12px 20px !important;
    font-size: 14px !important;
    margin: 5px !important;
  }

  .search-box {
    padding: 15px 16px 15px 45px !important;
    font-size: 16px !important;
  }

  .table-container {
    border-radius: 8px;
    font-size: 14px !important;
  }

  th, td {
    padding: 12px 8px !important;
    font-size: 14px !important;
  }

  .btn {
    padding: 10px 15px !important;
    font-size: 13px !important;
    margin: 3px !important;
    display: inline-block !important;
  }

  .form-group input,
  .form-group textarea {
    padding: 15px !important;
    font-size: 16px !important;
  }

  .form-group label {
    font-size: 14px !important;
    margin-bottom: 8px !important;
  }

  .toast {
    min-width: 280px;
    margin: 0 10px;
    font-size: 14px !important;
  }

  .chart-container {
    height: 250px !important;
    margin: 15px 0 !important;
  }

  .chart-filters select {
    padding: 12px 15px !important;
    font-size: 14px !important;
    min-width: auto !important;
    width: 100% !important;
    margin-bottom: 10px !important;
  }
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
.filter-tabs {
  display: flex;
  gap: 8px;
  margin-bottom: 20px;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  padding: 0 10px;
}

.tab {
  padding: 12px 20px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 25px;
  background: rgba(255, 255, 255, 0.1);
  color: #000;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
  font-size: 14px;
  white-space: nowrap;
  text-align: center;
  backdrop-filter: blur(10px);
  min-width: fit-content;
}

.tab:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
}

.tab.active {
  background: rgba(255, 255, 255, 0.3);
  border-color: rgba(0, 0, 0, 0.5);
  color: #333;
  font-weight: 600;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Mobile-First Table Design */
.table-container {
  overflow: visible;
  border-radius: 10px;
  background: #fff;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Desktop Table (default) */
.desktop-table {
  display: block;
}

.mobile-cards {
  display: none;
}

/* Mobile Card Layout */
.agenda-card {
  background: #fff;
  border-radius: 12px;
  padding: 16px;
  margin-bottom: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  border-left: 4px solid #667eea;
  position: relative;
}

.agenda-card-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 12px;
}

.agenda-card-date {
  background: #667eea;
  color: white;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
}

.agenda-card-time {
  background: rgba(102, 126, 234, 0.1);
  color: #667eea;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 11px;
  font-weight: 500;
}

.agenda-card-title {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
  line-height: 1.4;
}

.agenda-card-details {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  margin-bottom: 12px;
}

.agenda-card-detail {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  color: #666;
}

.agenda-card-detail-icon {
  font-size: 14px;
  width: 16px;
  text-align: center;
}

.agenda-card-actions {
  display: flex;
  gap: 8px;
  justify-content: flex-end;
}

.agenda-card-actions .btn {
  padding: 8px 16px;
  font-size: 12px;
  border-radius: 20px;
  min-width: 70px;
}

/* Responsive Breakpoints */
@media (max-width: 768px) {
  /* Hide desktop table, show mobile cards */
  .desktop-table {
    display: none;
  }
  
  .mobile-cards {
    display: block;
  }

  /* Filter Tabs Mobile */
  .filter-tabs {
    justify-content: space-between;
    gap: 6px;
    margin-bottom: 15px;
    padding: 0 5px;
  }

  .tab {
    flex: 1;
    padding: 10px 8px;
    font-size: 12px;
    border-radius: 18px;
    min-width: 0;
    max-width: none;
    text-align: center;
  }

  .tab:hover {
    transform: none;
  }

  /* Search Box Mobile */
  .search-container {
    margin-bottom: 15px;
    padding: 0 5px;
  }

  .search-box {
    width: 100%;
    max-width: none;
    padding: 12px 16px 12px 40px;
    font-size: 14px;
    border-radius: 20px;
  }

  .search-icon {
    left: 12px;
    font-size: 14px;
  }

  .search-clear {
    right: 12px;
    font-size: 16px;
  }

  /* Card Layout Adjustments */
  .agenda-card {
    margin: 0 5px 12px 5px;
    padding: 14px;
  }

  .agenda-card-details {
    grid-template-columns: 1fr;
    gap: 6px;
  }

  .agenda-card-actions {
    justify-content: center;
    gap: 6px;
  }

  .agenda-card-actions .btn {
    flex: 1;
    max-width: 80px;
  }
}

@media (max-width: 480px) {
  /* Ultra Mobile Optimizations */
  .filter-tabs {
    gap: 4px;
    padding: 0;
  }

  .tab {
    padding: 8px 6px;
    font-size: 11px;
    border-width: 1px;
  }

  .agenda-card {
    margin: 0 0 10px 0;
    padding: 12px;
    border-radius: 8px;
  }

  .agenda-card-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }

  .agenda-card-date {
    align-self: flex-start;
  }

  .agenda-card-time {
    align-self: flex-end;
    margin-top: -24px;
  }

  .agenda-card-title {
    font-size: 15px;
    margin-bottom: 10px;
  }

  .agenda-card-actions .btn {
    padding: 6px 12px;
    font-size: 11px;
    min-width: 60px;
  }

  /* Search Stats */
  .search-stats {
    text-align: center;
    font-size: 11px;
    margin-top: 8px;
  }
}

/* No Results Mobile */
.no-results-mobile {
  text-align: center;
  padding: 40px 20px;
  color: #666;
  background: #f8f9fa;
  border-radius: 12px;
  margin: 10px 5px;
}

.no-results-mobile-icon {
  font-size: 48px;
  margin-bottom: 10px;
  opacity: 0.5;
}

/* Loading State for Mobile Cards */
.mobile-cards.loading {
  opacity: 0.6;
  pointer-events: none;
}

.mobile-cards.loading::after {
  content: 'Memuat data...';
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(255, 255, 255, 0.95);
  padding: 20px 30px;
  border-radius: 12px;
  font-weight: 500;
  color: #666;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
  z-index: 1000;
}

/* Highlight for Mobile Cards */
.agenda-card .highlight {
  background-color: #ffeb3b;
  padding: 2px 4px;
  border-radius: 3px;
  font-weight: 600;
}

/* Touch Improvements */
@media (max-width: 768px) {
  .tab,
  .btn,
  .search-box {
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .agenda-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .agenda-card:active {
    transform: scale(0.98);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  }
}

/* Animation for Card Appearance */
.agenda-card {
  animation: slideInUp 0.3s ease-out;
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Stagger animation for multiple cards */
.agenda-card:nth-child(1) { animation-delay: 0.1s; }
.agenda-card:nth-child(2) { animation-delay: 0.2s; }
.agenda-card:nth-child(3) { animation-delay: 0.3s; }
.agenda-card:nth-child(4) { animation-delay: 0.4s; }
.agenda-card:nth-child(5) { animation-delay: 0.5s; }
/* ===== COMPREHENSIVE MOBILE TEXT OVERFLOW FIXES ===== */

/* Ensure all containers respect viewport width */
* {
  box-sizing: border-box;
  max-width: 100%;
}

/* Main container fixes */
.main-content {
  overflow-x: hidden;
  width: 100%;
}

.card {
  overflow-x: hidden;
  width: 100%;
}

/* Filter tabs - prevent overflow */
.filter-tabs {
  display: flex;
  gap: 8px;
  margin-bottom: 20px;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  padding: 0 10px;
  overflow-x: hidden;
  width: 100%;
}

.tab {
  padding: 12px 20px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 25px;
  background: rgba(255, 255, 255, 0.1);
  color: #000;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
  font-size: 14px;
  white-space: nowrap;
  text-align: center;
  backdrop-filter: blur(10px);
  min-width: fit-content;
  max-width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Mobile Card Layout - Text Overflow Fixes */
.agenda-card {
  background: #fff;
  border-radius: 12px;
  padding: 16px;
  margin-bottom: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  border-left: 4px solid #667eea;
  position: relative;
  overflow: hidden;
  width: 100%;
  word-wrap: break-word;
  hyphens: auto;
}

.agenda-card-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 12px;
  gap: 8px;
  flex-wrap: wrap;
}

.agenda-card-date {
  background: #667eea;
  color: white;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 60%;
  flex-shrink: 0;
}

.agenda-card-time {
  background: rgba(102, 126, 234, 0.1);
  color: #667eea;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 11px;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 35%;
  flex-shrink: 0;
}

.agenda-card-title {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
  line-height: 1.4;
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
  /* Limit to 3 lines with ellipsis */
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.agenda-card-details {
  display: grid;
  grid-template-columns: 1fr;
  gap: 8px;
  margin-bottom: 12px;
}

.agenda-card-detail {
  display: flex;
  align-items: flex-start;
  gap: 6px;
  font-size: 13px;
  color: #666;
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
}

.agenda-card-detail-icon {
  font-size: 14px;
  width: 16px;
  text-align: center;
  flex-shrink: 0;
  margin-top: 2px;
}

.agenda-card-detail span:last-child {
  flex: 1;
  min-width: 0;
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
  /* Limit to 2 lines */
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.agenda-card-actions {
  display: flex;
  gap: 8px;
  justify-content: flex-end;
  flex-wrap: wrap;
}

.agenda-card-actions .btn {
  padding: 8px 16px;
  font-size: 12px;
  border-radius: 20px;
  min-width: 70px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100px;
}

/* Search container fixes */
.search-container {
  margin-bottom: 15px;
  padding: 0 5px;
  overflow: hidden;
  width: 100%;
}

.search-box {
  width: 100%;
  max-width: none;
  padding: 12px 16px 12px 40px;
  font-size: 14px;
  border-radius: 20px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.search-stats {
  text-align: center;
  font-size: 11px;
  margin-top: 8px;
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
}

/* No results mobile */
.no-results-mobile {
  text-align: center;
  padding: 40px 20px;
  color: #666;
  background: #f8f9fa;
  border-radius: 12px;
  margin: 10px 5px;
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
}

/* Responsive breakpoints with text fixes */
@media (max-width: 768px) {
  /* Hide desktop table, show mobile cards */
  .desktop-table {
    display: none;
  }
  
  .mobile-cards {
    display: block;
    overflow: hidden;
    width: 100%;
  }

  /* Filter Tabs Mobile */
  .filter-tabs {
    justify-content: space-between;
    gap: 6px;
    margin-bottom: 15px;
    padding: 0 5px;
    overflow-x: hidden;
  }

  .tab {
    flex: 1;
    padding: 10px 8px;
    font-size: 12px;
    border-radius: 18px;
    min-width: 0;
    max-width: none;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .tab:hover {
    transform: none;
  }

  /* Card Layout Adjustments */
  .agenda-card {
    margin: 0 5px 12px 5px;
    padding: 14px;
    max-width: calc(100vw - 10px);
  }

  .agenda-card-title {
    font-size: 15px;
    -webkit-line-clamp: 2;
  }

  .agenda-card-actions {
    justify-content: center;
    gap: 6px;
  }

  .agenda-card-actions .btn {
    flex: 1;
    max-width: 80px;
    font-size: 11px;
    padding: 6px 8px;
  }
}

@media (max-width: 480px) {
  /* Ultra Mobile Optimizations */
  .filter-tabs {
    gap: 4px;
    padding: 0;
    overflow-x: hidden;
  }

  .tab {
    padding: 8px 6px;
    font-size: 11px;
    border-width: 1px;
    min-width: 0;
    flex: 1;
  }

  .agenda-card {
    margin: 0 0 10px 0;
    padding: 12px;
    border-radius: 8px;
    max-width: 100vw;
  }

  .agenda-card-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }

  .agenda-card-date {
    align-self: flex-start;
    max-width: 80%;
    font-size: 11px;
  }

  .agenda-card-time {
    align-self: flex-end;
    margin-top: -24px;
    max-width: 60%;
    font-size: 10px;
  }

  .agenda-card-title {
    font-size: 14px;
    margin-bottom: 10px;
    -webkit-line-clamp: 2;
  }

  .agenda-card-detail {
    font-size: 12px;
  }

  .agenda-card-detail span:last-child {
    -webkit-line-clamp: 1;
    font-size: 11px;
  }

  .agenda-card-actions .btn {
    padding: 6px 8px;
    font-size: 10px;
    min-width: 50px;
    max-width: 70px;
  }

  /* Search Stats */
  .search-stats {
    text-align: center;
    font-size: 10px;
    margin-top: 8px;
  }
}

@media (max-width: 360px) {
  /* Extra small devices */
  .agenda-card {
    padding: 10px;
    margin: 0 0 8px 0;
  }

  .agenda-card-title {
    font-size: 13px;
    -webkit-line-clamp: 2;
  }

  .agenda-card-detail {
    font-size: 11px;
  }

  .agenda-card-detail span:last-child {
    font-size: 10px;
  }

  .agenda-card-actions .btn {
    padding: 4px 6px;
    font-size: 9px;
    min-width: 45px;
    max-width: 60px;
  }

  .tab {
    padding: 6px 4px;
    font-size: 10px;
  }
}

/* Highlight text fixes */
.agenda-card .highlight {
  background-color: #ffeb3b;
  padding: 2px 4px;
  border-radius: 3px;
  font-weight: 600;
  word-wrap: break-word;
  overflow-wrap: break-word;
}

/* Touch improvements with overflow fixes */
@media (max-width: 768px) {
  .tab,
  .btn,
  .search-box {
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .agenda-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .agenda-card:active {
    transform: scale(0.98);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  }
}

/* Prevent horizontal scroll on body */
body {
  overflow-x: hidden;
  width: 100%;
}

html {
  overflow-x: hidden;
  width: 100%;
}

/* Additional container fixes */
.content-section {
  overflow-x: hidden;
  width: 100%;
}

/* Form fixes for mobile */
@media (max-width: 480px) {
  .form-group input,
  .form-group textarea {
    padding: 15px;
    font-size: 16px;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .form-group label {
    font-size: 14px;
    margin-bottom: 8px;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }
}

/* Toast fixes */
@media (max-width: 480px) {
  .toast {
    min-width: 280px;
    max-width: calc(100vw - 20px);
    margin: 0 10px;
    font-size: 14px;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .toast-message {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
  }
}

/* Utility classes for text control */
.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.text-break {
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
}

.text-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.text-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.text-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
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
    <!-- Stats Cards -->
    <div class="stats-grid">
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
     
      
    <!-- Charts Grid -->
    <div class="dashboard-grid">
    <!-- Busy Days Analysis -->
    <div class="card">
    <h2>Analisa Hari Tersibuk</h2>
    <div class="chart-filters">
    <select id="monthFilter" onchange="updateChart()">
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
    <select id="chartType" onchange="updateChart()">
    <option value="bar">Bar Chart</option>
    <option value="line">Line Chart</option>
    <option value="doughnut">Doughnut Chart</option>
    </select>
    </div>
    <div class="chart-container">
    <canvas id="busyDaysChart"></canvas>
    </div>
    </div>
    

    </div>
    
    <!-- PIC Analysis -->
    <div class="card">
    <h2>Analisa Beban Kerja PIC</h2>
    <div class="chart-filters">
    <select id="picPeriod" onchange="updatePICAnalysis()">
    <option value="month">Bulan Ini</option>
    <option value="quarter">Quarter Ini</option>
    <option value="year">Tahun Ini</option>
    </select>
    </div>
    <div class="pic-analysis-grid">
    <div class="chart-container">
    <canvas id="picWorkloadChart"></canvas>
    </div>
    <div class="chart-container">
    <canvas id="picEfficiencyChart"></canvas>
    </div>
    </div>
    </div>
    
    <!-- Location Analysis -->
    <div class="card">
    <h2>Analisa Utilitas Tempat</h2>
    <div class="chart-filters">
    <button class="tab active" onclick="switchLocationView('usage')">Penggunaan Ruang</button>
    <button class="tab" onclick="switchLocationView('efficiency')">Efisiensi Ruang</button>
    <button class="tab" onclick="switchLocationView('peak')">Peak Hours</button>
    </div>
    <div class="chart-container">
    <canvas id="locationChart"></canvas>
    </div>
    </div>
    
 
    </div>

<!-- Update the kelola section in your HTML -->
<div id="kelola" class="content-section">
  <div class="card">
    <h2>Kelola Agenda</h2>

    <div class="filter-tabs">
      <div class="tab active" onclick="filterAgenda('all')">Semua</div>
      <div class="tab" onclick="filterAgenda('today')">Hari Ini</div>
      <div class="tab" onclick="filterAgenda('week')">Mendatang</div>
    </div>
    
    <div class="search-container">
      <span class="search-icon">🔍</span>
      <input type="text" class="search-box" id="searchInput" placeholder="Cari agenda, PIC, atau tempat...">
      <button class="search-clear" id="searchClear" onclick="clearSearch()">×</button>
      <div class="search-stats" id="searchStats"></div>
    </div>

    <!-- Desktop Table Layout -->
    <div class="table-container desktop-table">
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

    <!-- Mobile Card Layout -->
    <div class="mobile-cards" id="mobile-cards-container">
      <!-- Cards will be dynamically generated here -->
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
// ===== GLOBAL VARIABLES =====
const API = '/agenda';
let busyDaysChart = null;
let picWorkloadChart = null;
let picEfficiencyChart = null;
let locationChart = null;
let chartData = [];
let searchQuery = '';
let allAgendaData = [];
let currentFilter = 'all';

// ===== UTILITY FUNCTIONS =====
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func.apply(this, args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

function isMobileView() {
  return window.innerWidth <= 768;
}

function truncateText(text, maxLength) {
  if (!text) return '';
  
  const screenWidth = window.innerWidth;
  let adjustedMaxLength = maxLength;
  
  if (screenWidth <= 360) {
    adjustedMaxLength = Math.floor(maxLength * 0.6);
  } else if (screenWidth <= 480) {
    adjustedMaxLength = Math.floor(maxLength * 0.7);
  } else if (screenWidth <= 768) {
    adjustedMaxLength = Math.floor(maxLength * 0.8);
  }
  
  if (text.length <= adjustedMaxLength) return text;
  return text.substring(0, adjustedMaxLength) + '...';
}

function escapeRegExp(string) {
  return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

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

function convertToISODate(dateString) {
  if (dateString.match(/^\d{4}-\d{2}-\d{2}$/)) {
    return dateString;
  }

  const parts = dateString.split('-');
  if (parts.length !== 3) return null;

  const [day, month, year] = parts;
  const monthMap = {
    'Januari': '01', 'Februari': '02', 'Maret': '03', 'April': '04',
    'Mei': '05', 'Juni': '06', 'Juli': '07', 'Agustus': '08',
    'September': '09', 'Oktober': '10', 'November': '11', 'Desember': '12'
  };

  if (!monthMap[month]) return null;
  return `${year}-${monthMap[month]}-${day.padStart(2, '0')}`;
}

function toYMD(tglIndo) {
  const [d, b, y] = tglIndo.split("-");
  const bulan = {
    Januari: "01", Februari: "02", Maret: "03", April: "04",
    Mei: "05", Juni: "06", Juli: "07", Agustus: "08",
    September: "09", Oktober: "10", November: "11", Desember: "12"
  };
  return `${y}-${bulan[b]}-${d.padStart(2, '0')}`;
}

// ===== TOAST NOTIFICATION SYSTEM =====
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
  setTimeout(() => toast.classList.add('show'), 100);
  setTimeout(() => closeToast(toast), 4000);
}

function closeToast(element) {
  const toast = element.closest ? element.closest('.toast') : element;
  toast.classList.remove('show');
  setTimeout(() => toast.remove(), 300);
}

// ===== LOADING STATE HELPERS =====
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
  const mobileContainer = document.getElementById('mobile-cards-container');
  
  if (isLoading) {
    table.classList.add('table-loading');
    if (mobileContainer) {
      mobileContainer.classList.add('loading');
    }
  } else {
    table.classList.remove('table-loading');
    if (mobileContainer) {
      mobileContainer.classList.remove('loading');
    }
  }
}

// ===== SEARCH FUNCTIONALITY =====
function initSearch() {
  const searchInput = document.getElementById('searchInput');
  const searchClear = document.getElementById('searchClear');

  if (!searchInput || !searchClear) {
    console.error('Search elements not found');
    return;
  }

  searchInput.removeEventListener('input', handleSearchInput);
  searchInput.removeEventListener('keydown', handleSearchKeydown);
  searchInput.addEventListener('input', handleSearchInput);
  searchInput.addEventListener('keydown', handleSearchKeydown);
  searchClear.style.display = 'none';
}

const handleSearchInput = debounce(function(event) {
  searchQuery = event.target.value.toLowerCase().trim();
  const searchClear = document.getElementById('searchClear');

  if (searchQuery.length > 0) {
    searchClear.style.display = 'block';
  } else {
    searchClear.style.display = 'none';
  }

  displayFilteredAgenda();
}, 300);

function handleSearchKeydown(e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    if (isMobileView()) {
      e.target.blur();
    }
  }
}

function clearSearch() {
  const searchInput = document.getElementById('searchInput');
  const searchClear = document.getElementById('searchClear');
  const searchStats = document.getElementById('searchStats');

  if (searchInput) searchInput.value = '';
  if (searchClear) searchClear.style.display = 'none';
  if (searchStats) searchStats.textContent = '';

  searchQuery = '';
  displayFilteredAgenda();
}

function searchAgenda(data, query) {
  if (!query || query.length === 0) return data;

  return data.filter(item => {
    const searchableFields = [
      item.kegiatan || '',
      item.pic || '',
      item.tempat || '',
      item.tanggal || '',
      item.jam || ''
    ];

    const searchableText = searchableFields.join(' ').toLowerCase();
    const queryWords = query.split(' ').filter(word => word.length > 0);
    
    return queryWords.every(word => searchableText.includes(word));
  });
}

function highlightText(text, query) {
  if (!query || !text || query.length === 0) return text;

  const queryWords = query.split(' ').filter(word => word.length > 0);
  let highlightedText = text;

  queryWords.forEach(word => {
    const regex = new RegExp(`(${escapeRegExp(word)})`, 'gi');
    highlightedText = highlightedText.replace(regex, '<span class="highlight">$1</span>');
  });

  return highlightedText;
}

// ===== FILTER FUNCTIONALITY =====
function filterAgenda(type) {
  currentFilter = type;
  
  document.querySelectorAll('.filter-tabs .tab').forEach(tab => {
    tab.classList.remove('active');
  });
  
  const clickedTab = event.target;
  clickedTab.classList.add('active');
  
  if ('vibrate' in navigator && isMobileView()) {
    navigator.vibrate(50);
  }
  
  displayFilteredAgenda();
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

// ===== DISPLAY FUNCTIONS =====
function displayFilteredAgenda() {
  const tbody = document.querySelector("#agenda-table tbody");
  const mobileContainer = document.getElementById('mobile-cards-container');
  const searchStats = document.getElementById('searchStats');

  if (!tbody) {
    console.error('Table body not found');
    return;
  }

  let filteredData = filterAgendaData(allAgendaData);
  
  if (searchQuery && searchQuery.length > 0) {
    filteredData = searchAgenda(filteredData, searchQuery);
  }

  tbody.innerHTML = "";
  if (mobileContainer) {
    mobileContainer.innerHTML = "";
  }

  if (filteredData.length === 0) {
    displayNoResults(tbody, mobileContainer);
    updateSearchStats(searchStats, 0, allAgendaData.length);
    return;
  }

  displayDesktopTable(tbody, filteredData, searchQuery);
  displayMobileCards(mobileContainer, filteredData, searchQuery);
  updateSearchStats(searchStats, filteredData.length, allAgendaData.length);
}

function displayNoResults(tbody, mobileContainer) {
  const noResultsMessage = searchQuery ? 
    `Tidak ditemukan agenda yang sesuai dengan "${searchQuery}"` : 
    'Tidak ada agenda untuk filter yang dipilih';

  tbody.innerHTML = `
    <tr>
      <td colspan="6" class="no-results">
        <div class="no-results-icon">😔</div>
        <div>${noResultsMessage}</div>
      </td>
    </tr>
  `;
  
  if (mobileContainer) {
    mobileContainer.innerHTML = `
      <div class="no-results-mobile">
        <div class="no-results-mobile-icon">😔</div>
        <div>${noResultsMessage}</div>
      </div>
    `;
  }
}

function displayDesktopTable(tbody, filteredData, searchQuery) {
  filteredData.forEach(row => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td title="${row.tanggal}">${highlightText(row.tanggal, searchQuery)}</td>
      <td title="${row.jam}">${highlightText(row.jam, searchQuery)}</td>
      <td title="${row.kegiatan}">${highlightText(row.kegiatan, searchQuery)}</td>
      <td title="${row.pic || 'Tidak ada PIC'}">${highlightText(row.pic || 'Tidak ada PIC', searchQuery)}</td>
      <td title="${row.tempat || 'Tidak ada lokasi'}">${highlightText(row.tempat || 'Tidak ada lokasi', searchQuery)}</td>
      <td>
        <button onclick='edit(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn btn-warning">Edit</button>
        <button onclick='hapus(${row.id})' class="btn btn-danger">Hapus</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function displayMobileCards(mobileContainer, filteredData, searchQuery) {
  if (!mobileContainer) return;
  
  filteredData.forEach((row, index) => {
    const card = createResponsiveAgendaCard(row, index, searchQuery);
    mobileContainer.appendChild(card);
  });
}

function createResponsiveAgendaCard(row, index, searchQuery) {
  const card = document.createElement("div");
  card.className = "agenda-card";
  card.style.animationDelay = `${index * 0.1}s`;
  
  const titleMaxLength = window.innerWidth <= 480 ? 50 : 80;
  const detailMaxLength = window.innerWidth <= 480 ? 25 : 40;
  
  const truncatedTitle = truncateText(row.kegiatan, titleMaxLength);
  const truncatedPIC = truncateText(row.pic || 'Tidak ada PIC', detailMaxLength);
  const truncatedTempat = truncateText(row.tempat || 'Tidak ada lokasi', detailMaxLength);
  const truncatedTanggal = truncateText(row.tanggal, 15);
  const truncatedJam = truncateText(row.jam, 12);
  
  card.innerHTML = `
    <div class="agenda-card-header">
      <div class="agenda-card-date" title="${row.tanggal}">
        ${highlightText(truncatedTanggal, searchQuery)}
      </div>
      <div class="agenda-card-time" title="${row.jam}">
        ${highlightText(truncatedJam, searchQuery)}
      </div>
    </div>
    
    <div class="agenda-card-title" title="${row.kegiatan}">
      ${highlightText(truncatedTitle, searchQuery)}
    </div>
    
    <div class="agenda-card-details">
      <div class="agenda-card-detail">
        <span class="agenda-card-detail-icon">👤</span>
        <span title="${row.pic || 'Tidak ada PIC'}">${highlightText(truncatedPIC, searchQuery)}</span>
      </div>
      <div class="agenda-card-detail">
        <span class="agenda-card-detail-icon">📍</span>
        <span title="${row.tempat || 'Tidak ada lokasi'}">${highlightText(truncatedTempat, searchQuery)}</span>
      </div>
    </div>
    
    <div class="agenda-card-actions">
      <button onclick='edit(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn btn-warning" title="Edit agenda">Edit</button>
      <button onclick='hapus(${row.id})' class="btn btn-danger" title="Hapus agenda">Hapus</button>
    </div>
  `;
  
  return card;
}

function updateSearchStats(searchStats, totalResults, totalData) {
  if (!searchStats) return;

  if (searchQuery && searchQuery.length > 0) {
    const statsText = `Menampilkan ${totalResults} dari ${totalData} agenda`;
    searchStats.textContent = window.innerWidth <= 480 ? 
      `${totalResults}/${totalData} agenda` : statsText;
  } else {
    searchStats.textContent = '';
  }
}

// ===== API FUNCTIONS =====
function loadAgenda() {
  setTableLoading('agenda-table', true);

  fetch(API)
    .then(res => {
      if (!res.ok) {
        throw new Error(`HTTP error! status: ${res.status}`);
      }
      return res.json();
    })
    .then(data => {
      allAgendaData = data || [];
      displayFilteredAgenda();
    })
    .catch(error => {
      console.error('Error loading agenda:', error);
      showToast("Gagal memuat data agenda!", "error");
      allAgendaData = [];
      displayFilteredAgenda();
    })
    .finally(() => {
      setTableLoading('agenda-table', false);
    });
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

      chartData = data;
      createBusyDaysChart(data);
      createPICAnalysis(data);
      createLocationChart(data);
    })
    .catch(() => {
      showToast("Gagal memuat statistik!", "error");
    });
}

function submitTambah(e) {
  e.preventDefault();
  const submitBtn = e.target.querySelector('button[type="submit"]');
  setButtonLoading(submitBtn, true, 'Menambahkan...');

  const formData = new FormData();
  const jamMulai = document.getElementById("JamMulai").value;
  const jamSelesai = document.getElementById("JamSelesai").value;
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

function cancelEdit() {
  document.getElementById("editForm").classList.add("hidden");
}

function hapus(id) {
  if (confirm("Yakin ingin menghapus agenda ini?")) {
    const deleteBtn = event.target;
    setButtonLoading(deleteBtn, true, 'Menghapus...');

    fetch(`${API}/${id}`, {
        method: 'DELETE'
      })
      .then(res => {
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        showToast("Agenda berhasil dihapus!", "success");
        loadAgenda();
        loadDashboardStats();
      })
      .catch(error => {
        console.error('Error deleting agenda:', error);
        showToast("Gagal menghapus agenda!", "error");
      })
      .finally(() => {
        setButtonLoading(deleteBtn, false);
      });
  }
}

// ===== CHART FUNCTIONS =====
function analyzeBusyDays(data) {
  const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const dayCounts = [0, 0, 0, 0, 0, 0, 0];
  const monthFilter = document.getElementById('monthFilter').value;
  
  data.forEach(item => {
    const date = new Date(convertToISODate(item.tanggal));
    const month = date.getMonth() + 1;
    
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

function getMonthName() {
  const monthFilter = document.getElementById('monthFilter').value;
  if (monthFilter === 'all') return '(Semua Bulan)';
  
  const months = [
    '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  
  return `(${months[parseInt(monthFilter)]})`;
}

function createBusyDaysChart(data) {
  const ctx = document.getElementById('busyDaysChart').getContext('2d');
  const chartType = document.getElementById('chartType').value;
  
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

function updateChart() {
  if (chartData.length > 0) {
    createBusyDaysChart(chartData);
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

// ===== NAVIGATION FUNCTIONS =====
function showSection(id) {
  document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
  if (event && event.target) {
    event.target.classList.add('active');
  }

  document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
  document.getElementById(id).classList.add('active');

  if (isMobileView()) {
    closeSidebar();
    smoothScrollToTop();
  }

  if (id === 'kelola') {
    loadAgenda();
    setTimeout(() => {
      initSearch();
    }, 100);
  }
  
  if (id === 'dashboard') {
    loadDashboardStats();
    if (chartData.length > 0) {
      setTimeout(() => updateChart(), 100);
    }
  }
}

function smoothScrollToTop() {
  if (isMobileView()) {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }
}

// ===== SIDEBAR FUNCTIONS =====
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

// ===== MOBILE OPTIMIZATIONS =====
function initMobileTouchInteractions() {
  if (!('ontouchstart' in window)) return;
  
  let startX = 0;
  let startY = 0;
  
  document.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
    startY = e.touches[0].clientY;
    
    if (e.target.closest('.agenda-card')) {
      e.target.closest('.agenda-card').style.transform = 'scale(0.98)';
    }
  }, { passive: true });

  document.addEventListener('touchmove', (e) => {
    const currentX = e.touches[0].clientX;
    const currentY = e.touches[0].clientY;
    const diffX = Math.abs(currentX - startX);
    const diffY = Math.abs(currentY - startY);
    
    if (diffX > diffY && diffX > 10) {
      e.preventDefault();
    }
  }, { passive: false });

  document.addEventListener('touchend', (e) => {
    if (e.target.closest('.agenda-card')) {
      setTimeout(() => {
        const card = e.target.closest('.agenda-card');
        if (card) {
          card.style.transform = '';
        }
      }, 150);
    }
  }, { passive: true });
}

function handleSwipe() {
  const sidebar = document.getElementById('sidebar');
  const swipeThreshold = 50;
  let touchStartX = 0;
  let touchEndX = 0;

  if (touchEndX < touchStartX - swipeThreshold && sidebar.classList.contains('active')) {
    closeSidebar();
  }
}

// ===== EVENT LISTENERS =====
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(() => {
    initSearch();
    initMobileTouchInteractions();
  }, 100);
});

document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth <= 1024) {
      closeSidebar();
    }
  });
});

window.addEventListener('resize', () => {
  if (window.innerWidth > 1024) {
    closeSidebar();
  }
  
  if (allAgendaData.length > 0) {
    displayFilteredAgenda();
  }
});

let touchStartX = 0;
let touchEndX = 0;

document.addEventListener('touchstart', (e) => {
  touchStartX = e.changedTouches[0].screenX;
});

document.addEventListener('touchend', (e) => {
  touchEndX = e.changedTouches[0].screenX;
  handleSwipe();
});

// ===== INITIALIZATION =====
loadDashboardStats();
initSearch();
</script>

</body>

</html>