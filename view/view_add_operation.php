<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <base href="<?=$web_root?>"/>

    <button> <a href='tricount/tricount/<?= $tricount->id ?>'>Cancel</a> </button>

</head>
<body>

<form  action="operation/add_operation/<?= $tricount->id ?>" method="post">
    <input type="submit" value="Save"> <br><br>



            <input id="title" name="title" type="text"  ><br><br>


            <input id="amount" name="amount"   > <br><br>
            <label for="date">Date</label><br>
            <input type="date" id="date" name="date" value=""><br><br>

            <p> Paid  by </p>
                <select name="paid" id="pets">
                    <?php foreach ($paidBy as $user): ?>
                        <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
                    <?php endforeach ;?>
                </select>

            <p>For whom? (select at least one)</p>

                <form action="operation/add_operation" method="post">
                    <?php foreach ($paidBy as $index => $person): ?>
                        <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox_<?= $index ?>" >
                        <label for="check"><?=$person['full_name']  ?></label>
                        <input type="number" id="weight_<?= $index ?>" name="weight_<?= $index ?>" min="1" max="10"><br>
                    <?php endforeach; ?><br>

                </form>


</form>

</body>
</html>

