<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <base href="<?=$web_root?>"/>
    <button> <a href='tricount/tricount/<?= $tricount->id ?>'>Cancel</a> </button>

</head>
<body>

<a href=""> Back</a>
<div class="view_edit_operation">

    <h3><?= $tricount->title ?> >Edit expense</h3>
    <form action="operation/add_operation/<?= $tricount->id ?>" method="post">
        <input type="submit" value="Save"> <br><br><br>

        <input type="text" id="title" name="title" value=""><br><br>
        <input type="text" id="amount" name="amount" value="  "><br><br>

        <label for="date">Date</label><br>
        <input type="date" id="date" name="date" value=""><br><br>





        <form action="operation/add_operation" method="post">
        <?php foreach ($paidBy as $index => $person): ?>
            <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox_<?= $index ?>" >
            <label for="check"><?=$person['full_name']  ?></label>
            <input type="number" id="weight_<?= $index ?>" name="weight_<?= $index ?>" min="1" max="10"><br>
        <?php endforeach; ?><br>

        </form>

        <p>Paid By</p>


        <select id="paid" name="paid">

            <option name="paid" value="">Add new subscriber</option>
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

