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
  <title>Kelola Gallery</title>
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

    .glass-footer {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 0.5rem;
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
    <h1 class="text-2xl md:text-3xl font-bold">// Kelola Gallery //</h1>
    <button onclick="toggleSidebar()" class="hamburger md:hidden focus:outline-none">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>

  <div class="flex flex-col md:flex-row max-w-7xl mx-auto mt-8 px-4">

    <!-- Sidebar -->
    <aside id="sidebar"
      class="mobile-sidebar transition-left fixed top-0 left-0 h-full w-64 md:relative md:translate-x-0 z-50 glass-sidebar p-6 md:w-1/4">
      <h2 class="text-xl font-semibold text-center mb-6">MENU</h2>
      <ul class="space-y-3">
        <li><a href="beranda_admin.php" class="sidebar-link">Beranda</a></li>
        <li><a href="data_artikel.php" class="sidebar-link">Kelola Artikel</a></li>
        <li><a href="data_gallery.php" class="sidebar-link font-bold text-purple-300">Kelola Gallery</a></li>
        <li><a href="about.php" class="sidebar-link">About</a></li>
        <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
            class="sidebar-link text-red-400 hover:underline">Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="w-full md:w-3/4 glass p-6 mt-6 md:mt-0 md:ml-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white drop-shadow-md">Daftar Gallery</h2>
        <a href="add_gallery.php"
          class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">+ Tambah Gambar</a>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php
        $sql = "SELECT * FROM tbl_gallery";
        $query = mysqli_query($db, $sql);
        while ($data = mysqli_fetch_array($query)) {
          echo "<div class='glass overflow-hidden'>";
          echo "<img src='../images/{$data['foto']}' class='w-full h-48 object-cover'>";
          echo "<div class='p-4'>";
          echo "<p class='font-semibold text-white mb-2'>" . htmlspecialchars($data['judul']) . "</p>";
          echo "<div class='flex justify-between text-sm'>";
          echo "<a href='edit_gallery.php?id_gallery={$data['id_gallery']}' class='text-blue-400 hover:underline'>Edit</a>";
          echo "<a href='delete_gallery.php?id_gallery={$data['id_gallery']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-400 hover:underline'>Hapus</a>";
          echo "</div></div></div>";
        }
        ?>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="glass-footer text-white text-center py-4 mt-10 max-w-7xl mx-auto">
    &copy; <?php echo date('Y'); ?> | Created by Addlyl
  </footer>

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
