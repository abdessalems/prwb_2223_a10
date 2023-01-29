<!DOCTYPE html>
<html>
<style>
</style>
<<<<<<< HEAD

<head>
    <meta charset="UTF-8">
    <title>Members</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="title">
    <h3>Your Tricounts <h3/>
        <a href="your link for add tricount here yassin">Add </a>

=======
<head>
    <meta charset="UTF-8">
    <title>list_tricount</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="title">
    <h3>Your Tricounts <h3/>
        <a href="your link for add tricount here yassin">Add </a>

>>>>>>> feat_UC_edit_operation
</div>
<div class="main">
    <table>

        <?php foreach ($tricounts as $tricount): ?>
            <tr>
<<<<<<< HEAD
                <th> <?= $tricount->title ?>  </th>
=======
                <th>
                    <a href='tricount/view_tricount/<?= $tricount->id ?>/<?= $user->id ?>'> <?= $tricount->title ?>  </a>
                </th>

>>>>>>> feat_UC_edit_operation
                <th></th>
            </tr>
            <tr>
                <td> <?= $tricount->description ?></td>
                <td><?php if ($tricount->nb_participant < 2) {
                        echo " You're alone ";
                    } else if ($tricount->nb_participant == 2) {
                        echo " with ", $tricount->nb_participant - 1, "  Friend";
                    } else {
                        echo "  with ", $tricount->nb_participant - 1, "  Friends";
                    }
                    ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<<<<<<< HEAD
    <a href="settings/settings">Settings</a>
</div>
</body>
</html>
=======
    <a href="user/logout">Logout</a>

</div>
</body>
</html>  
>>>>>>> feat_UC_edit_operation
