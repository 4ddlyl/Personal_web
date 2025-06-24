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
  <title>Kelola Artikel</title>
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
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    .glass-sidebar {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
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

    .glow-row:hover {
      transform: scale(1.02);
      box-shadow: 0 0 15px rgba(168, 85, 247, 0.5);
      z-index: 10;
      position: relative;
      transition: all 0.3s ease;
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
      width: 26px;
      height: 3.5px;
      background: white;
      margin: 5px 0;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(5px, -5px);
    }
  </style>
</head>

<body class="text-white font-sans min-h-screen relative">

  <!-- Header -->
  <header class="text-white text-center py-6 shadow-lg flex justify-between items-center px-4 md:px-10">
    <h1 class="text-2xl md:text-3xl font-bold">// KELOLA ARTIKEL //</h1>
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
    <main class="w-full md:w-3/4 glass p-6 mt-6 md:mt-0 md:ml-6 overflow-auto">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white">Daftar Artikel</h2>
        <a href="add_artikel.php"
          class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800 transition transform hover:scale-105 duration-200 shadow-lg shadow-purple-500/30">
          + Tambah Artikel
        </a>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto">
        <div class="glass rounded-lg overflow-hidden">
          <table class="min-w-full table-auto text-sm text-white">
            <thead class="bg-white bg-opacity-10 backdrop-blur-md">
              <tr>
                <th class="p-3 border border-white/20">No</th>
                <th class="p-3 border border-white/20">Nama Artikel</th>
                <th class="p-3 border border-white/20">Isi Artikel</th>
                <th class="p-3 border border-white/20">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM tbl_artikel";
              $query = mysqli_query($db, $sql);
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
                echo "<tr class='hover:bg-white/10 transition glow-row'>";
                echo "<td class='border border-white/20 p-2 text-center'>" . $no++ . "</td>";
                echo "<td class='border border-white/20 p-2'>" . htmlspecialchars($data['nama_artikel']) . "</td>";
                echo "<td class='border border-white/20 p-2'>" . htmlspecialchars($data['isi_artikel']) . "</td>";
                echo "<td class='border border-white/20 p-2 text-center space-x-2'>
                  <a href='edit_artikel.php?id_artikel={$data['id_artikel']}' class='text-blue-400 hover:underline'>Edit</a>
                  <a href='delete_artikel.php?id_artikel={$data['id_artikel']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-400 hover:underline'>Hapus</a>
                </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="glass-sidebar text-white text-center py-4 mt-10 max-w-7xl mx-auto">
    &copy; <?php echo date('Y'); ?> | Created by Addlyl
  </footer>

  <!-- Sidebar Toggle -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const hamburger = document.querySelector(".hamburger");
      sidebar.classList.toggle("show");
      hamburger.classList.toggle("active");
    }
  </script>

</body>

</html>
