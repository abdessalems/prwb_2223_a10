<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>delete tricount</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <base href="<?=$web_root?>"/>
    <!-- Favicons -->
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
</head>
<body>



<div style="display: flex; justify-content: center; width: 100%;">
    <i class="fas fa-trash" aria-hidden="true" style="color: red; font-size: 100px;"></i>
</div>

<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
    <p style="color: red;">Are you sure?</p>
</div>
<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
    <p style="color: red;">Do you really want to delete this operation "<strong style="color:red;"><?= $tricount->title ?></strong>" and all of its dependencies?</p>


</div>

<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
      <p style="color:red;">This process cannot be undone.</p>
</div>

</div>

<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
    <p style="color:red;">This process cannot be undone.</p>
</div>




<div style="display: flex; justify-content: center; width: 100%; padding: 10px;">
    <button class="btn btn-primary w-100" style="background-color: grey; color: white; margin: auto;">
        <a href='tricount/EditTricounts/<?= $tricount->id ?>/<?= $user->id ?> '  style="color:white;">Cancel</a>
    </button>
    <button class="btn btn-primary w-100"  style="background-color: red; color: white; margin: auto;">
        <a href='tricount/deleteTricount/<?= $tricount->id ?>' style="color:white;">Delete</a>
    </button>
</div>

</body>
</html>