<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    if (isset($_REQUEST["nombre"])) {
        $nombre = strtolower(trim($_REQUEST["nombre"]));
        $datos = @file_get_contents("https://pokeapi.co/api/v2/pokemon/$nombre/");
        $pokemon = json_decode($datos);

        if ($datos == "") {
            // header("location: index.php?error=error",TRUE,301);
            // exit();
            echo "<meta http-equiv='refresh' content='0;url=index.php?error=error'>";
        } else {
            if ($pokemon->types[0]->type->name != null) { ?>
                <div class="principal">
                    <div class="superior">
                        <div class="circulo_superior"></div>
                    </div>
                    <div class="medio">
                        <div class="div1">
                            <div>
                                <?php echo "<b>Nombre: </b>  $pokemon->name" ?>
                            </div>
                            <!-- Sprit -->
                            <div class="sprit">
                                <div class="anterior">
                                    <form action="index.php" method="POST">
                                        <input type="text" hidden value="<?= ($pokemon->id) - 1; ?>" name="nombre">
                                        <input type="submit" value="<--" class="botoncito_anterior">
                                    </form>
                                </div>
                                <?php echo "<img src='" . $pokemon->sprites->front_default . "'>"; ?>
                                <div class="siguiente">
                                    <form action="index.php" method="POST">
                                        <input type="text" hidden value="<?= ($pokemon->id) + 1; ?>" name="nombre">
                                        <input type="submit" value="-->" class="botoncito_siguiente">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="div2">
                            <div class="datos_basicos">
                                <?php
                                //Numero y Nombre
                                echo "<b>Number:</b> #" . $pokemon->id . "<br>";

                                //Tipo/s
                                echo "<b>Type:</b> " . $pokemon->types[0]->type->name;
                                if (count($pokemon->types) > 1) {
                                    echo "/" . $pokemon->types[1]->type->name . "<br>";
                                } else {
                                    echo "<br>";
                                }

                                //Peso
                                echo "<b>Weight:</b> " . ($pokemon->weight) / 10 . "kg <br>";

                                //Altura
                                echo "<b>Height:</b> " . ($pokemon->height) / 10 . "m <br><br>";
                                ?>
                                <form action="index.php" method="POST">
                                    <input type="submit" value="Volver a la busqueda" class="botoncito">
                                </form>
                                <form action="index.php" method="POST">
                                    <input type="text" hidden value="<?= rand(1, 1008); ?>" name="nombre">
                                    <input type="submit" value=" Realizar busqueda aleatoria " class="botoncito">
                                </form>
                            </div>
                            <div class="stats">
                                <?php
                                //Stats
                                echo "<b>Hp:</b> " . $pokemon->stats[0]->base_stat . "<br>";
                                echo "<b>Attack:</b> " . $pokemon->stats[1]->base_stat . "<br>";
                                echo "<b>Defense:</b> " . $pokemon->stats[2]->base_stat . "<br>";
                                echo "<b>Special-Atack:</b> " . $pokemon->stats[3]->base_stat . "<br>";
                                echo "<b>Special-Defense:</b> " . $pokemon->stats[4]->base_stat . "<br>";
                                echo "<b>Speed:</b> " . $pokemon->stats[5]->base_stat . "<br>";
                                echo "<u><b>Total:</b></u> " . $pokemon->stats[0]->base_stat + $pokemon->stats[1]->base_stat + $pokemon->stats[2]->base_stat + $pokemon->stats[3]->base_stat + $pokemon->stats[4]->base_stat + $pokemon->stats[5]->base_stat;
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="inferior">
                        <div class="circulo_inferior"></div>
                    </div>
                </div>
        <?php }
        }
    } else { ?>



        <!-- Formulario de acceso -->
        <div class="principal">
            <div class="superior">
                <div class="circulo_superior"></div>
            </div>
            <div class="medio">
                <div class="busqueda">
                    <h1>Pokedex</h1><br><br>
                    <form action="index.php" method="POST">
                        <span>Introduce un pokemon o su id: </span><br>
                        <?php
                        if (isset($_REQUEST["error"])) {
                            echo '<input type="text" name="nombre" id="nombre" class="entradita" placeholder="Pokemon no encotrado" required>';
                        } else {
                            echo '<input type="text" name="nombre" id="nombre" class="entradita" required>';
                        }
                        ?>
                        <input type="submit" name="busqueda" value="Realizar busqueda" class="botoncito"><br><br>
                    </form>


                    <form action="index.php" method="POST">
                        <span>Pulsa para leer una entrada aleatoria:</span>
                        <input type="text" hidden value="<?= rand(1, 1008); ?>" name="nombre">
                        <input type="submit" value=" Realizar busqueda aleatoria " class="botoncito">
                    </form>
                </div>
            </div>
            <div class="inferior">
                <div class="circulo_inferior"></div>
            </div>
        </div>

    <?php }
    ?>


</body>

</html>