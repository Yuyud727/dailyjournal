<?php
include 'config.php';
session_start();

// Fungsi untuk mengecek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Tanggal Upload</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM gallery ORDER BY upload_date DESC";
                    $hasil = $conn->query($sql);

                    if ($hasil && $hasil->num_rows > 0) {
                        $no = 1;
                        while ($row = $hasil->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row["title"]) ?></td>
                                <td>
                                    <?php
                                    if (!empty($row["image_path"]) && file_exists('uploads/gallery/' . $row["image_path"])) {
                                    ?>
                                        <img src="uploads/gallery/<?= htmlspecialchars($row["image_path"]) ?>" width="100">
                                    <?php
                                    } else {
                                        echo "Tidak ada gambar.";
                                    }
                                    ?>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($row["upload_date"])) ?></td>
                                <td><?= htmlspecialchars($row["username"]) ?></td>
                                <td>
                                    <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                                        <i class="bi bi-x-circle"></i>
                                    </a>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus Gallery</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Yakin akan menghapus gambar ini?</label>
                                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                            <input type="hidden" name="image_path" value="<?= $row["image_path"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data gallery.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="image" required>
                                <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Max: 2MB</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Proses upload gambar
if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $username = $_SESSION['username'];
    
    $target_dir = "uploads/gallery/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $image = $_FILES['image']['name'];
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $image_name = date('YmdHis') . '_' . uniqid() . '.' . $ext;
    $target_file = $target_dir . $image_name;
    
    // Validasi file
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (!in_array($ext, $allowed_types)) {
        echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan!');</script>";
    } elseif ($_FILES["image"]["size"] > $max_size) {
        echo "<script>alert('Ukuran file maksimal 2MB!');</script>";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO gallery (title, image_path, username) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $image_name, $username);
            
            if ($stmt->execute()) {
                echo "<script>
                    alert('Gambar berhasil diupload!');
                    window.location='admin.php?page=gallery';
                </script>";
            } else {
                echo "<script>alert('Gagal mengupload gambar!');</script>";
            }
            $stmt->close();
        }
    }
}

// Proses hapus gambar
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $image_path = $_POST['image_path'];

    if (file_exists('uploads/gallery/' . $image_path)) {
        unlink('uploads/gallery/' . $image_path);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>
            alert('Gambar berhasil dihapus!');
            window.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>alert('Gagal menghapus gambar!');</script>";
    }
    $stmt->close();
}
// Hitung jumlah gallery
$sql_count = "SELECT COUNT(*) AS jumlah_gallery FROM gallery";
$result_count = $conn->query($sql_count);
$jumlah_gallery = 0;

if ($result_count->num_rows > 0) {
    $row = $result_count->fetch_assoc();
    $jumlah_gallery = $row['jumlah_gallery'];
}

// Tampilkan jumlah gallery
echo "<h4>Jumlah Galeri: $jumlah_gallery</h4>";

$conn->close();
?>

