<?Php
error_reporting(0);
if ($_POST['simpan'] == ".") {
  $a = $_POST['id_stunting'];
  $b = $_POST['id_wilayah'];
  $c = $_POST['tahun'];
  $d = $_POST['jumlah'];

  include "sambung.php";
  $query = "insert into stunting(id_stunting,id_wilayah,tahun,jumlah) values('" . $a . "','" . $b . "','" . $c . "','" . $d . "')";
  $result = mysqli_query($link, $query) or die('Error query:  ' . $query);
  echo "<script language=\"Javascript\">\n";
  echo "window.alert('Data Telah Di Simpan');";
  echo "</script>";
}
if ($_GET['hps'] == "hps") {
  $a = $_GET["id_stunting"];
  include "sambung.php";
  $query = "delete from stunting where id_stunting ='" . $a . "'";
  $result = mysqli_query($link, $query) or die('Error query:  ' . $query);
  echo "<script language=\"Javascript\">\n";
  echo "window.alert('Data Telah Di Hapus');";
  echo "</script>";
}
include "atas.php";
include "sambung.php";
include "pagination.php";

// Pagination setup
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$records_per_page = isset($_GET['records_per_page']) ? intval($_GET['records_per_page']) : 10;
$pagination_data = getPaginationData($current_page, $records_per_page);

// Get total records count
$count_query = mysqli_query($link, "SELECT COUNT(*) as total FROM stunting");
$count_result = mysqli_fetch_array($count_query);
$total_records = $count_result['total'];

echo "<h2><strong>Data <span class='highlight primary'>Stunting</span></strong></h2>";

echo "<form action='stunting.php' method='POST'>";

// Get auto increment ID for new record
$auto = 1;
$queryk = mysqli_query($link, "select * from stunting ORDER BY id_stunting ASC");
while ($jmlah = mysqli_fetch_array($queryk)) {
  $auto = $jmlah[0] + 1;
}

echo "<hr><div class='table-container'>
      <table>
        <thead>
          <tr>
            <th>ID Wilayah</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th colspan='2'>AKSI</th>
          </tr>
        </thead>
        <tbody>";

echo "<tr>
          <td><input type='hidden' name='id_stunting' value='$auto'>
		  <select name='id_wilayah' style='width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;' required>
	<option value=''>-- Pilih Wilayah --</option>";
$queryisi = mysqli_query($link, "SELECT * FROM wilayah ORDER BY Kabupaten ASC");
while ($jmh = mysqli_fetch_array($queryisi)) {
  echo "<option value='$jmh[0]'>{$jmh['Kabupaten']} ({$jmh['Provinsi']})</option>";
}
echo "</select>
		  </td>
          <td><input type='number' name='tahun' placeholder='tahun'></td>
          <td><input type='number' name='jumlah' placeholder='jumlah'></td>
          <td colspan='2'><button type='submit' name='simpan' value='.' class='btn btn-simpan'><i class='fas fa-save'></i> Simpan</button></td>
        </tr>";

// Get paginated data with JOIN to get wilayah name
$query = mysqli_query($link, "SELECT s.*, w.Kabupaten FROM stunting s LEFT JOIN wilayah w ON s.id_wilayah = w.ID_Wilayah ORDER BY s.id_stunting ASC LIMIT " . $pagination_data['offset'] . ", " . $pagination_data['records_per_page']);

while ($jmlh = mysqli_fetch_array($query)) {
  $wilayah_name = $jmlh['Kabupaten'] ? $jmlh['Kabupaten'] : $jmlh[1];
  echo "<tr>
            <td>$wilayah_name</td>
            <td>$jmlh[2]</td>
            <td>$jmlh[3]</td>
            <td><a href='stunting_ganti.php?id_stunting=$jmlh[0]' class='btn btn-ganti'><i class='fas fa-edit'></i> Edit</a></td>
            <td><a href='stunting.php?id_stunting=$jmlh[0]&hps=hps' class='btn btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\"><i class='fas fa-trash-alt'></i> Hapus</a></td>
          </tr>";
}

echo "</tbody>
      </table>
    </div>";

// Add pagination
$base_url = "stunting.php?records_per_page=" . $pagination_data['records_per_page'];
echo createPagination($pagination_data['current_page'], $total_records, $pagination_data['records_per_page'], $base_url);

echo "</form>";
include "bawah.php";
