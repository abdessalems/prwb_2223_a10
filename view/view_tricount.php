<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>users</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<a href="user/tricount">Back</a>
<div  class="title"><h3><?= $tricount->title ?> > Expenses <h3/>
        <a href="your link of edit here yassin ok ">edite</a>
</div>
    <table>
        <?php foreach ($operations as $operation): ?>

        <tr>
            <th> <?= $operation->title ?> </th>
            <th> <?= $operation->amount ?> </th>
        </tr>

        <tr>
            <td> Paid par <?= $operation->name_paid ?> </td>
            <td> <?= $operation->created_at ?>  </td>
        </tr>


        <?php endforeach; ?>
    </table>

</div>
</body>
</html>
