<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('https://i.pinimg.com/originals/c5/3f/60/c53f60a4b9b160ffa3e79fbcbfb4e2a4.gif');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    header {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(18px);
    }

    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 1.5rem;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
      transition: all 0.3s ease-in-out;
    }

    .glass:hover {
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.3),
        0 0 60px rgba(168, 85, 247, 0.4);
      transform: scale(1.02);
    }

    .glass-sidebar {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .sidebar-link {
      transition: all 0.3s ease;
      display: block;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
    }

    .sidebar-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      color: #a855f7;
      transform: scale(1.05);
    }

    input,
    textarea {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: #a855f7;
      box-shadow: 0 0 12px #a855f7, 0 0 6px #a855f7;
      transform: scale(1.02);
    }

    input:hover,
    textarea:hover {
      transform: scale(1.01);
      box-shadow: 0 0 8px #a855f7;
    }

    @media (max-width: 768px) {
      .mobile-sidebar {
        transform: translateX(-100%);
      }

      .mobile-sidebar.show {
        transform: translateX(0);
      }

      .transition-left {
        transition: transform 0.3s ease;
      }
    }

    .hamburger span {
      display: block;
      width: 28px;
      height: 4px;
      margin: 5px auto;
      background-color: white;
      border-radius: 4px;
      transition: all 0.4s ease-in-out;
    }

    .hamburger.active span:nth-child(1) {
      transform: translateY(9px) rotate(45deg);
    }

    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
      transform: translateY(-9px) rotate(-45deg);
    }
  </style>
</head>

<body class="text-white font-sans min-h-screen relative">

  <!-- Header -->
  <header class="text-white py-6 shadow-lg flex justify-between items-center px-4 md:px-10">
    <h1 class="text-2xl md:text-3xl font-bold">// Tambah Artikel Baru //</h1>
    <!-- Hamburger Button -->
    <button onclick="toggleSidebar()" class="hamburger md:hidden focus:outline-none">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>

  <div class="flex flex-col md:flex-row max-w-7xl mx-auto mt-8 px-4">

    <!-- Sidebar -->
    <aside id="sidebar"
      class="mobile-sidebar transition-left fixed top-0 left-0 h-full w-64 md:relative md:translate-x-0 z-50 glass-sidebar p-6 md:w-1/4 text-white">
      <h2 class="text-xl font-semibold text-center mb-6">MENU</h2>
      <ul class="space-y-3">
        <li><a href="beranda_admin.php" class="sidebar-link">Beranda</a></li>
        <li><a href="data_artikel.php" class="sidebar-link font-bold text-purple-300">Kelola Artikel</a></li>
        <li><a href="data_gallery.php" class="sidebar-link">Kelola Gallery</a></li>
        <li><a href="about.php" class="sidebar-link">About</a></li>
        <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
            class="sidebar-link text-red-400 hover:underline">Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="glass w-full md:w-3/4 p-6 mt-6 md:mt-0 md:ml-6">
      <form action="proses_add_artikel.php" method="post" class="space-y-6">

        <div>
          <label for="nama_artikel" class="block text-sm font-medium text-white mb-1">Judul Artikel</label>
          <input type="text" id="nama_artikel" name="nama_artikel" required class="w-full p-2 rounded bg-transparent">
        </div>

        <div>
          <label for="isi_artikel" class="block text-sm font-medium text-white mb-1">Isi Artikel</label>
          <textarea id="isi_artikel" name="isi_artikel" rows="5" required
            class="w-full p-2 rounded bg-transparent"></textarea>
        </div>

        <div class="flex justify-end space-x-4">
          <button type="submit"
            class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800 transition transform hover:scale-105">Simpan</button>
          <a href="data_artikel.php"
            class="bg-gray-300 text-gray-900 px-4 py-2 rounded hover:bg-gray-400 transition transform hover:scale-105">Batal</a>
        </div>
      </form>
    </main>
  </div>

  <!-- Footer -->
  <footer class="glass-sidebar text-white text-center py-4 mt-10 max-w-7xl mx-auto">
    &copy; <?php echo date('Y'); ?> | Created by Addlyl
  </footer>

  <!-- Toggle Sidebar Script -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("show");

      const btn = document.querySelector(".hamburger");
      btn.classList.toggle("active");
    }
  </script>

</body>

</html>
