<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>List Tricounts</title>
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
    <link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="card">
    <div class ="card-body">
        <div  style="display: block ruby">
            <h5 class="card-title">Your Tricounts</h5>
            <a class="btn btn-primary" style="float: right" type="button" href="your link for add tricount here yassin">Add </a>
        </div>
        <div class="list-group">
            <?php foreach ($tricounts as $tricount): ?>
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?=  $tricount->title ?></h5>
                        <small><?php if ($tricount->nb_participant< 2) {
                                echo " You're alone ";
                            }else if ($tricount->nb_participant== 2) {
                                echo  " with " , $tricount->nb_participant -1, "  Friend"   ;
                            } else {
                                echo  "  with " , $tricount->nb_participant -1, "  Friends"   ;
                            }
                            ?></small>
                    </div>
                    <p class="mb-1"><?= $tricount->description ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <a href="tricount/logout">Logout</a> <br>
    <a href="settings/settings">Settings</a>
</div>
</body>
</html>  
