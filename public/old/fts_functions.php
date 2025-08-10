<?php

/**
 * Fuzzy Time Series (FTS) Functions
 * Fungsi untuk perhitungan FTS secara dinamis
 */

/**
 * Menghitung perkiraan FTS untuk wilayah tertentu
 * @param int $id_wilayah ID wilayah
 * @param int $tahun_tujuan Tahun yang akan diprediksi
 * @param mysqli $link Koneksi database
 * @return array Hasil perkiraan
 */
function hitungFTS($id_wilayah, $tahun_tujuan, $link)
{
    // Ambil data historis untuk wilayah tersebut
    $data_historis = array();
    $query = mysqli_query($link, "SELECT tahun, jumlah FROM stunting WHERE id_wilayah = '$id_wilayah' ORDER BY tahun ASC");

    while ($row = mysqli_fetch_array($query)) {
        $data_historis[] = array(
            'tahun' => $row['tahun'],
            'jumlah' => (int)$row['jumlah']
        );
    }

    // Jika data kurang dari 2, tidak bisa dihitung
    if (count($data_historis) < 2) {
        return array(
            'success' => false,
            'message' => 'Data historis tidak cukup untuk perhitungan FTS (minimal 2 data)',
            'data' => null
        );
    }

    // Cari data tahun terakhir yang tersedia
    $tahun_terakhir = max(array_column($data_historis, 'tahun'));

    // Jika tahun tujuan sudah ada datanya, gunakan data aktual
    $data_tujuan = null;
    foreach ($data_historis as $data) {
        if ($data['tahun'] == $tahun_tujuan) {
            $data_tujuan = $data;
            break;
        }
    }

    // Jika tahun tujuan belum ada, lakukan prediksi
    if ($data_tujuan === null) {
        // Ambil 2 data terakhir untuk perhitungan
        $data_terakhir = array();
        for ($i = count($data_historis) - 1; $i >= 0 && count($data_terakhir) < 2; $i--) {
            array_unshift($data_terakhir, $data_historis[$i]);
        }

        // Hitung FTS
        $hasil_fts = hitungFTSAlgorithm($data_terakhir, $tahun_tujuan);

        // Hitung persentase perubahan dari tahun terakhir
        $jumlah_terakhir = $data_terakhir[count($data_terakhir) - 1]['jumlah'];
        $jumlah_perkiraan = $hasil_fts['prediksi'];
        $selisih = $jumlah_perkiraan - $jumlah_terakhir;
        $persentase = ($jumlah_terakhir > 0) ? (($selisih / $jumlah_terakhir) * 100) : 0;

        return array(
            'success' => true,
            'message' => 'Perkiraan berhasil dihitung',
            'data' => array(
                'id_wilayah' => $id_wilayah,
                'tahun_terakhir' => $data_terakhir[count($data_terakhir) - 1]['tahun'],
                'jumlah_terakhir' => $jumlah_terakhir,
                'tahun_perkiraan' => $tahun_tujuan,
                'jumlah_perkiraan' => $jumlah_perkiraan,
                'selisih' => $selisih,
                'persentase' => $persentase,
                'jumlah_aktual' => null,
                'metode' => 'FTS',
                'data_historis' => $data_historis,
                'tipe' => 'prediksi'
            )
        );
    } else {
        // Jika data tahun tujuan sudah ada, hitung selisih dengan prediksi
        $data_sebelum = array();
        foreach ($data_historis as $data) {
            if ($data['tahun'] < $tahun_tujuan) {
                $data_sebelum[] = $data;
            }
        }

        if (count($data_sebelum) >= 2) {
            // Ambil 2 data terakhir sebelum tahun tujuan
            $data_terakhir = array();
            for ($i = count($data_sebelum) - 1; $i >= 0 && count($data_terakhir) < 2; $i--) {
                array_unshift($data_terakhir, $data_sebelum[$i]);
            }

            $hasil_fts = hitungFTSAlgorithm($data_terakhir, $tahun_tujuan);
            $jumlah_aktual = $data_tujuan['jumlah'];
            $jumlah_perkiraan = $hasil_fts['prediksi'];
            $selisih = $jumlah_aktual - $jumlah_perkiraan;
            $persentase = ($jumlah_perkiraan > 0) ? (($selisih / $jumlah_perkiraan) * 100) : 0;

            return array(
                'success' => true,
                'message' => 'Data aktual tersedia, perkiraan untuk validasi',
                'data' => array(
                    'id_wilayah' => $id_wilayah,
                    'tahun_terakhir' => $data_terakhir[count($data_terakhir) - 1]['tahun'],
                    'jumlah_terakhir' => $data_terakhir[count($data_terakhir) - 1]['jumlah'],
                    'tahun_perkiraan' => $tahun_tujuan,
                    'jumlah_perkiraan' => $jumlah_perkiraan,
                    'jumlah_aktual' => $jumlah_aktual,
                    'selisih' => $selisih,
                    'persentase' => $persentase,
                    'metode' => 'FTS',
                    'data_historis' => $data_historis,
                    'tipe' => 'validasi'
                )
            );
        }
    }

    return array(
        'success' => false,
        'message' => 'Tidak cukup data untuk perhitungan',
        'data' => null
    );
}

