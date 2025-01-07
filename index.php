<?php
include "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="images.jpg" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bootstrap Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>

    .icon {
      transition: transform 0.3s ease, fill 0.3s ease;
    }
    body.dark-mode {
      background-color: #121212; /* Latar belakang gelap */
      color: #ffffff; /* Teks putih */
    }

  .hero-dark {
    background-color: #001f3f; /* Biru gelap */
  }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="logo.jpg" alt="My Daily Journal Logo" width="30" height="30">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex text-dark justify-content-end">
          <li class="nav-item">
            <a class="nav-link active" href="#"><i class="fa fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#article"><i class="fa fa-book"></i> Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#gallery"><i class="fa fa-image"></i> Gallery</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn bg-light" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </button>
        </form>
        <!-- Tombol Gelap -->
        <div class="bg-dark h-2 p-2 d-flex border border-dark rounded inactive" id="gelap" onclick="toggleDarkMode()">
          <svg id="icon-gelap" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-moon-stars-fill icon" viewBox="0 0 16 16">
            <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
          </svg>
        </div>
        <!-- Tombol Terang -->
        <div class="bg-danger h-2 p-2 d-flex border border-dark rounded inactive" id="terang" onclick="toggleLightMode()">
          <svg id="icon-terang" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-sun-fill icon" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0"/>
          </svg>
        </div>
      </div>
    </div>
  </nav>

  <!-- SECTION HERO -->
<section id="hero" class="bg-info text-white py-5 text-sm-start">
  <div class="container">
    <div class="d-sm-flex flex-sm-row-reverse align-items-center">
      <!-- Gambar -->
      <div>
        <img src="mona.jpg" class="img-fluid" alt="Hero Image" width="300">
      </div>
      <!-- Teks -->
      <div>
        <h1 class="fw-bold display-4">Create Memories, Save Memories, Everyday</h1>
        <h4 class="lead display-6">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</h4>
        <h6>
          <span id="tanggal"></span>
          <span id="jam"></span>
        </h6>
      </div>
    </div>
  </div>
