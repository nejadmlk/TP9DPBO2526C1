
<?php
require_once __DIR__ . '/KontrakDepartemen.php';
require_once __DIR__ . '/../models/DetailDepartemen.php';
require_once __DIR__ . '/../models/Departemen.php';
require_once __DIR__ . '/../views/KontrakView.php';

class PresenterDepartemen implements KontrakDepartemen {
    private DetailDepartemen $model;
    private KontrakView $view;

    public function __construct(DetailDepartemen $model, KontrakView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    // Membuat satu baris HTML tabel departemen
    private function buildRowHtml(int $no, Departemen $departemen): string {
        $id = (int)$departemen->getId();
        $nama = htmlspecialchars($departemen->getNamaDepartemen());
        $nama_ketua = htmlspecialchars($departemen->getNamaKetuaDepartemen());
        $lokasi = htmlspecialchars($departemen->getLokasiDepartemen());

        return "<tr>
            <td class='col-id'>{$no}</td>
            <td><strong>{$nama}</strong></td>
            <td>{$nama_ketua}</td>
            <td>{$lokasi}</td>
            <td class='col-actions'>

            <a href='index.php?halaman=departemen&screen=edit&id={$id}' class='btn btn-edit'>
                Edit
            </a>

            <form method='post' action='index.php?halaman=departemen' style='display:inline;' onsubmit=\"return confirm('Hapus departemen ini?')\">
                <input type='hidden' name='action' value='hapus'>
                <input type='hidden' name='id' value='{$id}'>

                <button type='submit' class='btn btn-delete'>
                    Hapus
                    </button>
            </form>

            </td>
        </tr>";
    }

    // Menampilkan seluruh data departemen
    public function tampilkanDepartemen(): string {
        $listDepartemen = $this->model->getAllDepartemen();
        $totalDepartemen = count($listDepartemen);

        $rowsHtml = '';

        if (empty($listDepartemen)) {
            $rowsHtml = "<tr>
                <td colspan='5' style='text-align:center;color:#6b7280;padding:24px;'>
                    Belum ada data departemen.
                </td>
            </tr>";
        } else {
            $no = 1;

            foreach ($listDepartemen as $departemen) {
                $rowsHtml .= $this->buildRowHtml($no, $departemen);
                $no++;
            }
        }

        return $this->view->renderDaftar($rowsHtml, $totalDepartemen);
    }

    // Menampilkan form tambah atau ubah departemen
    public function tampilkanFormDepartemen(?int $id = null): string {
        if ($id !== null) {
            $departemen = $this->model->getDepartemenById($id);

            if ($departemen === null) {
                header("Location: index.php");
                exit();
            }

            $formData = [
                'id_departemen' => $departemen->getId(),
                'nama_departemen' => $departemen->getNamaDepartemen(),
                'nama_ketua_departemen' => $departemen->getNamaKetuaDepartemen(),
                'lokasi_departemen' => $departemen->getLokasiDepartemen()
            ];

            return $this->view->renderForm(
                "Ubah Data Departemen",
                "ubah",
                $formData
            );
        }

        return $this->view->renderForm(
            "Tambah Departemen Baru",
            "tambah",
            []
        );
    }

    // Menambahkan data departemen
    public function tambahDepartemen(
        string $nama_departemen,
        string $nama_ketua_departemen,
        string $lokasi_departemen
    ): void {
        $this->model->addDepartemen(
            $nama_departemen,
            $nama_ketua_departemen,
            $lokasi_departemen
        );

        header("Location: index.php");
        exit();
    }

    // Mengubah data departemen
    public function ubahDepartemen(
        int $id,
        string $nama_departemen,
        string $nama_ketua_departemen,
        string $lokasi_departemen
    ): void {
        $this->model->updateDepartemen(
            $id,
            $nama_departemen,
            $nama_ketua_departemen,
            $lokasi_departemen
        );

        header("Location: index.php");
        exit();
    }

    // Menghapus data departemen
    public function hapusDepartemen(int $id): void {

        // Memanggil Model untuk menghapus data
        $this->model->deleteDepartemen($id);

        // Kembali ke halaman Departemen
        header("Location: index.php?halaman=departemen");
        exit();
    }
}
?>