/**
 * Algoritma FTS untuk menghitung prediksi
 * @param array $data_historis Data historis (minimal 2 data)
 * @param int $tahun_tujuan Tahun yang akan diprediksi
 * @return array Hasil perhitungan
 */
function hitungFTSAlgorithm($data_historis, $tahun_tujuan)
{
    // Ambil nilai-nilai dari data historis
    $nilai_historis = array_column($data_historis, 'jumlah');

    // Gunakan Semesta U tetap (Bab 3)
    // Min = 2,775; Jumlah interval (k) = 6; Ukuran interval = 11,005; Upper terakhir = 68,805
    $min = 2775;
    $jumlah_interval = 6;
    $interval_size = 11005;
    $upper_akhir = $min + ($jumlah_interval * $interval_size); // 68,805

    // Buat interval fuzzy
    $intervals = array();
    $fuzzy_sets = array();

    $current_value = $min;
    for ($i = 1; $i <= $jumlah_interval; $i++) {
        $is_last = ($i === $jumlah_interval);
        $next_value = $is_last ? $upper_akhir : ($current_value + $interval_size);
        $intervals[$i] = array(
            'lower' => $current_value,
            'upper' => $next_value,
            'midpoint' => ($current_value + $next_value) / 2
        );
        $fuzzy_sets[$i] = "A$i";
        $current_value = $next_value;
    }

    // Fuzzifikasi data historis
    $fuzzy_values = array();
    foreach ($nilai_historis as $nilai) {
        $fuzzy_set = "";
        for ($i = 1; $i <= $jumlah_interval; $i++) {
            $lower = $intervals[$i]['lower'];
            $upper = $intervals[$i]['upper'];
            $is_last = ($i === $jumlah_interval);
            if (($nilai >= $lower && $nilai < $upper) || ($is_last && $nilai >= $lower)) {
                $fuzzy_set = $fuzzy_sets[$i];
                break;
            }
        }
        $fuzzy_values[] = $fuzzy_set;
    }

    // Hitung prediksi berdasarkan fuzzy set terakhir
    $fuzzy_terakhir = end($fuzzy_values);
    $prediksi = 0;

    // Cari interval yang sesuai dengan fuzzy set terakhir
    for ($i = 1; $i <= $jumlah_interval; $i++) {
        if ($fuzzy_sets[$i] == $fuzzy_terakhir) {
            $prediksi = ceil($intervals[$i]['midpoint']);
            break;
        }
    }

    return array(
        'prediksi' => $prediksi,
        'fuzzy_sets' => $fuzzy_sets,
        'intervals' => $intervals,
        'fuzzy_values' => $fuzzy_values,
        'min' => $min,
        'max' => $upper_akhir,
        'jumlah_interval' => $jumlah_interval,
        'interval_size' => $interval_size
    );
}

/**
 * Menghitung perkiraan untuk semua wilayah
 * @param int $tahun_tujuan Tahun yang akan diprediksi
 * @param mysqli $link Koneksi database
 * @return array Hasil perkiraan untuk semua wilayah
 */
function hitungFTSAllWilayah($tahun_tujuan, $link)
{
    $hasil_semua = array();

    // Ambil semua wilayah
    $query = mysqli_query($link, "SELECT ID_Wilayah, Kabupaten, Provinsi FROM wilayah ORDER BY Kabupaten ASC");

    while ($wilayah = mysqli_fetch_array($query)) {
        $hasil = hitungFTS($wilayah['ID_Wilayah'], $tahun_tujuan, $link);

        if ($hasil['success']) {
            $hasil['data']['nama_wilayah'] = $wilayah['Kabupaten'];
            $hasil['data']['provinsi'] = $wilayah['Provinsi'];
            $hasil_semua[] = $hasil['data'];
        }
    }

    return $hasil_semua;
}

