<?php
// Memanggil file Model, View, dan Presenter Kandidat
require_once __DIR__ . '/models/TabelKandidat.php';
require_once __DIR__ . '/views/ViewKandidat.php';
require_once __DIR__ . '/presenters/PresenterKandidat.php';

// Memanggil file Model, View, dan Presenter Departemen
require_once __DIR__ . '/models/TabelDepartemen.php';
require_once __DIR__ . '/views/ViewDepartemen.php';
require_once __DIR__ . '/presenters/PresenterDepartemen.php';

// Membuat objek Kandidat
$modelKandidat = new TabelKandidat('localhost', 'mvp_kandidat_db', 'root', '');
$viewKandidat = new ViewKandidat();
$presenterKandidat = new PresenterKandidat($modelKandidat, $viewKandidat);

// Membuat objek Departemen
$modelDepartemen = new TabelDepartemen('localhost', 'mvp_kandidat_db', 'root', '');
$viewDepartemen = new ViewDepartemen();
$presenterDepartemen = new PresenterDepartemen($modelDepartemen, $viewDepartemen);

// Menentukan halaman yang akan dibuka
$halaman = $_GET['halaman'] ?? 'kandidat';

// Menangani permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    // Proses Kandidat
    if ($halaman === 'kandidat') {

        if ($action === 'tambah') {
            $presenterKandidat->tambahKandidat(
                $_POST['nama'],
                $_POST['posisi'],
                $_POST['domisili'],
                (int)($_POST['skorTest'] ?? 0),
                (int)($_POST['pengalamanTahun'] ?? 0)
            );

        } elseif ($action === 'ubah') {
            $presenterKandidat->ubahKandidat(
                (int)$_POST['id'],
                $_POST['nama'],
                $_POST['posisi'],
                $_POST['domisili'],
                (int)($_POST['skorTest'] ?? 0),
                (int)($_POST['pengalamanTahun'] ?? 0)
            );

        } elseif ($action === 'hapus') {
            $presenterKandidat->hapusKandidat((int)$_POST['id']);
        }

    // Proses Departemen
    } elseif ($halaman === 'departemen') {

        if ($action === 'tambah') {
            $presenterDepartemen->tambahDepartemen(
                $_POST['nama_departemen'],
                $_POST['nama_ketua_departemen'],
                $_POST['lokasi_departemen']
            );

        } elseif ($action === 'ubah') {
            $presenterDepartemen->ubahDepartemen(
                (int)$_POST['id_departemen'],
                $_POST['nama_departemen'],
                $_POST['nama_ketua_departemen'],
                $_POST['lokasi_departemen']
            );

        } elseif ($action === 'hapus') {
            $presenterDepartemen->hapusDepartemen((int)$_POST['id']);
        }
    }

    header("Location: index.php?halaman=" . urlencode($halaman));
    exit();

// Menampilkan halaman GET
} else {

    // Tombol navigasi
    echo "
    <div style='padding: 15px; background: #f1f5f9; margin-bottom: 20px;'>
        <a href='index.php?halaman=kandidat'
           style='padding: 10px 15px; background: #2563eb; color: white; text-decoration: none; border-radius: 5px;'>
           Kandidat
        </a>

        <a href='index.php?halaman=departemen'
           style='padding: 10px 15px; background: #16a34a; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;'>
           Departemen
        </a>
    </div>
    ";

    $screen = $_GET['screen'] ?? 'list';

    if ($halaman === 'departemen') {

        if ($screen === 'add') {
            echo $presenterDepartemen->tampilkanFormDepartemen();

        } elseif ($screen === 'edit' && isset($_GET['id'])) {
            echo $presenterDepartemen->tampilkanFormDepartemen((int)$_GET['id']);

        } else {
            echo $presenterDepartemen->tampilkanDepartemen();
        }

    } else {

        if ($screen === 'add') {
            echo $presenterKandidat->tampilkanFormKandidat();

        } elseif ($screen === 'edit' && isset($_GET['id'])) {
            echo $presenterKandidat->tampilkanFormKandidat((int)$_GET['id']);

        } else {
            echo $presenterKandidat->tampilkanKandidat();
        }
    }
}
?>