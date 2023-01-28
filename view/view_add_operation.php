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

    <h3><?= $tricount->title ?> >Edit expense<h3/>
        <form action="operation/add_operation" method="post">
            <input type="submit" value="Save"> <br><br><br>


            <input type="text" id="title" name="title" value=""><br><br>
            <input type="text" id="amount" name="amount" value=" € "><br><br>

            <label for="date">Date</label><br>
            <input type="date" id="date" name="date" value=""><br><br>

            <p>Paid By</p>


            <select id="subscriber" name="subscriber">
                <option  value="">Add new subscriber</option>
                <?php
                foreach ($paydBy as$PaydBy) {
                    ?>
                    <option   value="<?= $paydBy['full_name']   ?>"><?= $paydBy['full_name']  ?></option>
                    <?php
                }
                ?>
            </select>


            <p>For Whom ? (select a least one ) </p>


                <input type="checkbox" id="" name=">" checked>
                <label for=""></label><input type="number" id="weight" name="weight"  value="" min="1"  max="10"><br>










        </form>


</div>


</body>
</html>