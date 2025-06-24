<?php include "koneksi.php"; ?>
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Personal Web | Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('https://i.pinimg.com/originals/c5/3f/60/c53f60a4b9b160ffa3e79fbcbfb4e2a4.gif');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    .glass {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .glass-nav {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(8px);
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .glass-header {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .nav-link {
      transition: all 0.4s ease;
      display: inline-block;
      padding: 0.25rem 0;
    }

    @media (min-width: 768px) {
      .nav-link:hover:not(.active) {
        transform: scale(1.1);
        color: white;
      }
    }

    @media (max-width: 767px) {
      .nav-link:hover:not(.active) {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 0.5rem;
        color: #a855f7;
        padding: 0.5rem 1rem;
      }
    }

    .active {
      color: #a855f7;
      font-weight: 600;
    }

    .glass-footer {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(8px);
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 0.5rem;
    }

    .glass-hover {
      transition: transform 0.3s ease;
    }

    .glass-hover:hover {
      transform: scale(1.03);
    }

    .mobile-menu {
      transition: max-height 0.4s ease, opacity 0.4s ease;
      overflow: hidden;
      max-height: 0;
      opacity: 0;
    }

    .mobile-menu.show {
      max-height: 300px;
      opacity: 1;
    }

    .card-3d {
      transform-style: preserve-3d;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      will-change: transform;
    }

    .card-3d:hover {
      transform: perspective(1000px) rotateX(5deg) rotateY(5deg) scale(1.03);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
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

    .header-title {
      transition: transform 0.3s ease;
      display: inline-block;
    }

    .header-title:hover {
      transform: scale(1.05);
      color: #a855f7;
    }
  </style>
</head>

<body class="text-gray-800 font-sans min-h-screen">

  <!-- Header -->
  <header class="glass-header text-white p-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold header-title">Personal Web | Addlyl</h1>
    <button onclick="toggleMenu()" class="hamburger md:hidden focus:outline-none">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>

  <!-- Navigation -->
  <nav class="glass-nav text-white py-3">
    <ul class="hidden md:flex justify-center space-x-10 font-medium text-lg">
      <li><a href="index.php" class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>">Artikel</a></li>
      <li><a href="gallery.php" class="nav-link <?= $currentPage == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
      <li><a href="about.php" class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
      <li><a href="admin/login.php" class="nav-link <?= $currentPage == 'login.php' ? 'active' : '' ?>">Login</a></li>
    </ul>

    <ul id="mobileMenu" class="mobile-menu md:hidden flex flex-col items-start px-6 pt-2 space-y-3 font-medium text-lg">
      <li><a href="index.php" class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>">Artikel</a></li>
      <li><a href="gallery.php" class="nav-link <?= $currentPage == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
      <li><a href="about.php" class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
      <li><a href="admin/login.php" class="nav-link <?= $currentPage == 'login.php' ? 'active' : '' ?>">Login</a></li>
    </ul>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <!-- Artikel Utama -->
    <section class="md:col-span-2 space-y-6">

      <!-- Form Pencarian -->
      <div class="glass glass-hover card-3d p-4">
        <form method="GET" class="flex flex-col md:flex-row items-center gap-4">
          <input type="text" name="cari" value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>"
            class="w-full md:flex-1 p-2 rounded-lg bg-white/20 backdrop-blur-md text-white placeholder-white focus:outline-none"
            placeholder="Cari artikel berdasarkan judul atau isi...">
          <button type="submit"
            class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg text-white transition">Cari</button>
        </form>
      </div>

      <!-- Artikel Terbaru / Hasil Pencarian -->
      <div class="glass glass-hover card-3d p-6 text-white">
        <h2 class="text-xl font-bold mb-4"><?= isset($_GET['cari']) ? "Hasil Pencarian" : "Artikel Terbaru" ?></h2>
        <div class="space-y-4">
          <?php
          $search = isset($_GET['cari']) ? mysqli_real_escape_string($db, $_GET['cari']) : '';
          $sql = "SELECT * FROM tbl_artikel";
          if ($search) {
            $sql .= " WHERE nama_artikel LIKE '%$search%' OR isi_artikel LIKE '%$search%'";
          }
          $sql .= " ORDER BY id_artikel DESC";
          $query = mysqli_query($db, $sql);
          if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_array($query)) {
              echo "<div class='border-b border-white/30 pb-4'>";
              echo "<h3 class='text-lg font-semibold'>" . htmlspecialchars($data['nama_artikel']) . "</h3>";
              echo "<p>" . htmlspecialchars($data['isi_artikel']) . "</p>";
              echo "</div>";
            }
          } else {
            echo "<p>Tidak ada artikel yang ditemukan.</p>";
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Sidebar -->
    <aside class="glass glass-hover card-3d p-6 text-white">
      <h2 class="text-lg font-bold mb-4">Daftar Artikel</h2>
      <ul class="space-y-2 list-disc list-inside">
        <?php
        $querySidebar = mysqli_query($db, "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT 10");
        while ($data = mysqli_fetch_array($querySidebar)) {
          echo "<li>" . htmlspecialchars($data['nama_artikel']) . "</li>";
        }
        ?>
      </ul>
    </aside>
  </main>

  <!-- Footer -->
  <footer class="glass-footer text-white text-center py-4 mt-10 max-w-6xl mx-auto">
    &copy; <?php echo date('Y'); ?> | Created by Addlyl
  </footer>

  <!-- Script -->
  <script>
    function toggleMenu() {
      const menu = document.getElementById("mobileMenu");
      const btn = document.querySelector(".hamburger");
      menu.classList.toggle("show");
      btn.classList.toggle("active");
    }
  </script>

</body>

</html>
