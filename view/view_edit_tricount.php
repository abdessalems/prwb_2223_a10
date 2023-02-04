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
</head>
<body>

<a href='tricount/view_tricount/<?=  $tricount->id ?>/<?= $id_user ?>'> Back</a>
<div class="view_ operation ">
    <h3><?= $tricount->title ?> > Edit </h3>
    <div class="d-flex justify-content-center mt-3">
        <div class="title">
            <h3>Edit Tricounts</h3>
        </div>
    </div>
        <form id="addForm" action="tricount/EditTricounts/<?= $tricount->id ?>/<?= $id_user ?>" method="post">
            <input type="submit" value="Save"> <br><br><br>
            <div>
                <label > title :</label><br>
                <input type="text" id="title" name="title" value="<?= $tricount->title ?>"><br><br>
            </div>

            <p>paid by </p>
            <select name="subscriber" id="subscriber">
                <?php foreach ($Nosubscribers as $user): ?>
                    <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
                <?php endforeach ;?>
            </select>

            <div>
                <label >description(optional) :</label><br>
                <textarea name="description" rows="10" cols="20" > <?= $tricount->description ?></textarea>
            </div>
            <div>
                <ul>
                    <?php foreach ($subscribers as $subscriber): ?>
                        <li>
                            <?= $subscriber['full_name'] ?>
                            <form action="tricount/deleteSubscriber/<?= $tricount->id ?>/<?= $subscriber['full_name'] ?>" method="post">

                                <input type="submit" value="Delete">
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>


            <form action="tricount/first_delete/<?= $tricount->id ?>/<?= $id_user ?>" method="post" >
                <input type="submit" name="monBouton" value="delete">
            </form>
    </div>
    </form>
</div>
</body>
</html>