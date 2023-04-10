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


<div class="card-header">
    <div class="d-flex w-100 justify-content-between">
        <a  class="btn btn-outline-danger" href='tricount/view_tricount/<?= $tricount->id ?>'>Back</a>
        <h5 style="align-self: center " class="card-title" ><?= $tricount->title ?> > Balance <h5/>

    </div>
</div>





<div class="card">
    <div class="card-body">
        <table style="height: 60px; width: 1000px;">
            <tr>

            </tr>
            <?php foreach ($participents as $participent): ?>
                <?php if(($participent->account)>0): ?>
                    <tr>
                        <td><?php echo $participent->full_name; ?></td>
                        <td style="background-color: green; background-size: 50% 100%;"><?php echo $participent->account; ?></td>
                    </tr>
                <?php  elseif(($participent->account)<0): ?>
                    <tr>
                        <td style="background-color: red; background-size: 50% 100%;"><?php echo $participent->account; ?></td>
                        <td><?php echo $participent->full_name; ?></td>

                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>