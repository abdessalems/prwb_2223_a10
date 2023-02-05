<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_operation</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="./assets/img/fav_icon.png" rel="icon">
    <link href="./assets/img/touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/styles.css" rel="stylesheet">
</head>
<body>
<div class="card-header">
    <div class="d-flex w-100 justify-content-between">
        <a  class="btn btn-outline-danger" href="tricount/view_tricount/<?= $operation->tricount ?>/<?= $id_user ?>"> Back</a>
        <h5 style="align-self: center " class="card-title" ><?= $tricount->title ?> > <?= $operation->title ?>  <h5/>
            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit operation"  class="btn btn-primary" href="operation/edit_operation/<?= $operation->id ?>/<?= $id_user ?>">Edit</a>
    </div>
</div>

<div class="card">
    <div class ="card-body ">
        <?php if (empty($operations)) : ?>
        <?php endif; ?>

        <table>
            <tr>
                <th>
                    <h3><?= $operation->amount ?> € <h3/>
                </th>
            </tr>
            <tr>
                <td>Paid by <?= $operation->name_paid ?> &nbsp</td>
                <td> &nbsp <?= $operation->created_at ?> </td>
            </tr>
        </table>
        <?php if ($operation->nbr_repartition < 2) : ?>
        <p> For <?= $operation->nbr_repartition ?> participent
            <?php else : ?>
        <p> For <?= $operation->nbr_repartition ?> participents <?php endif; ?>
            <?php if ($cmpt > 0) : ?> including me <?php endif; ?>
        </p>
        <div class="list-group">
            <?php foreach ($operation_amount as $o): ?>
                <div class="list-group-item list-group-item-action d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?= $o->full_name ?></h5>
                    <h6><?= $o->amount ?> €</h6>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<div class="card-footer">
    <div class="d-flex w-100 justify-content-between">
        <a class="btn btn-primary" href='operation/view_operation/<?= $id_previous_operation ?>/<?= $id_user ?>'>Previous</a>
        <a  class="btn btn-primary" href='operation/view_operation/<?= $id_next_operation ?>/<?= $id_user ?>'>Next</a>
    </div>
</div>
</body>
</html>

