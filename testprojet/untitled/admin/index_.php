<?php
session_start();
//INDEX ADMIN
include('./src/php/utils/header.php');
include('./src/php/utils/all_includes.php');
?>

<!doctype html>
<html>
<head>
    <title><?php print $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
<div id="page" class="container">
    <header class="img_header"></header>
    <section id=" ">
        <nav>
            <?php if(file_exists('src/php/utils/admin_menu.php')){
                include('src/php/utils/admin_menu.php');
            }
            ?>
        </nav>
    </section>
    <section id="contenu">
        <div class="container">
            <?php
            include('./content/'.$_SESSION['page']);
            ?>
        </div>
    </section>

</div>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Archimaide 2025</span>
    </div>
</footer>
</body>
</html>


