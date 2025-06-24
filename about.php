<?php include "koneksi.php"; ?>
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>About | Addlyl</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('https://i.pinimg.com/originals/c5/3f/60/c53f60a4b9b160ffa3e79fbcbfb4e2a4.gif');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      margin: 0;
    }

    .glass {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }

    .glass:hover {
      transform: scale(1.03);
    }

    .glass-nav, .glass-footer, .glass-header {
      background: rgba(30, 30, 30, 0.3);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-top: 1px solid rgba(255, 255, 255, 0.2);
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

<body class="text-white font-sans min-h-screen">

  <!-- Header Full Width -->
  <header class="glass-header text-white p-6 flex justify-between items-center w-full">
    <div class="w-full max-w-7xl mx-auto px-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold header-title"> About | Addlyl</h1>
      <button onclick="toggleMenu()" class="md:hidden focus:outline-none hamburger" id="hamburgerBtn">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <!-- Navigation Full Width -->
  <nav class="glass-nav text-white py-3 w-full">
    <div class="w-full max-w-7xl mx-auto px-6">
      <ul class="hidden md:flex justify-center space-x-10 font-medium text-lg">
        <li><a href="index.php" class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>">Artikel</a></li>
        <li><a href="gallery.php" class="nav-link <?= $currentPage == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
        <li><a href="about.php" class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
        <li><a href="admin/login.php" class="nav-link <?= $currentPage == 'login.php' ? 'active' : '' ?>">Login</a></li>
      </ul>

      <ul id="mobileMenu" class="mobile-menu md:hidden flex flex-col items-start pt-2 space-y-3 font-medium text-lg">
        <li><a href="index.php" class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>">Artikel</a></li>
        <li><a href="gallery.php" class="nav-link <?= $currentPage == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
        <li><a href="about.php" class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
        <li><a href="admin/login.php" class="nav-link <?= $currentPage == 'login.php' ? 'active' : '' ?>">Login</a></li>
      </ul>
    </div>
  </nav>

  <!-- About Content -->
  <main class="max-w-4xl mx-auto p-6 mt-10">
    <h2 class="text-xl font-bold mb-6 text-center text-white">Tentang Saya</h2>
    <div class="space-y-6">
      <?php
      $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC";
      $query = mysqli_query($db, $sql);
      while ($data = mysqli_fetch_array($query)) {
        echo "<div class='glass p-6 text-white text-base leading-relaxed'>";
        echo "<p>" . nl2br(htmlspecialchars($data['about'])) . "</p>";
        echo "</div>";
      }
      ?>
    </div>
  </main>

  <!-- Footer Full Width -->
  <footer class="glass-footer text-white text-center py-4 mt-10 w-full">
    <div class="w-full max-w-7xl mx-auto px-6">
      &copy; <?php echo date('Y'); ?> | Created by Addlyl
    </div>
  </footer>

  <!-- Script -->
  <script>
    function toggleMenu() {
      const menu = document.getElementById("mobileMenu");
      const burger = document.getElementById("hamburgerBtn");
      menu.classList.toggle("show");
      burger.classList.toggle("active");
    }
  </script>

</body>
</html>
