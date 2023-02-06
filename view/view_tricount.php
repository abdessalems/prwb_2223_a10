<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_tricount</title>
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
        <a  class="btn btn-outline-danger" href="tricount/tricount">Back</a>
        <h5 style="align-self: center " class="card-title" ><?= $tricount->title ?> > Expenses <h5/>
            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit tricount"  class="btn btn-primary" href="tricount/EditTricounts/<?= $tricount->id ?>/<?= $id_user ?>">Edit </a>
    </div>

</div>
<div class="card mx-2">

    <div class ="card-body ">
        <?php if (empty($operations)) : ?>
        <?php if ($tricount->nb_participant < 1) : ?>
            <div>
                <h3> Your are alone !</h3>
                <p> Click below to add your friends ! </p>
                <a href="link ">Add Friends</a>
            </div>
        <?php else : ?>
        <h3> Your Tricount is empty !</h3>
        <p> Click below to add your first expense ! </p>
        <a href="link ">Add an expense</a>
        <a href="tricount/view_balance/<?= $tricount->id ?>/<?= $id_user ?>">view balance </a> <br>
    </div>
    <?php endif; ?>
    <?php else : ?>
        <div class="list-group">
            <a class="btn btn btn-success" href="tricount/view_balance/<?= $tricount->id ?>/<?= $id_user ?> ">   <i class="bi bi-arrow-left-right"></i>  view balance </a>
            <?php foreach ($operations as $operation): ?>
                <a href="operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $operation->title ?></h5>
                        <h6><?= round($operation->amount,2) ?> €</h6>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1">Paid by <?= $operation->name_paid ?> </small>
                        <small class="mb-1" style="float: right"><?= $operation->created_at ?> </small>
                    </div>

                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?></div>

</div>


<div class="card-footer">
    <div class="d-flex w-100 justify-content-between">
        <div class="list-group-item list-group-item-action" >
            <small>My total</small>
            <h5 class="mb-1"><?= round($My_total,2) ?> €</h5>
        </div>
        <a href="operation/add_operation/<?=$tricount->id?>">

        <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add new operation" type="button" href="operation/add_operation/<?=$tricount->id?>"><i class="btn btn-primary bi bi-plus-circle-fill"></i> </a>
        <div  class="list-group-item list-group-item-action" >

        </div>
            <small>Total expenses</small><br><br>
            <h5 > <?=round($Total_expenses,2) ?>€</h5>
    </div>
</div>

</body>
</html>
