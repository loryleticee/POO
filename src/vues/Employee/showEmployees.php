<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYÉS</title>
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
        if(empty($employees)) {
            echo "il n'y a aucun resultat";
        }

        foreach ($employees as $key => $value) :?>
            
            <div>
                <?= $value->getFirstname();?>
            </div>
            <div>
                <?= $value->getLastname();?>
            </div>
        <?php 
        endforeach;
        ?>
</body>

</html>
