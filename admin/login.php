<?php
session_start();
if (isset($_SESSION['username'])) {
  header('location:beranda_admin.php');
}
require_once("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Administrator</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url("https://i.pinimg.com/originals/4f/2a/69/4f2a692d9764a827a354bba114963f3f.gif");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .glow-box {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glow-box:hover {
      transform: scale(1.03);
      box-shadow: 0 0 20px 6px rgba(0, 0, 0, 0.5);
    }

    .glass-header {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .nav-link {
      transition: transform 0.3s ease, background-color 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
    }

    .nav-link:hover {
      transform: scale(1.05);
      background-color: rgba(168, 85, 247, 0.8);
    }

    .nav-title {
      transition: transform 0.3s ease, color 0.3s ease;
      cursor: pointer;
    }

    .nav-title:hover {
      transform: scale(1.05);
      color: rgb(168, 85, 247);
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

    /* Hamburger Animation */
    .hamburger {
      width: 28px;
      height: 20px;
      position: relative;
      transition: transform 0.3s ease;
    }

    .hamburger span {
      display: block;
      height: 3px;
      background: white;
      margin: 4px 0;
      border-radius: 2px;
      transition: 0.3s ease;
    }

    .hamburger.open span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger.open span:nth-child(2) {
      opacity: 0;
    }

    .hamburger.open span:nth-child(3) {
      transform: rotate(-45deg) translate(5px, -5px);
    }

    @media (min-width: 768px) {
      .mobile-menu {
        display: none;
      }

      .mobile-menu.show {
        display: flex;
        flex-direction: column;
        max-height: none;
        opacity: 1;
      }
    }
  </style>
</head>

<body class="min-h-screen bg-black/40 text-white font-sans">

  <!-- Header -->
  <header class="glass-header text-white px-6 py-4 flex justify-between items-center shadow-lg">
    <h1 class="text-2xl font-bold nav-title">Admin Login</h1>
    <button onclick="toggleMenu()" class="p-2 rounded-md hover:bg-white/20 transition focus:outline-none">
      <div id="hamburger" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </button>
  </header>

  <!-- Navigation Menu -->
  <nav class="glass-header text-white py-3 px-6">
    <ul id="mobileMenu" class="mobile-menu flex flex-col items-start space-y-3 font-medium text-lg">
      <li><a href="../index.php" class="nav-link">Artikel</a></li>
      <li><a href="../gallery.php" class="nav-link">Gallery</a></li>
      <li><a href="../about.php" class="nav-link">About</a></li>
    </ul>
  </nav>

  <!-- Login Box -->
  <div class="flex justify-center items-center py-10 px-4">
    <div class="glow-box backdrop-blur-md bg-white/20 border border-white/30 shadow-2xl rounded-xl p-8 w-full max-w-md text-white">
      <h2 class="text-3xl font-bold text-center mb-6 drop-shadow">
        Login Administrator
      </h2>

      <form action="cek_login.php" method="post" class="space-y-5">
        <div>
          <label for="username" class="block text-sm font-medium mb-1">Username</label>
          <input type="text" name="username" id="username" required
            class="w-full bg-white/30 text-white placeholder-white/70 border border-white/40 rounded-md px-4 py-2 backdrop-blur-sm
            transition-all duration-300 focus:scale-105 focus:shadow-lg focus:ring-2 focus:ring-purple-400 focus:outline-none">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium mb-1">Password</label>
          <input type="password" name="password" id="password" required
            class="w-full bg-white/30 text-white placeholder-white/70 border border-white/40 rounded-md px-4 py-2 backdrop-blur-sm
            transition-all duration-300 focus:scale-105 focus:shadow-lg focus:ring-2 focus:ring-purple-400 focus:outline-none">
        </div>

        <div class="flex justify-between items-center pt-2">
          <input type="submit" name="login" value="Login"
            class="bg-white/30 text-white px-4 py-2 rounded cursor-pointer transition duration-300 shadow-md hover:shadow-lg backdrop-blur-sm
            hover:bg-purple-600 hover:border-purple-400 border border-white/30">
          <input type="reset" name="cancel" value="Cancel"
            class="bg-white/10 text-white px-4 py-2 rounded cursor-pointer transition duration-300 shadow-md hover:shadow-lg backdrop-blur-sm
            hover:bg-purple-600 hover:border-purple-400 border border-white/30">
        </div>
      </form>

      <div class="text-center text-sm text-white/80 mt-6">
        &copy; <?php echo date('Y'); ?> - Addlyl Khaliq
      </div>
    </div>
  </div>

  <!-- Script: Toggle Menu & Animate Hamburger -->
  <script>
    function toggleMenu() {
      const menu = document.getElementById("mobileMenu");
      const hamburger = document.getElementById("hamburger");
      menu.classList.toggle("show");
      hamburger.classList.toggle("open");
    }
  </script>

</body>
</html>
