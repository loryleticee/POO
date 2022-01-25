<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Borrow</title>
    <style>
        #form_controller {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            gap: 0.5rem;
            align-items: center;
            flex: 1 auto;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <form method="POST" action="/borrow" id="form_controller">
        <label for="date">Date: </label>
        <input name="date" type="date" value="2018-02-02" required />
        <label for="member">Id_Member: </label>
        <input name="member" type="number" value="4" required />
        <label for="book">Id_Book: </label>
        <input name="book" type="number" value="4" required />
        <input type="submit" class="btn-primary" value="Add" />
    </form>
</body>

</html>