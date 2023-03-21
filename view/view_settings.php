<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Settings </title>
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
    <div >
        <a  class="btn btn-outline-danger" href="tricount/tricount">Back</a>

        <h5 class="card-title"  style="float:right;">Settings <h5/>
    </div>
</div>
<div class="card" style="display: block">

    <div class="card-body pt-3">
        <h4> Hey <?= $user->full_name ?> ! </h4>
        <p> I know your email adress is <?= $user->mail ?></p>
        <p> What can Ido for you ?</p>

        <div class="bottom">
            <div class="list-group">
                <a  title="edit_profile" class="btn btn-outline-primary" href="settings/edit_profile">     Edit profile </a>
                <a  title="change_password" class="btn btn-outline-primary" href="settings/change_password" style="margin-bottom: 5px ; margin-top: 5px">    Change password </a>
                <a  title="Logout" class="btn btn-danger" href="tricount/logout">Logout</a>
            </div>

        </div>
    </div>

    <?php if (count($errors) != 0): ?>

        <div class='errors'>
            <br><br>
            <p>Please correct the following error(s) :</p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Vendor JS Files -->
    <script src="./assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/chart.js/chart.umd.js"></script>
    <script src="./assets/vendor/echarts/echarts.min.js"></script>
    <script src="./assets/vendor/quill/quill.min.js"></script>
    <script src="./assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="./assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="./assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="./assets/js/main_admin_temp.js"></script>
</body>
</html>