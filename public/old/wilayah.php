<?Php
error_reporting(0);
if ($_POST['simpan'] == ".") {
  $a = $_POST['id_wilayah'];
  $b = $_POST['provinsi'];
  $c = $_POST['kabupaten'];
  include "sambung.php";
  $query = "insert into wilayah(id_wilayah,provinsi,kabupaten) values('" . $a . "','" . $b . "','" . $c . "')";
  $result = mysqli_query($link, $query) or die('Error query:  ' . $query);
  echo "<script language=\"Javascript\">\n";
  echo "window.alert('Data Telah Di Simpan');";
  echo "</script>";
}
if ($_GET['hps'] == "hps") {
  $a = $_GET["id_wilayah"];
  include "sambung.php";
  $query = "delete from wilayah where id_wilayah ='" . $a . "'";
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
$count_query = mysqli_query($link, "SELECT COUNT(*) as total FROM wilayah");
$count_result = mysqli_fetch_array($count_query);
$total_records = $count_result['total'];

echo "<h2><strong>Data <span class='highlight primary'>Wilayah</span></strong></h2>";

echo "<form action='wilayah.php' method='POST'>";

// Get auto increment ID for new record
$auto = 1;
$queryk = mysqli_query($link, "select * from wilayah ORDER BY id_wilayah ASC");
while ($jmlah = mysqli_fetch_array($queryk)) {
  $auto = $jmlah[0] + 1;
}

echo "<hr><div class='table-container'>
      <table>
        <thead>
          <tr>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th colspan='2'>AKSI</th>
          </tr>
        </thead>
        <tbody>";

echo "<tr>
          <td><input type='hidden' name='id_wilayah' value='$auto'>
              <input type='text' name='provinsi' placeholder='provinsi'></td>
          <td><input type='text' name='kabupaten' placeholder='kecamatan'></td>
          <td colspan='2'><button type='submit' name='simpan' value='.' class='btn btn-simpan'><i class='fas fa-save'></i> Simpan</button></td>
        </tr>";

// Get paginated data
$query = mysqli_query($link, "SELECT * FROM wilayah ORDER BY id_wilayah ASC LIMIT " . $pagination_data['offset'] . ", " . $pagination_data['records_per_page']);

while ($jmlh = mysqli_fetch_array($query)) {
  echo "<tr>
            <td>$jmlh[1]</td>
            <td>$jmlh[2]</td>
            <td><a href='wilayah_ganti.php?id_wilayah=$jmlh[0]' class='btn btn-ganti'><i class='fas fa-edit'></i> Edit</a></td>
            <td><a href='wilayah.php?id_wilayah=$jmlh[0]&hps=hps' class='btn btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\"><i class='fas fa-trash-alt'></i> Hapus</a></td>
          </tr>";
}

echo "</tbody>
      </table>
    </div>";

// Add pagination
$base_url = "wilayah.php?records_per_page=" . $pagination_data['records_per_page'];
echo createPagination($pagination_data['current_page'], $total_records, $pagination_data['records_per_page'], $base_url);

echo "</form>";
include "bawah.php";
