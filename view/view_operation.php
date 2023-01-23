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

<a href="tricount/view_tricount/<?=$operation->tricount?>/<?=$id_user?>"> Back</a>
<div class="view_ operation ">
    <h3><?= $tricount->title ?> > <?= $operation->title ?> <h3/>
        <a href="operation/edit_operation/<?=$operation->id ?>/<?= $id_user ?>">Edit</a>

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

        <a href='operation/view_operation/<?=$id_previous_operation?>/<?=$id_user?>'>Previous</a>  <br>
        <a href='operation/view_operation/<?=$id_next_operation?>/<?=$id_user?>'>Next</a>  <br>






</div>


</body>
</html>

