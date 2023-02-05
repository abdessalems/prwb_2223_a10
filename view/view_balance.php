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
<div class="view_balance">
<!--<table>-->
<!--    <tr>-->
<!--        <th>Nom complet</th>-->
<!--        <th>Compte</th>-->
<!--    </tr>-->
<!--    --><?php //foreach ($participents as $participent): ?>
<!--        --><?php //if(($participents->account)>0) ?>
<!--        <tr>-->
<!--            <td>--><?php //echo $participent->full_name; ?><!--</td>-->
<!--            <td>--><?php //echo $participent->account; ?><!--</td>-->
<!--        </tr>-->
<!--        --><?php // elseif(($participents->account)<0) ?>
<!--            <tr>-->
<!--            <td>--><?php //echo $participent->account; ?><!--</td>-->
<!--            <td>--><?php //echo $participent->full_name; ?><!--</td>-->
<!---->
<!--        </tr>-->
<!--        --><?php //endif; ?>
<!--        --><?php //endif; ?>
<!--    --><?php //endforeach; ?>
<!--</table>-->

    <table>
        <tr>

        </tr>
        <?php foreach ($participents as $participent): ?>
            <?php if(($participent->account)>0): ?>
                <tr>
                    <td><?php echo $participent->full_name; ?></td>
                    <td><?php echo $participent->account; ?></td>
                </tr>
            <?php  elseif(($participent->account)<0): ?>
                <tr>
                    <td><?php echo $participent->account; ?></td>
                    <td><?php echo $participent->full_name; ?></td>

                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>



</div>
</body>
</html>