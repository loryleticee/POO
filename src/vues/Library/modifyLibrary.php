<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Library</title>
</head>

<body>
    <form method="POST" action='<?= "/library/$sId" ?>'>
        <label for="name">NAME: </label>
        <input name="name" type="text" value= "<?php echo $obj->getName() ?>" required />
        <input type="submit" value="Modify" />
    </form>
</body>

</html>