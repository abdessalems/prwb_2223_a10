<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>Edit Tricount</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


</head>
<body>




<form id="addForm" action="tricount/EditTricounts/<?= $tricount->id ?>/<?= $id_user ?>" method="post">
    <div style="background-color: lightsteelblue; padding: 10px;">
        <div class="d-flex justify-content-between mt-3">
            <button style="color:red; background-color:white;  border: 1px solid red;">
                <a href="" style="text-decoration: none; color: red;">Cancel</a>
            </button>

            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h3><?= $tricount->title ?> > Edit</h3>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Save"/>
        </div>
    </div>

    <div>
        <label for="exampleFormControlInput1" class="form-label">Title:</label><br>
        <input type="text" id="title" name="title" class="form-control" value="<?= $tricount->title ?>"><br><br>
    </div>

    <div class="form-floating mb-3">
        <label>Description (optional):</label><br>
        <textarea class="form-control mb-3" name="description"><?= $tricount->description ?></textarea>
    </div>
</form>

<form action="tricount/editSubscriber/<?= $tricount->id ?>/<?= $id_user ?>" method="post">
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Subscribers</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($subscribers as $subscriber): ?>
                <tr>
                    <td><?= $subscriber['full_name'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex">
        <select class="form-control me-2" aria-label="Default select example" name="subscriber" id="subscriber">
            <option selected>--Add a new subscriber--</option>
            <?php foreach ($Nosubscribers as $user): ?>
                <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
            <?php endforeach; ?>
        </select>
        <input class="btn btn-primary" type="submit" name="add_subsciber" value="Add">
    </div>
</form>

<footer>
    <form action="tricount/first_delete/<?= $tricount->id ?>/<?= $id_user ?>" method="post">
        <input class="btn btn-danger w-100" type="submit" style="background-color:red; color:white;" name="monBouton" value="delete this tricount">
    </form>
</footer>
</body>

</html>
