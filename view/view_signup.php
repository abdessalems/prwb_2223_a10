<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Sign Up</div>
        
        <div class="main">
            
            <br><br>
            <form id="signupForm" action="main/signup" method="post">
                <table>
                    <tr>
                        <td>Email</td>
                        <td><input id="email" name="email" type="text" size="16" value="<?= $email ?>"></td>
                    </tr>
					<tr>
                        <td>fullname</td>
                        <td><input id="fullname" name="fullname" type="text" size="16" value="<?= $fullname?>"></td>
                    </tr>
					<tr>
                        <td>IBAN</td>
                        <td><input id="email" name="email" type="text" size="16" value="<?= $iban ?>"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" size="16" value="<?= $password ?>"></td>
                    </tr>
                    <tr>
                        <td>Confirm your Password:</td>
                        <td><input id="password_confirm" name="password_confirm" type="password" size="16" value="<?= $password_confirm ?>"></td>
                    </tr>
                </table>
                <input type="submit" value="Sign Up">
				<input type="submit" value="Cancel">
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