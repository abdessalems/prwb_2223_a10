<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_operation</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <meta http-equiv="refresh" content="10">
</head>
<body>

<a href="operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>"> Back</a>
<div class="view_edit_operation">

    <h3><?= $tricount->title ?> >Edit expense<h3/>
        <form action="operation/edit_operation/<?= $operation->id ?>/<?= $id_user ?>" method="post">
            <input type="submit" value="Save"> <br><br><br>


            <input type="text" id="titlee" name="titlee" value="<?= $operation->title ?>"><br><br>
            <input type="text" id="amount" name="amount" value="<?= $operation->amount ?> € "><br><br>

            <label for="date">Date</label><br>
            <input type="date" id="date" name="date" value="<?= $operation->operation_date ?>"><br><br>



            <form action="/action_page.php">
                <label for="Paid">Paid By</label><br>
                <select name="Paid" id="Paid">
                    <?php foreach ($operation_amount as $o): ?>
                    <option value="<?= $o->id ?>"><?= $o->full_name ?></option>
                    <?php endforeach; ?>
                </select>
            </form>



            <p>For Whom ? (select a least one ) </p>

            <?php foreach ($operation_amount as $o): ?>
                <input type="checkbox" id="<?= $o->full_name ?>" name="<?= $o->full_name ?>" checked>
                <label for="<?= $o->full_name ?>"><?= $o->full_name ?></label><input type="number" id="weight" name="weight" value="<?= $o->weight ?>" min="1"
                                                                                     max="10"><br>
            <?php endforeach; ?><br>

            <a href="">Delete this operation </a><br><br>


        </form>


</div>


</body>
</html>
