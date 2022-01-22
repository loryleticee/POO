<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE MODIFIER D'UN EMPLOYÉ</title>
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
            if (array_key_exists("error", $_SESSION)) {
               echo $_SESSION["error"];
               unset($_SESSION["error"]);
            }
        ?>
    </div>
    <?php 
        $id = isset($_SESSION["employeeDatas"]["id"]) ? $_SESSION["employeeDatas"]["id"] : "";
    ?>
    <form action=<?="/employee/$id"?> method="POST" id="form_controller">
        <label for="lastname">NOM: </label>
        <input 
            type="text" 
            name="lastname" 
            id="lastname"
            value="<?php
               echo isset($_SESSION["employeeDatas"]["lastname"]) 
               ? $_SESSION["employeeDatas"]["lastname"] 
               : "";
            ?>"
       />
        <label for="firstname">PRENOM: </label>
        <input 
            type="text" 
            name="firstname" 
            id="firstname"
            value="<?php
               echo isset($_SESSION["employeeDatas"]["firstname"]) ? $_SESSION["employeeDatas"]["firstname"] : "";
            ?>"
        />
        <label for="badge_number">NUMERO DE BADGE: </label>
        <input 
            type="number" 
            name="badge_number" 
            id="badge_number"
            value="<?php
               echo isset($_SESSION["employeeDatas"]["badge_number"]) ? $_SESSION["employeeDatas"]["badge_number"] : "";
            ?>"
        />
        <input type="submit" value="ENREGISTRER LES MODIFICATIONS">
    </form>
</body>

</html>
