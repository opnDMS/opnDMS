<?php 

session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true) header("Location: /login");

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>opnDMS</title>
    <link rel="icon" type="image/x-icon" href="/res/img/favicon.ico" />
    <link rel="stylesheet" href="/res/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/res/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/res/css/fonts.css">
    <link rel="stylesheet" href="/res/css/main.css">
    <link rel="stylesheet" href="/res/css/index.css">
</head>

<body>
    <header>
        <span>opnDMS</span>
    </header>
    <main>
        <h1 class="text-center">Welcome to opnDMS!</h1>
    </main>
    <script src="/res/js/themes/themes.js"></script>
</body>

</html>