<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>
<!--    <div style="background-color: dodgerblue; height: 100%; padding: 10px;">-->
<!--    </div>-->
<div class="d-flex align-items-center bg-primary text-white fw-bold fs-5" style="height: 100%; padding: 10px;">
    <span class="me-1">
        <svg fill="#ffffff" width="30px" height="40px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M290.59 192c-20.18 0-106.82 1.98-162.59 85.95V192c0-52.94-43.06-96-96-96-17.67 0-32 14.33-32 32s14.33 32 32 32c17.64 0 32 14.36 32 32v256c0 35.3 28.7 64 64 64h176c8.84 0 16-7.16 16-16v-16c0-17.67-14.33-32-32-32h-32l128-96v144c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V289.86c-10.29 2.67-20.89 4.54-32 4.54-61.81 0-113.52-44.05-125.41-102.4zM448 96h-64l-64-64v134.4c0 53.02 42.98 96 96 96s96-42.98 96-96V32l-64 64zm-72 80c-8.84 0-16-7.16-16-16s7.16-16 16-16 16 7.16 16 16-7.16 16-16 16zm80 0c-8.84 0-16-7.16-16-16s7.16-16 16-16 16 7.16 16 16-7.16 16-16 16z"></path>
            </g>
        </svg>
    </span>
    Tricount
</div>



<hr>
<div class="d-flex justify-content-center mt-3">
    <div class="title">
        <h3>Sing up</h3>
    </div>
</div>
<hr>


<div class="main">

    <br><br>
    <form id="signupForm" action="main/signup" method="post">
        <table>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input id="mail" name="mail" type="mail" size="16" placeholder="Email" value="<?php if(isset($mail)) { echo $mail; } ?>" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user" aria-hidden="true"></i></span>
                <input id="fullname" name="fullname" type="text" size="16" placeholder="Full Name" value="<?php if(isset($fullname)) { echo $fullname; } ?>"  class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
            </div>


            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-credit-card" aria-hidden="true"></i></span>
                <input id="iban" name="iban" type="text" size="16" placeholder="IBAN" value="<?php if(isset($iban)) { echo $iban; } ?>"   class="form-control" p aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" aria-hidden="true"></i></span>
                <input  id="password" name="password" type="password" size="16" placeholder="Password"   class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" aria-hidden="true"></i></span>
                <input  <input id="password_confirm" name="password_confirm" type="password" size="16" placeholder="Confirm Your Password"   class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <

            <div class="d-flex flex-column align-items-center">
                <div class="d-flex flex-row">
                    <input class="btn btn-primary w-100" type="submit" value="Sign Up">
                </div>
                <div class="d-flex flex-row mt-2">
                    <button class="btn btn-danger w-100" style="color: white; background-color: red;">
                        <a href='main/login' style="color:white;">Cancel</a>
                    </button>
                </div>




            </div>
    </form>
    <?php if (count($errors) != 0): ?>
        <div class='alert alert-danger'>
            <p><strong>Please correct the following error(s) :</strong></p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


</div>
</body>
</html>