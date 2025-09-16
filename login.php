<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videolclub</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main>
        <form action="router.php" method="POST">
            <fieldset>
                <legend>Inicio sesión</legend>
                <label for="nombre">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="input" placeholder="Ingrese su nombre" required>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input" placeholder="Ingrese su mail" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="input" placeholder="Ingrese su contraseña" required >
                <button type="submit" class="button">Enviar </button>
            </fieldset>
        </form>
    </main>
</body>
</html>