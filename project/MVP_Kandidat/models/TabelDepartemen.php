
<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/DetailDepartemen.php';
require_once __DIR__ . '/Departemen.php';

class TabelDepartemen extends DB implements DetailDepartemen {

    public function __construct(
        string $host = "localhost",
        string $db_name = "mvp_kandidat_db",
        string $username = "root",
        string $password = ""
    ) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Mengubah hasil query database menjadi objek Departemen
    private function mapRowToDepartemen(array $row): Departemen {
        return new Departemen(
            (int)$row['id_departemen'],
            $row['nama_departemen'],
            $row['nama_ketua_departemen'],
            $row['lokasi_departemen']
        );
    }

    // Mengambil seluruh data departemen
    public function getAllDepartemen(): array {
        $query = "SELECT * FROM departemen ORDER BY id_departemen ASC;";
        $this->executeQuery($query);
        $rows = $this->getAllResult();

        $list = [];
        foreach ($rows as $row) {
            $list[] = $this->mapRowToDepartemen($row);
        }

        return $list;
    }

    // Mengambil data departemen berdasarkan ID
    public function getDepartemenById(int $id): ?Departemen {
        $query = "SELECT * FROM departemen WHERE id_departemen = :id LIMIT 1";
        $this->executeQuery($query, [':id' => $id]);
        $rows = $this->getAllResult();

        if (empty($rows)) {
            return null;
        }

        return $this->mapRowToDepartemen($rows[0]);
    }

    // Menambahkan departemen
    public function addDepartemen(
        string $nama_departemen,
        string $nama_ketua_departemen,
        string $lokasi_departemen
    ): void {
        $query = "INSERT INTO departemen (nama_departemen, nama_ketua_departemen, lokasi_departemen) VALUES (:nama_departemen, :nama_ketua_departemen, :lokasi_departemen)";

        $this->executeQuery($query, [
            ':nama_departemen' => $nama_departemen,
            ':nama_ketua_departemen' => $nama_ketua_departemen,
            ':lokasi_departemen' => $lokasi_departemen
        ]);
    }

    // Mengubah data departemen
    public function updateDepartemen(
        int $id,
        string $nama_departemen,
        string $nama_ketua_departemen,
        string $lokasi_departemen
    ): void {
        $query = "UPDATE departemen SET nama_departemen = :nama_departemen, nama_ketua_departemen = :nama_ketua_departemen, lokasi_departemen = :lokasi_departemen WHERE id_departemen = :id";

        $this->executeQuery($query, [
            ':id' => $id,
            ':nama_departemen' => $nama_departemen,
            ':nama_ketua_departemen' => $nama_ketua_departemen,
            ':lokasi_departemen' => $lokasi_departemen
        ]);
    }

    // Menghapus data departemen
    public function deleteDepartemen(int $id): void {
        $query = "DELETE FROM departemen WHERE id_departemen = :id";

        $this->executeQuery($query, [
            ':id' => $id
        ]);
    }
}
?>
