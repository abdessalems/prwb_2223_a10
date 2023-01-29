<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_tricount</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<a href="tricount/tricount">Back</a>
<div class="view_tricount">
    <h3><?= $tricount->title ?> > Expenses <h3/>
        <a href="your link of edit here yassin ok ">Edit</a> <br>

        <?php if (empty($operations)) : ?>
        <?php if ($tricount->nb_participant < 1) : ?>
            <div>
                <h3> Your are alone !</h3>
                <p> Click below to add your friends ! </p>
                <a href="link ">Add Friends</a> <br>
            </div>
        <?php else : ?>
</div>
<h3> Your Tricount is empty !</h3>
<p> Click below to add your first expense ! </p>
<a href="link ">Add an expense</a> <br>
</div>
<?php endif; ?>
<?php else : ?>
    <div>
        <a href="view balance ">view balance </a>
        <table>
            <?php foreach ($operations as $operation): ?>

                <tr>

                    <th>
                        <a href='operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>'><?= $operation->title ?></a>
                    </th>
                    <th>
                        <a href='operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>'><?= $operation->amount ?></a>
                    </th>
                </tr>

                <tr>
                    <td> Paid par <a
                                href='operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>'><?= $operation->name_paid ?></a>
                    </td>
                    <td>
                        <a href='operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>'><?= $operation->created_at ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

<div>
    <h5> <?= $My_total ?> My total </h5>
    <h5> <?= $Total_expenses ?> Total expenses </h5>
</div>
<!--
    <h1> <?= $tricount->nb_participant ?> nbr part </h1>

    <h1> <?= $nbr_total_repartitions ?> </h1>
    -->
</div>


</body>
</html>
