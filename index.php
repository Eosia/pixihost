<?php
//vérifie si que l'image a été envoyée
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $error = 1;
    //vérifie la taille de l'image
    if($_FILES['image']['size'] < 3000000) {
        //Vérifie l'extension de l'image
        $informationsImage = pathinfo($_FILES['image']['name']);
        $extensionImage = $informationsImage['extension'];
        $extentionsArray = array('jpg', 'png', 'jpeg', 'svg', 'webp');

        if (in_array($extensionImage, $extentionsArray)) {
            $address = 'uploads/' . rand() . rand() . '.' . $extensionImage;
            move_uploaded_file($_FILES['image']['tmp_name'], $address);
            $error = 0;
        }
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PixiHost</title>
    <!--css boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--css boostrap /-->

    <style rel="stylesheet">

        .main {
            min-height: 60vh;
        }

        .img-tumb {
            max-width: 512px;
            height: auto;
        }

        footer {
            position: relative;
            bottom: 0;
            min-height: 10vh;
        }

    </style>

</head>
<body>

<header class="container-fluid bg-primary">
    <div class="row mx-auto text-center">
        <h1 class="col-12 mt-5">
            PixiHost
        </h1>
        <h2 class="col-12 mt-3 mb-5">
            Image hosting
        </h2>
    </div>
</header>

<div class="container-fluid my-5 main">

    <div class="row mx-auto">

        <article class="mx-auto border border-primary p-5">

            <h3>Hébergez votre image</h3>

            <?php
            if (isset($error) && $error == 0) {
                echo '
                      <img class="img-tumb mx-auto mt-3" src="' . $address . '">
                      <br>
                      <p class="text-uppercase mx-auto mt-5 mb-3 text-center">L\'url de votre image est :</p>
                      <input class="mx-auto col-12 py-2 px-3 border border-primary" type="text" value="https://pixihost.eosia.dev/' . $address . '">';
            } else if(isset($error) && $error == 1) {
                echo '<p class="mt-3">Votre image ne peut pas être envoyée.
                      <br>
                      <br>
                      Vérifiez son extension et sa taille (maximum 10mo).
                      </p>
                ';
            }



            ?>

            <!--formulaire pour envoyer une image-->
            <form action="index.php" method="post" enctype="multipart/form-data" class="mt-5">

                <p class="mx-auto text-center text-uppercase font-weight-bolder text-primary h5 mb-3">
                    maximum 10mo
                </p>

                <p class="mx-auto d-flex flex-column justify-between align-items-center">

                    <input type="file" name="image" required>
                    <br>
                    <button type="submit" class="text-uppercase mt-5 btn btn-primary">
                        Envoyer
                    </button>

                </p>

            </form>

        </article>

    </div>

</div>

<footer class="container-fluid bg-primary py-3">
    <p class="mx-auto text-center h4">2021©pixihost</p>
</footer>

<!--script boostrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
<!--script boostrap /-->

</body>
</html>