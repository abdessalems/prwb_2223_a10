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
</head>
<body>

<a href='operation/view_operation/<?=  $operation->id ?>'> Back</a>
<div class="view_ edit_operation ">
    <h3><?= $tricount->title ?> > Edit expense <h3/>
        <form action="operation/edit_operation" method="post">
              <input type="submit" value="Save"> <br><br><br>



            <input type="text" id="title" name="title" value="<?= $operation->title ?>"><br><br>
            <input type="text" id="amount" name="amount" value="<?= $operation->amount ?> € "><br><br>

            <label for="date">Date</label><br>
            <input type="date" id="date" name="date" value="<?= $operation->operation_date?>"><br><br>



            <p>Paid By</p>
            <?php foreach ($operation_amount as $o): ?>
             <input type="radio" id="<?= $o->full_name ?>" name="Paid" value="<?= $o->full_name ?>">
             <label for="<?= $o->full_name ?>"><?= $o->full_name ?></label><br>
            <?php endforeach; ?> <br>

            <p>For Whom ? (select a least one ) </p>

                <?php foreach ($operation_amount as $o): ?>
                <input type="checkbox" id="<?= $o->full_name ?>" name="<?= $o->full_name ?>" checked>
                <label for="<?= $o->full_name ?>"><?= $o->full_name ?></label><input type="number" id="weight" name="title" value="<?= $o->weight ?>" min="1" max="10"><br>
                <?php endforeach; ?><br>

            <a href="">Delete this operation </a><br><br>








        </form>



</div>


</body>
</html>

