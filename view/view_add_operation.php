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

<a href=""> Back</a>
<div class="view_edit_operation">

    <h3><?= $tricount->title ?> >Edit expense</h3>
        <form action="operation/add_operation/<?= $tricount->id ?>" method="post">
            <input type="submit" value="Save"> <br><br><br>

            <input type="text" id="title" name="title" value=""><br><br>
            <input type="text" id="amount" name="amount" value=" € "><br><br>

            <label for="date">Date</label><br>
            <input type="date" id="date" name="date" value=""><br><br>

            <?php foreach ($paidBy as $person): ?>
                <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox" >
                <label for="check"><?=$person['full_name']  ?></label> <input type="number" id="weight"
                                                                              name="weight"
                                                                              min="1"
                                                                              max="10"><br>


            <?php endforeach; ?><br>

            <p>Paid By</p>


            <select id="paidBy" name="paidBy">
                <option  value="">Add new subscriber</option>
                <?php
                foreach ($paidBy as $paidBy) {
                    ?>
                    <option   value="<?= $paidBy['full_name'] ?>"><?= $paidBy['full_name'] ?> </option>
                    <?php
                }
                ?>

            </select>













        </form>


</div>


</body>
</html>