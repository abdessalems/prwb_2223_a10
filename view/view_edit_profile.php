<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<a href="tricount/tricount">Back</a>
<div class="main">
    Edite Profile :
    <br><br>
    <form id="edit_profile" action="settings/edit_profile" method="post">
        <table>

                <h5> VOTRE MAIL : <?= $user->mail ?></h5>


            <tr>
                <td>full_name :</td>
                <td><input id="full_name" name="full_name" type="text" size="16" value="<?= $user->full_name ?>"></td>
            </tr>
            <tr>
                <td>iban :</td>
                <td><input id="iban" name="iban" type="text" size="16" value="<?= $user->iban ?>"></td>
            </tr>
        </table>
        <input type="submit" value="save" act>
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