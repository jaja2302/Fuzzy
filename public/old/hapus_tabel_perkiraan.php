<?php

/**
 * Script untuk menghapus tabel perkiraan yang lama
 * Hanya jalankan jika Anda yakin ingin menghapus data perkiraan statis
 */

include "sambung.php";

echo "<h2>Hapus Tabel Perkiraan Lama</h2>";
echo "<p>Script ini akan menghapus tabel 'perkiraan' yang berisi data statis.</p>";
echo "<p><strong>PERHATIAN:</strong> Data yang dihapus tidak dapat dikembalikan!</p>";

if (isset($_POST['hapus_tabel'])) {
    // Backup data terlebih dahulu (opsional)
    $backup_query = "SELECT * FROM perkiraan";
    $backup_result = mysqli_query($link, $backup_query);

    if ($backup_result) {
        $backup_data = array();
        while ($row = mysqli_fetch_assoc($backup_result)) {
            $backup_data[] = $row;
        }

        // Simpan backup ke file
        $backup_file = 'backup_perkiraan_' . date('Y-m-d_H-i-s') . '.json';
        file_put_contents($backup_file, json_encode($backup_data, JSON_PRETTY_PRINT));

        echo "<div style='background: #d4edda; padding: 10px; margin: 10px; border-radius: 5px;'>";
        echo "<strong>✓ Backup berhasil:</strong> Data tersimpan di file $backup_file";
        echo "</div>";
    }

    // Hapus tabel
    $drop_query = "DROP TABLE IF EXISTS perkiraan";
    $result = mysqli_query($link, $drop_query);

    if ($result) {
        echo "<div style='background: #d4edda; padding: 10px; margin: 10px; border-radius: 5px;'>";
        echo "<strong>✓ Berhasil:</strong> Tabel 'perkiraan' telah dihapus dari database.";
        echo "</div>";
        echo "<p>Sekarang sistem hanya menggunakan perhitungan FTS dinamis.</p>";
    } else {
        echo "<div style='background: #f8d7da; padding: 10px; margin: 10px; border-radius: 5px;'>";
        echo "<strong>✗ Error:</strong> " . mysqli_error($link);
        echo "</div>";
    }
} else {
    echo "<form method='POST'>";
    echo "<button type='submit' name='hapus_tabel' style='background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>";
    echo "Hapus Tabel Perkiraan";
    echo "</button>";
    echo "</form>";
}

echo "<br><a href='menu.php' style='background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Kembali ke Menu</a>";
