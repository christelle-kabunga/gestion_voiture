<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Accueil</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php require_once('style.php') ?>
    <style>
    .body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(../assets/image/DK6.png);
        background-position: center;
        min-height: calc(100vh - 60px);
        background-size: auto;
        display: flex;
        align-items: center;
    }
    </style>

</head>

<body>

    <?php require_once('aside.php') ?>

    <main class="main body" id="main">
        <div class="container   col-xl-12 col-lg-6 col-md-4 col-sm-12 mx-auto text-center">
            <h1 class="text-white mt-5 pt-5 h1"><b>Boutique DK</b></h1>
            <h1 class="mx-auto text-white text-center ">Bienvenu dans ce site de la gestion de stock boutique</h1>
            <p class="text-white text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates amet ad mollitia velit omnis! <br>
             Est nulla quia provident minima consequatur suscipit fugit consectetur culpa consequuntur <br>
              veniam, porro repudiandae, nihil a.</p>
            <button class="btn btn-outline-success btn-lg mt-3 p-3 "><b>voir plus sur ce site</b> <i class="bi bi-arrow-right"></i> </button>
        </div>
    </main>
    <?php require_once('script.php') ?>


</html>