/**
 * Menampilkan hasil perkiraan dalam format tabel
 * @param array $data_perkiraan Data perkiraan
 * @return string HTML tabel
 */
function tampilkanHasilPerkiraan($data_perkiraan)
{
    $html = "<div class='table-responsive'>";
    $html .= "<table class='table table-striped table-bordered table-hover'>";
    $html .= "<thead class='thead-dark'>";
    $html .= "<tr>";
    $html .= "<th>WILAYAH</th>";
    $html .= "<th>DATA HISTORIS</th>";
    $html .= "<th>TAHUN TERAKHIR</th>";
    $html .= "<th>JUMLAH TERAKHIR</th>";
    $html .= "<th>TAHUN PERKIRAAN</th>";
    $html .= "<th>JUMLAH PERKIRAAN</th>";
    $html .= "<th>SELISIH</th>";
    $html .= "<th>STATUS</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";

    foreach ($data_perkiraan as $index => $data) {
        $selisih_text = "";
        $status_text = "";
        $status_class = "";
        $status_badge = "";
        $row_class = "";

        // Generate historical data display
        $historical_data = "";
        if (isset($data['data_historis']) && is_array($data['data_historis'])) {
            foreach ($data['data_historis'] as $hist_data) {
                $historical_data .= "<strong>{$hist_data['tahun']}:</strong> " . number_format($hist_data['jumlah']) . "<br>";
            }
        }

        if ($data['tipe'] == 'validasi') {
            // Untuk data validasi (ada data aktual)
            if ($data['selisih'] > 0) {
                $selisih_text = "↑ " . number_format($data['selisih']) . " (+" . number_format($data['persentase'], 1) . "%)";
                $status_text = "Naik " . number_format($data['persentase'], 1) . "%";
                $status_class = "text-success";
                $status_badge = "badge-success";
                $row_class = "table-success";
            } else {
                $selisih_text = "↓ " . number_format(abs($data['selisih'])) . " (" . number_format($data['persentase'], 1) . "%)";
                $status_text = "Turun " . number_format(abs($data['persentase']), 1) . "%";
                $status_class = "text-danger";
                $status_badge = "badge-danger";
                $row_class = "table-danger";
            }
        } else {
            // Untuk data prediksi (tidak ada data aktual)
            if ($data['selisih'] > 0) {
                $selisih_text = "↑ " . number_format($data['selisih']) . " (+" . number_format($data['persentase'], 1) . "%)";
                $status_text = "Prediksi Naik " . number_format($data['persentase'], 1) . "%";
                $status_class = "text-success";
                $status_badge = "badge-warning";
                $row_class = "table-warning";
            } else {
                $selisih_text = "↓ " . number_format(abs($data['selisih'])) . " (" . number_format($data['persentase'], 1) . "%)";
                $status_text = "Prediksi Turun " . number_format(abs($data['persentase']), 1) . "%";
                $status_class = "text-danger";
                $status_badge = "badge-warning";
                $row_class = "table-warning";
            }
        }

        $html .= "<tr class='$row_class' data-wilayah='" . strtolower($data['nama_wilayah']) . "' data-status='" . strtolower($status_text) . "'>";
        $html .= "<td><strong>{$data['nama_wilayah']}</strong><br><small class='text-muted'>{$data['provinsi']}</small></td>";
        $html .= "<td><small>$historical_data</small></td>";
        $html .= "<td>{$data['tahun_terakhir']}</td>";
        $html .= "<td>" . number_format($data['jumlah_terakhir']) . "</td>";
        $html .= "<td>{$data['tahun_perkiraan']}</td>";
        $html .= "<td>" . number_format($data['jumlah_perkiraan']) . "</td>";
        $html .= "<td class='$status_class'><strong>$selisih_text</strong></td>";
        $html .= "<td><span class='badge $status_badge'>$status_text</span></td>";
        $html .= "</tr>";
    }

    $html .= "</tbody>";
    $html .= "</table>";
    $html .= "</div>";

    return $html;
}
