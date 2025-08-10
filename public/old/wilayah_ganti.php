<?Php
error_reporting(0);
if($_POST['ok']==' ')
{
$a=$_POST['id_wilayah'];
$b=$_POST['provinsi'];
$c=$_POST['kabupaten'];
$t=$_POST['ok'];
if($t==true)
{
include "sambung.php";
$query = "update wilayah set provinsi = '$b', kabupaten = '$c' where id_wilayah ='".$a."' ";
$result = mysqli_query($link,$query) or die('Error query:  '.$query);
echo "<script language=\"Javascript\">\n";
echo "window.alert('Data Telah Di Ganti');";
echo "</script>";
include"wilayah.php";
exit(0);
}
}
include"atas.php";
include "sambung.php";

echo"<style>
    .edit-form {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .form-group {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    .form-group label {
        width: 150px;
        font-weight: 500;
        color: #2c3e50;
    }
    
    .form-group input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .form-group input:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
    }
    
    .submit-btn {
        background: #3498db;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        transition: background 0.3s;
    }
    
    .submit-btn:hover {
        background: #2980b9;
    }
    
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }
</style>";

echo"<h2><strong>Edit Data <span style='color:#3498db'>Wilayah</span></strong></h2>";
$a=$_GET['id_wilayah'];
$query = mysqli_query($link,"select * from wilayah where id_wilayah ='$a'");
$jmlh=mysqli_fetch_array($query);
	
	echo"<div class='edit-form'>
        <form action='wilayah_ganti.php' method='POST'>
            <div class='form-group'>
                <label for='id_pegawai'>ID Wilayah</label>
                <input type='text' name='id_wilayah' id='id_wilayah' value='$jmlh[0]' readonly>
            </div>
            
            <div class='form-group'>
                <label for='provinsi'>Provinsi</label>
                <input type='text' name='provinsi' id='provinsi' value='$jmlh[1]'>
            </div>
            
            <div class='form-group'>
                <label for='kabupaten'>Kabupaten</label>
                <input type='text' name='kabupaten' id='kabupaten' value='$jmlh[2]'>
            </div>            
            <div style='text-align: center;'>
                <input type='submit' name='ok' class='submit-btn' value=' '>
            </div>
        </form>
    </div>";

include"bawah.php";
?>