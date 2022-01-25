<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>

        #form_controller {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            align-items: center;
            flex: 1 auto;
        }
    </style>
</head>

<body>
    <div>
        <?php 
            if (isset($error)) {
               echo $error;
               unset($error);
            }
        ?>
    </div>
    <form action="/employee" method="POST" id="form_controller">
        <label for="login">Email: </label>
        <input type="text" name="login" id="login">
        <label for="password">Mot de passe: </label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Se connecter">
    </form>
</body>

</html>
