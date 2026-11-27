
<?php
class Departemen {
    // Atribut class
    private ?int $id_departemen;
    private string $nama_departemen;
    private string $nama_ketua_departemen;
    private string $lokasi_departemen;

    // Constructor
    public function __construct(
        ?int $id,
        string $nama_departemen,
        string $nama_ketua_departemen,
        string $lokasi_departemen
    ) {
        $this->id_departemen = $id;
        $this->nama_departemen = $nama_departemen;
        $this->nama_ketua_departemen = $nama_ketua_departemen;
        $this->lokasi_departemen = $lokasi_departemen;
    }

    // Getter
    public function getId(): ?int {
        return $this->id_departemen;
    }

    public function getNamaDepartemen(): string {
        return $this->nama_departemen;
    }

    public function getNamaKetuaDepartemen(): string {
        return $this->nama_ketua_departemen;
    }

    public function getLokasiDepartemen(): string {
        return $this->lokasi_departemen;
    }

    // Setter
    public function setNamaDepartemen(string $nama_departemen): void {
        $this->nama_departemen = $nama_departemen;
    }

    public function setNamaKetuaDepartemen(string $nama_ketua_departemen): void {
        $this->nama_ketua_departemen = $nama_ketua_departemen;
    }

    public function setLokasiDepartemen(string $lokasi_departemen): void {
        $this->lokasi_departemen = $lokasi_departemen;
    }
}
?>
