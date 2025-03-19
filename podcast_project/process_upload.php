<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = isset($_POST['status']) ? 1 : 0;
    $upload_date = date('Y-m-d H:i:s');

    // Handle file upload
    if (isset($_FILES['podcast_file']) && $_FILES['podcast_file']['error'] == 0) {
        $file = $_FILES['podcast_file'];
        $file_name = time() . '_' . basename($file['name']);
        $target_path = 'uploads/' . $file_name;

        // Create uploads directory if it doesn't exist
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            // Insert into database
            $query = "INSERT INTO episodes (title, description, category, file_path, upload_date, status, thumbnail) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($query);
            $thumbnail_path = '';
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
    $thumbnail = $_FILES['thumbnail'];
    $thumbnail_name = time() . '_' . basename($thumbnail['name']);
    $thumbnail_target_path = 'uploads/' . $thumbnail_name;
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    if (move_uploaded_file($thumbnail['tmp_name'], $thumbnail_target_path)) {
        $thumbnail_path = $thumbnail_name; // Store only the filename
    } else {
        die("Error uploading thumbnail.");
    }
}
$stmt->bind_param("sssssis", $title, $description, $category, $file_name, $upload_date, $status, $thumbnail_path);

            if ($stmt->execute()) {
                header("Location: myepisode.php");
                exit();
            } else {
                die("Error: " . $stmt->error);
            }
        } else {
            die("Error uploading file.");
        }
    } else {
        die("No file uploaded or error in upload.");
    }
}

header("Location: new_podcast.php");
exit();
?>