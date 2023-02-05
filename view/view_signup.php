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
    <div style="background-color: dodgerblue; height: 100%; padding: 10px;">

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
                        <input id="mail" name="mail" type="mail" size="16" placeholder="Email" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user" aria-hidden="true"></i></span>
                        <input id="fullname" name="fullname" type="text" size="16" placeholder="Full Name" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-credit-card" aria-hidden="true"></i></span>
                        <input id="iban" name="iban" type="text" size="16" placeholder="IBAN"  class="form-control" p aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" aria-hidden="true"></i></span>
                        <input  id="password" name="password" type="password" size="16" placeholder="Password"   class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" aria-hidden="true"></i></span>
                        <input  <input id="password_confirm" name="password_confirm" type="password" size="16" placeholder="Confirm Your Password"   class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                    </div>
<!--                    <div class="d-grid gap-2">-->
<!--                        <input class="btn btn-primary" type="button" type="submit" value="Sign Up">-->
<!--                        <button class="btn btn-danger" style="color:white; background-color:red;">-->
<!--                            <a href='main/login' style="color:white;">Cancel</a> </button>-->
<!--                    </div>-->

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