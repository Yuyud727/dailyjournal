<?php
session_start();

include "koneksi.php";  

// check jika belum ada user yang login arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
    header("location:login.php"); 
    exit; // Penting untuk menghentikan eksekusi lebih lanjut setelah redirect
}

// Daftar putih file yang diperbolehkan
$allowed_pages = ['dashboard', 'article', 'gallery', 'profile', 'settings']; // Ditambahkan 'gallery'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
    /> 
    <style>  
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 100px; /* Margin bottom by footer height */
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px; /* Set the fixed height of the footer here */ 
        }
        /* Tambahan style untuk gallery */
        .gallery-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .table-gallery img {
            transition: transform 0.3s ease;
        }
        .table-gallery img:hover {
            transform: scale(1.5);
        }
    </style>
</head>
<body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top bg-danger-subtle">
    <div class="container">
        <a class="navbar-brand" target="_blank" href=".">My Daily Journal</a>
        <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
                <a class="nav-link <?= (!isset($_GET['page']) || $_GET['page'] == 'dashboard') ? 'active' : '' ?>" href="admin.php?page=dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'article') ? 'active' : '' ?>" href="admin.php?page=article">Article</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'gallery') ? 'active' : '' ?>" href="admin.php?page=gallery">Gallery</a>
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= htmlspecialchars($_SESSION['username'])?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li> 
                </ul>
            </li> 
        </ul>
        </div>
    </div>
    </nav>
    <!-- nav end -->
    <!-- content begin -->
    <section id="content" class="p-5">
        <div class="container">
            <?php
            if (isset($_GET['page']) && in_array($_GET['page'], $allowed_pages)) {
                $page = $_GET['page'];
                echo '<h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">' . ucfirst($page) . '</h4>';
                include($page . ".php");
            } else {
                echo '<h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">Dashboard</h4>';
                include("dashboard.php");
            }
            ?>
        </div>
    </section>
    <!-- content end -->
    <!-- footer begin -->
    <footer class="text-center p-5 bg-danger-subtle">
    <div>
        <a href="https://www.instagram.com/udinusofficial"
        ><i class="bi bi-instagram h2 p-2 text-dark"></i
        ></a>
        <a href="https://twitter.com/udinusofficial"
        ><i class="bi bi-twitter h2 p-2 text-dark"></i
        ></a>
        <a href="https://wa.me/+62812685577"
        ><i class="bi bi-whatsapp h2 p-2 text-dark"></i
        ></a>
    </div>
    <div>Pratama Yoga Yudhistira</div>
    </footer>
    <!-- footer end -->

    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
    ></script>

    <!-- Script untuk preview gambar sebelum upload -->
    <script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</body>
</html>
