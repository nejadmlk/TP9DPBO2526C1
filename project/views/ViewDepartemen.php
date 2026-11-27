
<?php
require_once __DIR__ . '/KontrakView.php';

class ViewDepartemen implements KontrakView {
    private string $skinPath;
    private string $formPath;

    public function __construct(string $skinPath = '', string $formPath = '') {
        $this->skinPath = $skinPath ?: __DIR__ . '/../template/skin_departemen.html';
        $this->formPath = $formPath ?: __DIR__ . '/../template/form_departemen.html';
    }

    // Menampilkan daftar departemen
    public function renderDaftar(string $tableRowsHtml, int $totalData): string {
        $template = file_get_contents($this->skinPath);

        $tokens = [
            '{{TABLE_ROWS}}' => $tableRowsHtml,
            '{{TOTAL_DATA}}' => (string)$totalData,
        ];

        return str_replace(array_keys($tokens), array_values($tokens), $template);
    }

    // Menampilkan form departemen
    public function renderForm(string $title, string $action, array $formData = []): string {
        $template = file_get_contents($this->formPath);

        $tokens = [
            '{{FORM_TITLE}}' => htmlspecialchars($title),
            '{{ACTION}}' => htmlspecialchars($action),
            '{{ID}}' => htmlspecialchars((string)($formData['id_departemen'] ?? '')),
            '{{NAMA}}' => htmlspecialchars($formData['nama_departemen'] ?? ''),
            '{{NAMA_KETUA}}' => htmlspecialchars($formData['nama_ketua_departemen'] ?? ''),
            '{{LOKASI}}' => htmlspecialchars($formData['lokasi_departemen'] ?? ''),
        ];

        return str_replace(array_keys($tokens), array_values($tokens), $template);
    }
}
?>
