<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <base href="<?=$web_root?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


</head>
<body>
<div style="background-color: lightsteelblue; padding: 10px;">



        <a class="btn btn-outline-danger" href='tricount/view_tricount/<?= $tricount->id ?>/<?=  $user->id ?>' style="text-decoration: none; color: red;">Back</a>

    <div class="d-flex justify-content-center mt-3">
        <div class="title" style="text-align: right;">

            <h3 style="color: gray;"><?= $tricount->title ?> < Balance </h3>
        </div>
    </div>
</div>




<div class="view_balance" >




    <table style="height: 60px; width: 1000px;">
        <tr>

        </tr>
        <?php foreach ($participents as $participent): ?>
            <?php if(($participent->account)>0): ?>
                <tr>
                    <td><?php echo $participent->full_name; ?></td>
                    <td style="background-color: green";><?php echo $participent->account; ?></td>
                </tr>
            <?php  elseif(($participent->account)<0): ?>
                <tr>
                    <td style="background-color: red";><?php echo $participent->account; ?></td>
                    <td><?php echo $participent->full_name; ?></td>

                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>




</div>
</body>
</html>