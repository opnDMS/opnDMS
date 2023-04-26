<?php 

// Check login
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true) header("Location: /login");

// Database connection
require_once("../config.php");
$con = mysqli_connect(db_host, db_user, db_password, db_name);
if(!$con) die("Connection failed: " . mysqli_connect_error());

// Get Document classes
$stmt = $con->prepare("SELECT * FROM classes");
$stmt->execute();
$result = $stmt->get_result();
$classes = array();
while($row = $result->fetch_assoc()) $classes[$row['id']] = $row['name'];
$stmt->close();

// Get Document categories
$stmt = $con->prepare("SELECT * FROM categories");
$stmt->execute();
$result = $stmt->get_result();
$categories = array();
while($row = $result->fetch_assoc()) $categories[$row['id']] = $row['name'];
$stmt->close();

// Get Document subcategories
$stmt = $con->prepare("SELECT * FROM subcategories");
$stmt->execute();
$result = $stmt->get_result();
$subcategories = array();
while($row = $result->fetch_assoc()) $subcategories[$row['id']] = $row['name'];
$stmt->close();

// Get Document subsubcategories
$stmt = $con->prepare("SELECT * FROM subsubcategories");
$stmt->execute();
$result = $stmt->get_result();
$subsubcategories = array();
while($row = $result->fetch_assoc()) $subsubcategories[$row['id']] = $row['name'];
$stmt->close();

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>opnDMS - upload</title>
    <link rel="icon" type="image/x-icon" href="/res/img/favicon.ico" />
    <link rel="stylesheet" href="/res/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/res/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/res/css/fonts.css">
    <link rel="stylesheet" href="/res/css/main.css">
    <link rel="stylesheet" href="./style.css">
    <script src="../res/js/jquery/jquery-3.6.1.min.js"></script>
</head>

<body>
    <header>
            <span class="logo">opnDMS</span>
            <nav class="nav">
                <a href="../">Home</a>
                <a href="#">Upload</a>
                <a href="#">Manage</a>
                <a href="#">Search</a>
            </nav>
            <div class="controls"></div>
        </header>
    <main>
        <h1>Upload file</h1>
        <form action="upload-file.php" method="post" enctype="multipart/form-data">
            <!-- File -->
            <input type="file" name="file" id="file" aria-label="Choose a file to upload" required>
            <label id="file-input-label" class="button-std" for="file">Choose a file...</label>
            <br>
            <!-- Selection of document class -->
            <h3>Document class</h3>
            <select class="button-std" name="classes" id="classes" required>
                <?php foreach($classes as $id => $name) echo "<option value='$id'>$name</option>"; ?>
            </select>
            <br>
            <!-- Document Category -->
            <h3>Document category</h3>
            <select class="button-std" name="category" id="category" required>
                <?php foreach($categories as $id => $name) echo "<option value='$id'>$name</option>"; ?>
            </select>
            <br>
            <!-- Document Subcategory -->
            <h3>Document subcategory</h3>
            <select class="button-std" name="subcategory" id="subcategory" required>
                <?php foreach($subcategories as $id => $name) echo "<option value='$id'>$name</option>"; ?>
            </select>
            <br>
            <!-- Document Subsubcategory -->
            <h3>Document subsubcategory</h3>
            <select class="button-std" name="subsubcategory" id="subsubcategory" required>
                <?php foreach($subsubcategories as $id => $name) echo "<option value='$id'>$name</option>"; ?>
            </select>
            <br>
            <!-- Document Subject -->
            <h3>Document subject</h3>
            <input type="text" name="subject" id="subject">
            <br>
            <!-- Document Title -->
            <h3>Document title</h3>
            This will be shown in the document list.<br>
            <input type="text" name="title" id="title" required>
            <br>
            <!-- Document summary -->
            <h3>Document summary</h3>
            <textarea name="summary" id="summary" cols="30" rows="10"></textarea>
            <br>
            <!-- Document dates -->
            <h3>Document dates</h3>
            Date: <input type="date" name="date" id="date"><br>
            Start date: <input type="date" name="startdate" id="startdate"><br>
            End date: <input type="date" name="enddate" id="enddate"><br>
            <br>
            <!-- Document Tags -->
            <h3>Document tags</h3>
            Divide tags with a comma (,)<br>
            <input type="text" name="tags" id="tags">
            <br>
            <!-- Document RL-Storage -->
            <h3>Document Storage</h3>
            If the document is also stored somewhere in Real Life, please enter the location here.<br>
            Shelf: <input type="number" name="shelf" id="shelf"><br>
            Binder: <input type="number" name="binder" id="binder"><br>
            <!-- Submit -->
            <h3>Hochladen</h3>
            <input class="button-std" type="submit" value="Upload">
        </form>
    </main>
    <script src="/res/js/themes/themes.js"></script>
    <script src="./style.js"></script>
</body>

</html>