</section>
<!-- SECTION ARTICLE -->
<!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while ($row = $hasil->fetch_assoc()) {
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"] ?>" class="card-img-top card-image" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"] ?></h5>
              <p class="card-text">
                <?= $row["isi"] ?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"] ?>
              </small>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>
<!-- article end -->

<style>
  .card-image {
    height: 200px; /* Tinggi gambar */
    width: 100%; /* Lebar penuh */
    object-fit: cover; /* Gambar akan dipotong agar sesuai dengan kotak */
  }
</style>


<!-- SECTION GALLERY -->
<section id="gallery" class="bg-info p-5" style="position: relative;">
  <div class="container text-center">
    <h1 class="text-white mb-4">Gallery</h1>
  </div>
  <div id="carouselExample" class="carousel slide" style="background-color: blue; padding: 5px;">
    <div class="carousel-inner">
      <!-- Item 1 -->
      <div class="carousel-item active">
        <img src="bunkasai.jpg" class="d-block w-100" alt="Bunkasai" style="max-width: 100%; height: 60%;">
      </div>
      <!-- Item 2 -->
      <div class="carousel-item">
        <img src="kotak.jpg" class="d-block w-100" alt="Makan" style="max-width: 100%; height: 60%;">
      </div>
      <!-- Item 3 -->
      <div class="carousel-item">
        <img src="trading.jpg" class="d-block w-100" alt="Trading" style="max-width: 100%; height: 60%;">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>

  <!-- FOOTER -->
  <footer class="p-5">
    <div class="card">
      <div class="card-header bg-info text-white">
        Contact
      </div>
      <div class="card-body bg-secondary-subtle">
        <footer class="p-5">
          <div class="d-flex flex-column align-items-center text-center">
            
            <!-- Ikon Sosial Media -->
            <div class="d-flex align-items-center">
              
              <!-- Instagram -->
              <a href="https://www.instagram.com/" class="h-2 p-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                </svg>
                <p>Instagram</p>
              </a>
        
              <!-- WhatsApp -->
              <a href="https://web.whatsapp.com/" class="h-2 p-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                </svg>
                <p>WhatsApp</p>
              </a>
        
              <!-- X (Twitter) -->
              <a href="https://x.com/?lang=id" class="h-2 p-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                </svg>
                <p>X</p>
              </a>
            </div>
        
      </div>
    </div>
  </footer>


<script>
  function toggleDarkMode() {
    // Hero Section
    const heroSection = document.getElementById("hero");
    heroSection.classList.remove("bg-info", "text-white");
    heroSection.classList.add("bg-primary", "text-dark");

    // Article Section
    const articleSection = document.getElementById("article");
    articleSection.classList.remove("bg-light");
    articleSection.classList.add("bg-secondary");

    // Mengubah card di dalam Article Section menjadi bg-info
    const cards = articleSection.querySelectorAll(".card");
    cards.forEach(card => {
      card.classList.add("bg-info");
      card.classList.remove("bg-light");
    });

    // Gallery Section
    const gallerySection = document.getElementById("gallery");
    gallerySection.classList.remove("bg-info");
    gallerySection.classList.add("bg-primary");

    // Mengubah teks di dalam Gallery menjadi putih
    const galleryText = gallerySection.querySelectorAll("h1, p, span");
    galleryText.forEach(text => {
      text.classList.remove("text-dark");
      text.classList.add("text-white");
    });

    // Footer
    const footer = document.querySelector("footer");
    footer.classList.remove("bg-light");
    footer.classList.add("bg-primary");

    // Container dalam footer
    const container = footer.querySelector(".card-body");
    container.classList.remove("bg-secondary-subtle", "text-dark");
    container.classList.add("bg-dark", "text-white");

    // Div pembungkus ikon sosial media
    const socialMediaDivs = container.querySelectorAll("a");
    socialMediaDivs.forEach(div => {
      const parentDiv = div.closest("div"); // Menargetkan div pembungkus
      if (parentDiv) {
        parentDiv.classList.add("bg-dark");
        parentDiv.classList.remove("bg-light");
      }
      div.classList.add("text-white");
      div.classList.remove("text-dark");
    });
  }

  function toggleLightMode() {
    // Hero Section
    const heroSection = document.getElementById("hero");
    heroSection.classList.remove("bg-primary", "text-dark");
    heroSection.classList.add("bg-info", "text-white");

    // Article Section
    const articleSection = document.getElementById("article");
    articleSection.classList.remove("bg-secondary");
    articleSection.classList.add("bg-light");

    // Mengembalikan card di dalam Article Section ke kondisi awal
    const cards = articleSection.querySelectorAll(".card");
    cards.forEach(card => {
      card.classList.remove("bg-info");
      card.classList.add("bg-light");
    });

    // Gallery Section
    const gallerySection = document.getElementById("gallery");
    gallerySection.classList.remove("bg-primary");
    gallerySection.classList.add("bg-info");

    // Mengembalikan teks di dalam Gallery menjadi hitam
    const galleryText = gallerySection.querySelectorAll("h1, p, span");
    galleryText.forEach(text => {
      text.classList.remove("text-white");
      text.classList.add("text-dark");
    });

    // Footer
    const footer = document.querySelector("footer");
    footer.classList.remove("bg-primary");
    footer.classList.add("bg-light");

    // Container dalam footer
    const container = footer.querySelector(".card-body");
    container.classList.remove("bg-dark", "text-white");
    container.classList.add("bg-secondary-subtle", "text-dark");

    // Div pembungkus ikon sosial media
    const socialMediaDivs = container.querySelectorAll("a");
    socialMediaDivs.forEach(div => {
      const parentDiv = div.closest("div"); 
      if (parentDiv) {
        parentDiv.classList.add("bg-secondary-subtle");
        parentDiv.classList.remove("bg-dark");
      }
      div.classList.add("text-dark");
      div.classList.remove("text-white");
    });
  }
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

