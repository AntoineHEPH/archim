<?php
session_start();
// INDEX ADMIN
include('./src/php/utils/header.php');
include('./src/php/utils/all_includes.php');
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php print $title; ?></title>

    <script src="./assets/js/modifier_table.js" defer></script>
    <script src="./assets/js/verifierLundi.js" defer></script>
    <script src="./assets/js/searchTutore.js" defer></script>
    <script src="./assets/js/searchTuteur.js" defer></script>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">

<div id="page" class="container flex-grow-1 d-flex flex-column px-3">
    <header class="img_header"></header>

    <section>
        <nav>
            <?php
            if (file_exists('src/php/utils/admin_menu.php')) {
                include('src/php/utils/admin_menu.php');
            }
            ?>
        </nav>
    </section>

    <section id="contenu" class="flex-grow-1">
        <div class="container my-4">
            <?php
            include('./content/' . $_SESSION['page']);
            ?>
        </div>
    </section>
</div>

<?php include('./src/php/utils/footer.php'); ?>

</body>
</html>
