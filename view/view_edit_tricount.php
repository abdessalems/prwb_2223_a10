<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>Edit Tricount</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="./assets/img/fav_icon.png" rel="icon">
    <link href="./assets/img/touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

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
    <style>
        .error-list {
            color: red;
            margin-top: 0.5rem;
            margin-bottom: 0;
            list-style-type: none;
            padding-left: 0;
        }
    </style>
    

</head>
<body>




<div id="subscriber-message"></div>
<form id="addForm" action='tricount/EditTricounts/<?= $tricount->id ?>' method="post">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">


            <a  class="btn btn-outline-danger" href='tricount/view_tricount/<?= $tricount->id ?>'>Cancel</a>


            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h3><?= $tricount->title ?> > Edit</h3>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Save"/>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <div>
                <label for="exampleFormControlInput1" class="form-label">Title:</label><br>
                <input type="text" id="title" name="title" class="form-control" value="<?= $tricount->title ?>"><br><br>
                <?php if (count($errors) != 0): ?>
                    <ul class="error-list">
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

    <div >
        <label for="exampleFormControlInput1" class="form-label">Description (optional):</label><br>
        <textarea class="form-control mb-3" name="description"><?= $tricount->description ?></textarea>
    </div>
</form>
<input type="hidden" name="tricount_id" value="<?php echo $tricount->id; ?>" id="tricount_id">
<div>
    <?php foreach ($subscribers as $subscriber): ?>
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1"><?= $subscriber['full_name'] ?></div>
            <form class="delete-subscriber-form ms-3" data-fullname="<?= $subscriber['full_name'] ?>" action="tricount/deleteSubscriber/<?= $tricount->id ?>/<?= $subscriber['full_name'] ?>" method="post">
                <input type="hidden" name="tricount_id" value="<?= $tricount->id ?>">
                <input type="hidden" name="subscriber_fullname" value="<?= $subscriber['full_name'] ?>" class="subscriber-fullname-input">
                <button class="btn btn-danger delete-subscriber-btn" type="submit"><i class="bi bi-trash"></i></button>
            </form>
        </div>
    <?php endforeach; ?>
</div>








<form action="tricount/editSubscriber/<?= $tricount->id ?>" method="post">

    <div class="d-flex">
        <select class="form-control me-2" aria-label="Default select example" name="subscriber" id="subscriber">
            <option selected>--Add a new subscriber--</option>
            <?php foreach ($Nosubscribers as $user): ?>
                <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
            <?php endforeach; ?>
        </select>
        <input class="btn btn-primary" type="submit" name="add_subsciber" value="Add" id="add-subscriber">
    </div>
</form>

<footer>
    <form action="tricount/first_delete/<?= $tricount->id ?>" method="post">
        <input class="btn btn-danger w-100" type="submit" style="background-color:red; color:white;" name="monBouton" value="delete this tricount">
    </form>
</footer>

</body>

</html>
