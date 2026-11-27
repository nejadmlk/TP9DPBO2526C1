<?php
interface KontrakDepartemen {
    public function tampilkanDepartemen(): string;
    public function tampilkanFormDepartemen(?int $id = null): string;
    public function tambahDepartemen(string $nama_departemen, string $nama_ketua_departemen, string $lokasi_departemen): void;
    public function ubahDepartemen(int $id, string $nama_departemen, string $nama_ketua_departemen, string $lokasi_departemen): void;
    public function hapusDepartemen(int $id): void;
}
?>
