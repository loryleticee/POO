<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE AJOUT D4UN EMPLOYÉ</title>
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
        <label for="lastname">NOM: </label>
        <input type="text" name="lastname" id="lastname">
        <label for="firstname">PRENOM: </label>
        <input type="text" name="firstname" id="firstname">
        <label for="badge_number">NUMERO DE BADGE: </label>
        <input type="number" name="badge_number" id="badge_number">
        <input type="submit" value="ENREGISTRER">
    </form>
</body>

</html>
