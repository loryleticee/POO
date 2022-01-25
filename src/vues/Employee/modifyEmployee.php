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
            if (isset($error)) {
               echo $error;
               unset($error);
            }
        ?>
    </div>
    <?php 
        $id = isset($employeeDatas["id"]) ? $employeeDatas["id"] : "";
    ?>
    <form action=<?="/employee/$id"?> method="POST" id="form_controller">
        <label for="lastname">NOM: </label>
        <input 
            type="text" 
            name="lastname" 
            id="lastname"
            value="<?php
               echo isset($employeeDatas["lastname"]) 
               ? $employeeDatas["lastname"] 
               : "";
            ?>"
       />
        <label for="firstname">PRENOM: </label>
        <input 
            type="text" 
            name="firstname" 
            id="firstname"
            value="<?php
               echo isset($employeeDatas["firstname"]) ? $employeeDatas["firstname"] : "";
            ?>"
        />
        <label for="badge_number">NUMERO DE BADGE: </label>
        <input 
            type="number" 
            name="badge_number" 
            id="badge_number"
            value="<?php
               echo isset($employeeDatas["badge_number"]) ? $employeeDatas["badge_number"] : "";
            ?>"
        />
        <input type="submit" value="ENREGISTRER LES MODIFICATIONS">
    </form>
</body>

</html>
