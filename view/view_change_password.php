<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<a href="user/tricount">Back</a>
<div class="main">
    Change password :
    <br><br>
    <form id="change_password" action="settings/change_password" method="post">
        <table>
            <tr>
                <td>current Password:</td>
                <td><input id="password" name="password" type="password" size="16" value=""></td>
            </tr>

            <tr>
                <td>new Password:</td>
                <td><input id="new_password" name="new_password" type="password" size="16" value=""></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input id="confirm_password" name="confirm_password" type="password" size="16" value=""></td>
            </tr>
        </table>
        <input type="submit" value="Change Password">
    </form>

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

</div>
</body>
</html>