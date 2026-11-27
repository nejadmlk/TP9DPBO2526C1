<?php
interface DetailDepartemen {
    /**
     * Mengambil seluruh data departemen sebagai array objek departemen.
     * @return Departemen[]
     */
    public function getAllDepartemen(): array;

    /**
     * Mengambil satu data departemen berdasarkan ID.
     */
    public function getDepartemenById(int $id): ?Departemen;

    public function addDepartemen(string $nama, string $nama_ketua_departemen, string $lokasi_departemen): void;
    public function updateDepartemen(int $id, string $nama, string $nama_ketua_departemen, string $lokasi_departemenn): void;
    public function deleteDepartemen(int $id): void;
}
?>
