<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_operation</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>

    <a href='tricount/view_tricount/<?=  $tricount->id ?>/<?= $id_user ?>'> Back</a>
    <div class="view_ operation ">
    <h3><?= $tricount->title ?> > Edit </h3>
        <div  class="title">
            <div  class="title"> <h3>Settings </h3>
            </div>
            <form id="addForm" action="tricount/EditTricounts" method="post">
                <input type="submit" value="Save"> <br><br><br>
                <div>
                    <label > title :</label><br>
                    <input type="text" id="title" name="title" value="<?= $tricount->title ?>"><br><br>
                </div>
                <div>
                    <label >description(optional) :</label><br>
                    <textarea name="description" rows="10" cols="20" > <?= $tricount->description ?></textarea>
                </div>
                <div>
                    <?php

                    foreach ($subscribers as $subscriber) {
                        ?>
                        <tr>

                            <td><?= $subscriber['full_name'] ?></td><br><br>
                        </tr>
                        <?php
                    }
                    ?>
                </div>
                   <form>
                        <label for="subscriber">Add new subscriber</label>
                        <select id="subscriber" name="subscriber">
                            <?php

                            foreach ($Nosubscribers as$Nosubscribers) {
                                ?>
                                <option value="<?= $Nosubscribers['full_name']  ?>"><?= $Nosubscribers['full_name']  ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="submit" value="Add">
                    </form>
$
                </div>
            </form>
