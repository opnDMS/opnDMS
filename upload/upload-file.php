<?php

// Check login
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) header("Location: /login");

// Database connection
require_once("../config.php");
$con = mysqli_connect(db_host, db_user, db_password, db_name);
if (!$con) die("Connection failed: " . mysqli_connect_error());

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the uploaded file
    $uploaded_file = $_FILES['file'];
    if (empty($uploaded_file['name'])) {
        die('No file was uploaded');
    }
    $upload_filename = $uploaded_file['name'];

    // Store the form data in variables
    $document_class = $_POST['classes'];
    $document_category = $_POST['category'];
    $document_subcategory = $_POST['subcategory'];
    $document_subsubcategory = $_POST['subsubcategory'];
    $document_subject = $_POST['subject'];
    $document_title = $_POST['title'];
    $document_summary = $_POST['summary'];
    $document_date = $_POST['date'];
    $document_startdate = $_POST['startdate'];
    $document_enddate = $_POST['enddate'];
    $document_tags = $_POST['tags'];
    $document_shelf = $_POST['shelf'];
    $document_binder = $_POST['binder'];

    // If no value has been set, set the value to NULL
    // This is necessary because the database does not allow empty values but NULL-values
    // Vars to do this: subcategory, subsubcategory, subject, summary, date, date_started, date_ended, tags, shelf, binder
    if (empty($document_subcategory)) $document_subcategory = NULL;
    if (empty($document_subsubcategory)) $document_subsubcategory = NULL;
    if (empty($document_subject)) $document_subject = NULL;
    if (empty($document_summary)) $document_summary = NULL;
    if (empty($document_date)) $document_date = NULL;
    if (empty($document_startdate)) $document_startdate = NULL;
    if (empty($document_enddate)) $document_enddate = NULL;
    if (empty($document_tags)) $document_tags = NULL;
    if (empty($document_shelf)) $document_shelf = NULL;
    if (empty($document_binder)) $document_binder = NULL;

    // Reformat all dates to mysql format
    $document_date = date("Y-m-d", strtotime($document_date));
    $document_startdate = date("Y-m-d", strtotime($document_startdate));
    $document_enddate = date("Y-m-d", strtotime($document_enddate));

    // Check if tags are comma-separated-values and do not contain special characters
    if (preg_match('/[^a-zA-Z0-9, ]/', $document_tags)) die('Tags must be comma-separated-values and must not contain special characters');
    // Reformat tags to lowercase and remove whitespaces
    $document_tags = strtolower($document_tags);
    // Convert tags to list by "," and " ," and ", " and " , "
    $document_tags = explode('/[, ]/', $document_tags);
    // Remove empty elements from array
    $document_tags = array_filter($document_tags);
    // Remove duplicate elements from array
    $document_tags = array_unique($document_tags);
    // Convert array to json
    $document_tags = json_encode($document_tags);
 
    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO documents (class, category, subcategory, subsubcategory, subject, title, summary, date, date_started, date_finished, tags, shelf_num, binder_num, filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiisssssssis", $document_class, $document_category, $document_subcategory, $document_subsubcategory, $document_subject, $document_title, $document_summary, $document_date, $document_startdate, $document_enddate, $document_tags, $document_shelf, $document_binder, $upload_filename);
    $stmt->execute();
    // Get the identifier of the inserted row (the row "identifier" is auto-incremented)
    $document_id = $stmt->insert_id;
    $stmt->close();

    // Generate the storage-filename (use the document identifier and add zeroes to the left to get a fixed length of 8 digits)
    $store_filename = str_pad($document_id, 8, '0', STR_PAD_LEFT);
    // Use the store filename and update the database entry row "display_identifier"
    $stmt = $con->prepare("UPDATE documents SET display_identifier = ? WHERE identifier = ?");
    $stmt->bind_param("si", $store_filename, $document_id);
    $stmt->execute();
    $stmt->close();

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($uploaded_file['tmp_name'], storage_dir . $store_filename)) {

        // Do something with the uploaded file

    } else {
        // Handle the file upload error here
    }
}
