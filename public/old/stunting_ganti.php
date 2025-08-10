<?Php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle AJAX request
if ($_POST['action'] == 'update_stunting') {
    $response = array();

    $a = $_POST['id_stunting'];
    $b = $_POST['id_wilayah'];
    $c = $_POST['tahun'];
    $d = $_POST['jumlah'];

    include "sambung.php";

    if (!$link) {
        $response['success'] = false;
        $response['message'] = 'Database connection failed';
        echo json_encode($response);
        exit(0);
    }

    // Check if record exists
    $check_query = mysqli_query($link, "SELECT * FROM stunting WHERE id_stunting = '$a'");
    if (mysqli_num_rows($check_query) == 0) {
        $response['success'] = false;
        $response['message'] = 'Data dengan ID ' . $a . ' tidak ditemukan!';
        echo json_encode($response);
        exit(0);
    }

    $current_data = mysqli_fetch_array($check_query);

    // Update query
    $query = "UPDATE stunting SET id_wilayah = '$b', tahun = '$c', jumlah = '$d' WHERE id_stunting = '$a'";
    $result = mysqli_query($link, $query);

    if ($result) {
        $affected_rows = mysqli_affected_rows($link);

        if ($affected_rows > 0) {
            // Verify the update
            $verify_query = mysqli_query($link, "SELECT * FROM stunting WHERE id_stunting = '$a'");
            $updated_data = mysqli_fetch_array($verify_query);

            $response['success'] = true;
            $response['message'] = 'Data berhasil diperbarui!';
            $response['affected_rows'] = $affected_rows;
            $response['updated_data'] = $updated_data;
        } else {
            if ($current_data['id_wilayah'] == $b && $current_data['tahun'] == $c && $current_data['jumlah'] == $d) {
                $response['success'] = true;
                $response['message'] = 'Data tidak berubah karena nilai yang sama.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Tidak ada perubahan data.';
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Error: ' . mysqli_error($link);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit(0);
}

include "atas.php";
include "sambung.php";

echo "<style>
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
    
    .submit-btn:disabled {
        background: #95a5a6;
        cursor: not-allowed;
    }
    
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }
    
    .alert {
        padding: 10px;
        margin: 10px 0;
        border-radius: 4px;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>";

echo "<h2><strong>Edit Data <span style='color:#3498db'>stunting</span></strong></h2>";
$a = $_GET['id_stunting'];
$query = mysqli_query($link, "select * from stunting where id_stunting ='$a'");
$jmlh = mysqli_fetch_array($query);

echo "<div class='edit-form'>
        <div id='alert-message'></div>
        <form id='editForm'>
            <div class='form-group'>
                <label for='id_stunting'>ID Stunting</label>
                <input type='hidden' name='id_stunting' id='id_stunting' value='$jmlh[0]'>
                <input type='text' value='$jmlh[0]' readonly style='background-color: #f8f9fa; color: #6c757d;'>
            </div>
            
            <div class='form-group'>
                <label for='id_wilayah'>Wilayah</label>
                <select name='id_wilayah' id='id_wilayah' style='width:100%; padding:10px; border:1px solid #ddd; border-radius:4px; font-size:14px;'>";

// Ambil data wilayah yang sedang diedit untuk mendapatkan nama kabupaten
$current_wilayah_query = mysqli_query($link, "SELECT * FROM wilayah WHERE ID_Wilayah = '$jmlh[1]'");
$current_wilayah = mysqli_fetch_array($current_wilayah_query);

echo "<option value='$jmlh[1]' selected>{$current_wilayah['Kabupaten']} ({$current_wilayah['Provinsi']})</option>";

$queryisi = mysqli_query($link, "SELECT * FROM wilayah ORDER BY Kabupaten ASC");
while ($jmh = mysqli_fetch_array($queryisi)) {
    if ($jmh[0] != $jmlh[1]) { // Jangan tampilkan yang sudah dipilih
        echo "<option value='$jmh[0]'>{$jmh['Kabupaten']} ({$jmh['Provinsi']})</option>";
    }
}
echo "</select>
            </div>
            
            <div class='form-group'>
                <label for='tahun'>Tahun</label>
                <input type='text' name='tahun' id='tahun' value='$jmlh[2]' required>
            </div>   
            
            <div class='form-group'>
                <label for='jumlah'>Jumlah</label>
                <input type='text' name='jumlah' id='jumlah' value='$jmlh[3]' required>
            </div>       
            <div style='text-align: center;'>
                <button type='submit' id='submitBtn' class='submit-btn'>Update</button>
            </div>
        </form>
    </div>";

// Add AJAX JavaScript
echo "<script>
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    console.log('Form submitted via AJAX');
    
    // Disable submit button
    var submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';
    
    // Get form data
    var formData = new FormData();
    formData.append('action', 'update_stunting');
    formData.append('id_stunting', document.getElementById('id_stunting').value);
    formData.append('id_wilayah', document.getElementById('id_wilayah').value);
    formData.append('tahun', document.getElementById('tahun').value);
    formData.append('jumlah', document.getElementById('jumlah').value);
    
    // Log form data
    for (var pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    
    // Send AJAX request
    fetch('stunting_ganti.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);
        
        var alertDiv = document.getElementById('alert-message');
        
        if (data.success) {
            alertDiv.innerHTML = '<div class=\"alert alert-success\">' + data.message + '</div>';
            
            // Update the form with new data if available
            if (data.updated_data) {
                document.getElementById('jumlah').value = data.updated_data.jumlah;
                document.getElementById('tahun').value = data.updated_data.tahun;
            }
            
            // Redirect after 2 seconds
            setTimeout(function() {
                window.location.href = 'stunting.php';
            }, 2000);
        } else {
            alertDiv.innerHTML = '<div class=\"alert alert-error\">' + data.message + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('alert-message').innerHTML = '<div class=\"alert alert-error\">Error: ' + error.message + '</div>';
    })
    .finally(() => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.textContent = 'Update';
    });
});

console.log('AJAX form handler loaded');
</script>";

include "bawah.php";
