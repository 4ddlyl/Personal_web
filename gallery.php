<?php include "koneksi.php"; ?>
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Gallery | Personal Web</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html, body {
      margin: 0;
      padding: 0;
    }

    body {
      background-image: url('https://i.pinimg.com/originals/c5/3f/60/c53f60a4b9b160ffa3e79fbcbfb4e2a4.gif');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
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

    input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .header-title {
      transition: transform 0.3s ease;
      display: inline-block;
    }

    .header-title:hover {
      transform: scale(1.05);
      color: #a855f7;
    }

    .img-container {
      position: relative;
      cursor: pointer;
    }

    .img-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
      text-align: center;
      padding: 0.5rem;
      opacity: 0;
      transition: opacity 0.3s ease;
      font-size: 0.875rem;
    }

    .img-container:hover .img-overlay {
      opacity: 1;
    }

    /* Modal styles */
    .modal {
      position: fixed;
      display: none;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.9);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .modal img {
      max-width: 90%;
      max-height: 80%;
      border-radius: 1rem;
    }

    .modal.show {
      display: flex;
    }

    .modal:after {
      content: "Klik di luar gambar untuk menutup";
      color: white;
      position: absolute;
      bottom: 20px;
      font-size: 0.875rem;
      text-align: center;
    }
  </style>
</head>

<body class="text-white font-sans min-h-screen">

  <!-- HEADER -->
  <header class="glass-header text-white p-6 flex justify-between items-center w-full">
    <div class="w-full max-w-7xl mx-auto px-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold header-title">Gallery | Addlyl</h1>
      <button onclick="toggleMenu()" class="md:hidden focus:outline-none hamburger" id="hamburgerBtn">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <!-- NAVIGATION -->
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

  <!-- GALLERY SECTION -->
  <main class="max-w-6xl mx-auto p-6">
    <form method="GET" class="mb-6 flex justify-center">
      <input type="text" name="search" placeholder="Cari judul gambar..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="glass px-4 py-2 w-full max-w-md text-white placeholder-white focus:outline-none transform transition-transform focus:scale-105" />
      <button type="submit" class="ml-2 bg-purple-700 hover:bg-purple-800 px-4 py-2 rounded-lg transition text-white">Cari</button>
    </form>

    <h2 class="text-xl font-bold mb-6 text-center text-white">Galeri Foto</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php
      $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
      $sql = "SELECT * FROM tbl_gallery";
      if (!empty($search)) {
        $sql .= " WHERE judul LIKE '%$search%'";
      }
      $sql .= " ORDER BY id_gallery DESC";
      $query = mysqli_query($db, $sql);
      if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_array($query)) {
          $judul = htmlspecialchars($data['judul']);
          $foto = "images/{$data['foto']}";
          echo "
          <div class='glass overflow-hidden'>
            <div class='img-container' onclick=\"openModal('$foto')\">
              <img src='$foto' class='w-full h-48 object-cover transition-transform duration-300 hover:scale-105' alt='Gambar'>
              <div class='img-overlay'>Klik gambar untuk melihat full</div>
            </div>
            <div class='p-4'>
              <h3 class='text-lg font-semibold text-white'>$judul</h3>
            </div>
          </div>";
        }
      } else {
        echo "<p class='text-center col-span-3 text-white'>Data tidak ditemukan.</p>";
      }
      ?>
    </div>
  </main>

  <!-- IMAGE MODAL -->
  <div class="modal" id="imageModal" onclick="closeModal()">
    <img id="modalImg" src="" alt="Preview Gambar">
  </div>

  <!-- FOOTER -->
  <footer class="glass-footer text-white text-center py-4 mt-10 w-full">
    <div class="w-full max-w-7xl mx-auto px-6">
      &copy; <?= date('Y'); ?> | Created by Addlyl
    </div>
  </footer>

  <!-- SCRIPT -->
  <script>
    function toggleMenu() {
      document.getElementById("mobileMenu").classList.toggle("show");
      document.getElementById("hamburgerBtn").classList.toggle("active");
    }

    function openModal(src) {
      const modal = document.getElementById("imageModal");
      const modalImg = document.getElementById("modalImg");
      modalImg.src = src;
      modal.classList.add("show");
    }

    function closeModal() {
      const modal = document.getElementById("imageModal");
      modal.classList.remove("show");
    }
  </script>

</body>
</html>
