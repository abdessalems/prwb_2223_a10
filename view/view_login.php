<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <hr />
        <div class="title">Sing in</div>
        <hr />
        <div class="menu"> 
        <a href="main/index">Home</a>
        <a href="main/signup">Sign Up</a>
        
        </div>
        <div class="main">
            <form action="main/login" method="post">
                <table>
                    <tr>
                        <td>Email address:</td>
                        <td><input id="mail" name="mail" type="text" value="<?= $mail ?>"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value="<?= $password ?>"></td>
                    </tr>
                </table>
                <input type="submit" value="Log In"> <br>
                <a href="main/signup">New here ? Click here to join the party !</a>
                
            </form>
            <?php if (count($errors) != 0): ?>
                <div class='errors'>
                    <br><br><p>Please correct the following error(s) :</p>
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
