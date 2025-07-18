<?php

/** @var CodeIgniter\View\View $this */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin AKITA</title>
  <style>
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
  </style>
</head>

<body>
  <div class="sidebar">
    <h2>Admin AKITA</h2>
    <a href="#" onclick="showSection('dashboard')" class="nav-link active">📊 Dashboard</a>
    <a href="#" onclick="showSection('kelola')" class="nav-link">📋 Kelola Agenda</a>
    <a href="#" onclick="showSection('tambah')" class="nav-link">➕ Tambah Agenda</a>
    <a href="/auth/logout" style="margin-top: 20px; background: rgba(220, 53, 69, 0.2); border-color: rgba(220, 53, 69, 0.3);">🚪 Logout</a>
  </div>

  <div class="main-content">
    <div class="header">
      <h1>Agenda Kita</h1>
      <p>Sistem Manajemen Agenda Kantor</p>
    </div>

    <div id="dashboard" class="content-section active">
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
              <input type="time" id="JamSelesai" required>
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
    const API = '/agenda';
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
      if (id === 'dashboard') loadDashboardStats();
    }

    function loadAgenda() {
      fetch(API)
        .then(res => res.json())
        .then(data => {
          const tbody = document.querySelector("#agenda-table tbody");
          tbody.innerHTML = "";

          let filteredData = filterAgendaData(data);

          filteredData.forEach(row => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
              <td>${row.tanggal}</td>
              <td>${row.jam}</td>
              <td>${row.kegiatan}</td>
              <td>${row.pic ?? ''}</td>
              <td>${row.tempat ?? ''}</td>
              <td>
                <button onclick='edit(${JSON.stringify(row)})' class="btn btn-warning">Edit</button>
                <button onclick='hapus(${row.id})' class="btn btn-danger">Hapus</button>
              </td>
            `;
            tbody.appendChild(tr);
          });
        });
    }

    function filterAgenda(type) {
      currentFilter = type;
      document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
      event.target.classList.add('active');
      loadAgenda();
    }

    function filterAgendaData(data) {
    const today = getTodayDate();
    const weekFromNow = getWeekFromNow();
    
    switch(currentFilter) {
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
            
            console.log('Today:', today); // Debug
            console.log('Data sample:', data[0]); // Debug
            
            const todayAgenda = data.filter(item => {
                const itemDate = convertToISODate(item.tanggal);
                console.log('Item date:', itemDate, 'Today:', today, 'Match:', itemDate === today); // Debug
                return itemDate === today;
            });
            
            const weekAgenda = data.filter(item => {
                const itemDate = convertToISODate(item.tanggal);
                return itemDate >= today && itemDate <= weekFromNow;
            });
            
            document.getElementById('total-agenda').textContent = data.length;
            document.getElementById('agenda-hari-ini').textContent = todayAgenda.length;
            document.getElementById('agenda-minggu').textContent = weekAgenda.length;
            
            console.log('Stats:', {
                total: data.length,
                today: todayAgenda.length,
                week: weekAgenda.length
            }); // Debug
        })
        .catch(error => {
            console.error('Error loading dashboard stats:', error);
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
          alert("Agenda berhasil diupdate!");
          cancelEdit();
          loadAgenda();
        });
    }

    function hapus(id) {
      if (confirm("Yakin ingin menghapus agenda ini?")) {
        fetch(`${API}/${id}`, {
            method: 'DELETE'
          })
          .then(() => {
            alert("Agenda berhasil dihapus!");
            loadAgenda();
            loadDashboardStats();
          });
      }
    }

    function submitTambah(e) {
      e.preventDefault();
      const formData = new FormData();
      const jam = `${document.getElementById("JamMulai").value} - ${document.getElementById("JamSelesai").value}`;
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
          alert("Agenda berhasil ditambahkan!");
          e.target.reset();
          loadDashboardStats();
        });
    }

    // Initialize
    loadDashboardStats();
  </script>
</body>

</html>