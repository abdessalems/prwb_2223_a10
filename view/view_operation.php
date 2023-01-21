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

<a href='operation/view_operation/<?=  $operation->id ?>/<?= $id_user ?>'> Back</a>
<div class="view_ operation ">
    <h3><?= $tricount->title ?> > <?= $operation->title ?> <h3/>
        <a href="your link of edit here yassin ok ">Edit</a>

        <?php if  (empty($operations)) : ?>
        <?php endif; ?>

        <table>
        <tr>
            <th> <h3><?= $operation->amount ?> € <h3/></th>
        </tr>
        <tr>
            <td>Paid par   <?= $operation->name_paid ?> &nbsp </td>
              <td> &nbsp <?= $operation->created_at ?> </td>
        </tr>
        </table>
        <?php if  ($operation->nbr_repartition < 2) : ?>
        <p> For <?=$operation->nbr_repartition?> participent
        <?php else :  ?> <p> For <?=$operation->nbr_repartition?> participents <?php endif; ?>
            <?php if  ($cmpt > 0) : ?> including me <?php endif; ?>
        </p>



            <table>
            <?php foreach ($operation_amount as $o): ?>

            <tr>
                <td><?=$o->full_name?></td>
                <td> <?=$o->amount?> €   </td><br>
            </tr>

            <?php endforeach; ?>
            </table>
        <?php if  ($operation->id > 0) : ?>
            <a href='operation/view_operation/<?=  $operation->id - 1 ?>/<?=$id_user?>'>Previous</a>  <br>
        <?php else :  ?> <a href='operation/view_operation/<?=  $operation->id ?>/<?=$id_user?>'>Previous</a>  <br>
        <?php endif; ?>
        <?php if  ($nbr_operations + 1  > $operation->id) : ?>
            <a href='operation/view_operation/<?=  $operation->id + 1 ?>/<?=$id_user?>'>Next</a>  <br>
        <?php else :  ?> <a href='operation/view_operation/<?=  $operation->id ?>/<?=$id_user?>'>Next</a>  <br>
        <?php endif; ?>




</div>


</body>
</html>

