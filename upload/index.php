<?php

// Check login
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true)
    header("Location: /login");

// Database connection
require_once("../config.php");
$con = mysqli_connect(db_host, db_user, db_password, db_name);
if (!$con)
    die("Connection failed: " . mysqli_connect_error());

// Get Document classes
$stmt = $con->prepare("SELECT * FROM classes");
$stmt->execute();
$result = $stmt->get_result();
$classes = array();
while ($row = $result->fetch_assoc())
    $classes[$row['id']] = $row['name'];
$stmt->close();

// Get Document categories
$stmt = $con->prepare("SELECT * FROM categories");
$stmt->execute();
$result = $stmt->get_result();
$categories = array();
while ($row = $result->fetch_assoc())
    $categories[$row['id']] = $row['name'];
$stmt->close();

// Get Document subcategories
$stmt = $con->prepare("SELECT * FROM subcategories");
$stmt->execute();
$result = $stmt->get_result();
$subcategories = array();
while ($row = $result->fetch_assoc())
    $subcategories[$row['id']] = $row['name'];
$stmt->close();

// Get Document subsubcategories
$stmt = $con->prepare("SELECT * FROM subsubcategories");
$stmt->execute();
$result = $stmt->get_result();
$subsubcategories = array();
while ($row = $result->fetch_assoc())
    $subsubcategories[$row['id']] = $row['name'];
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
    <script src="/res/js/jquery/jquery-3.6.1.min.js"></script>
</head>

<body>
    <header>
            <span class="logo">opnDMS</span>
            <nav class="nav">
            <a 
                <?php if ($_SERVER['SCRIPT_NAME'] == "/index.php") { ?> 
                    class="active" 
                <?php   } else {  ?>
                    class=""
                <?php } ?> 
                    href="/">Home
            </a>
            <a 
                <?php if ($_SERVER['SCRIPT_NAME'] == "/upload/index.php") { ?> 
                    class="active" 
                <?php   } else {  ?>
                    class=""
                <?php } ?> 
                    href="/upload/">Upload
            </a>
            <a 
                <?php if ($_SERVER['SCRIPT_NAME'] == "/manage/index.php") { ?> 
                    class="active" 
                <?php   } else {  ?>
                    class=""
                <?php } ?> 
                    href="/">Manage
            </a>
            <a 
                <?php if ($_SERVER['SCRIPT_NAME'] == "/search/index.php") { ?> 
                    class="active" 
                <?php   } else {  ?>
                    class=""
                <?php } ?> 
                    href="/">Search
            </a>
            </nav>
            <div class="controls"></div>
        </header>
    <main>
        <h1>Upload file</h1>
        <form action="upload-file.php" method="post" enctype="multipart/form-data">
        <div class="uploadcontainer">
            <div class="docpreview">

            </div>
            <div class="docupload">
                <!-- File -->
                <div class="form-container" id="docfile">
                    <input type="file" name="file" id="file" aria-label="Choose a file to upload" required>
                    <label id="file-input-label" class="button-std" for="file">Choose a file...</label>
                </div>
            </div>
            <div class="docdetails">
                <!-- Selection of document class -->
            <div class="form-container" id="class">
            <h3>Document class</h3>
            <select class="button-black" name="classes" id="classes" required>
                <?php foreach ($classes as $id => $name)
                    echo "<option id='classes$id' value='$id'>$name</option>"; ?>
            </select>
            </div>
            <!-- Document Category -->
            <div class="form-container" id="cat">
            <h3>Document category</h3>
            <select class="button-black" name="category" id="category" required>
                <?php foreach ($categories as $id => $name)
                    echo "<option id='cat$id' value='$id'>$name</option>"; ?>
            </select>
            </div>
            <!-- Document Subcategory -->
            <div class="form-container" id="subcat">
            <h3>Document subcategory</h3>
            <select class="button-black" name="subcategory" id="subcategory" required>
                <?php foreach ($subcategories as $id => $name)
                    echo "<option id='subcat$id' value='$id'>$name</option>"; ?>
            </select>
            </div>
            <!-- Document Subsubcategory -->
            <div class="form-container" id="subsubcat">
            <h3>Document subsubcategory</h3>
            <select class="button-black" name="subsubcategory" id="subsubcategory" required>
                <?php foreach ($subsubcategories as $id => $name)
                    echo "<option id='subsubcat$id' value='$id'>$name</option>"; ?>
            </select>
            </div>
            <!-- Document Subject -->
            <div class="form-container" id="docsubject">
            <h3>Document subject</h3>
            <input type="text" name="subject" id="subject" maxlength="128" placeholder="Subject">
            </div>
            <!-- Document Title -->
            <div class="form-container" id="doctitle">
            <h3>Document title</h3>
            <p>This will be shown in the document list.</p>
            <input type="text" name="title" id="title" maxlength="128" placeholder="Title" required>
            </div>
            <!-- Document summary -->
            <div class="form-container" id="docsummary">
            <h3>Document summary</h3>
            <textarea name="summary" id="summary" cols="30" rows="10" maxlength="1024" placeholder="Summary"></textarea>
            </div>
            <!-- Document dates -->
            <div class="form-container" id="docdates">
            <h3>Document dates</h3>
            <div id="date-container">
            <label for="date">Date: </label><input type="date" name="date" id="date">
            </div>
            <div class="startdate-container">
            <label for="startdate">Start date: </label><input type="date" name="startdate" id="startdate">
            </div>
            <div class="enddate-container">
            <label for="enddate">End date: </label><input type="date" name="enddate" id="enddate">
            </div>    
            </div>
            <!-- Document Tags -->
            <div class="form-container" id="doctags">
            <h3>Document tags</h3>
            <p>Divide tags with a comma (,)</p>
            <input type="text" name="tags" id="tags" placeholder="e.g.: school,important,confidential">
            </div>
            <!-- Document RL-Storage -->
            <div class="form-container" id="rl-storage">
            <h3>Document Storage</h3>
            <p>If the document is also stored somewhere in Real Life, please enter the location here.</p>
            <div id="shelf-container">
                <label for="shelf">Shelf: </label>
                <input type="number" name="shelf" id="shelf">
            </div>
            <div id="folder-container">
                <label for="binder">Binder: </label>
                <input type="number" name="binder" id="binder">
            </div>
            </div>
            <!-- Submit -->
            <h3>Hochladen</h3>
            <input class="button-std" type="submit" value="Upload">
            </div>
        </div>
        </form>
    </main>
    <!--<script src="/res/js/themes/themes.js"></script>-->
    <script src="./style.js"></script>
</body>

</html>