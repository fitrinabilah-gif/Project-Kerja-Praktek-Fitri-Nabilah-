<?php
// File: submit_form.php
// Handle form submission via AJAX

// Set header for JSON response FIRST, so any error below still returns valid JSON
header('Content-Type: application/json');

// Include database configuration
require_once 'includes/config.php';

// Initialize response array
$response = array();

// If database connection failed, stop here and return a proper JSON error
if (!empty($db_connection_error)) {
    $response['success'] = false;
    $response['message'] = "Koneksi database gagal. Silakan hubungi administrator.";
    echo json_encode($response);
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get and clean input data
    $nama = isset($_POST['nama']) ? clean_input($_POST['nama']) : '';
    $email = isset($_POST['email']) ? clean_input($_POST['email']) : '';
    $pesan = isset($_POST['pesan']) ? clean_input($_POST['pesan']) : '';
    
    // Validation
    $errors = array();
    
    if (empty($nama)) {
        $errors[] = "Nama harus diisi";
    }
    
    if (empty($email)) {
        $errors[] = "Email harus diisi";
    } elseif (!validate_email($email)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($pesan)) {
        $errors[] = "Pesan harus diisi";
    }
    
    // If there are errors
    if (!empty($errors)) {
        $response['success'] = false;
        $response['message'] = implode(", ", $errors);
    } else {
        // Insert to database
        $sql = "INSERT INTO pesan (nama, email, pesan) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pesan);
            
            if (mysqli_stmt_execute($stmt)) {
                $response['success'] = true;
                $response['message'] = "Terima kasih! Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.";
                
                // Optional: Send email notification
                // mail('admin@perisai-bpjs.go.id', 'Pesan Baru dari Website', $pesan);
                
            } else {
                $response['success'] = false;
                $response['message'] = "Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $response['success'] = false;
            $response['message'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
        }
    }
    
} else {
    $response['success'] = false;
    $response['message'] = "Metode request tidak valid";
}

// Close database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($response);
?>
