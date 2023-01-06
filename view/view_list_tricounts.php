<!DOCTYPE html>
<html>
<style>
</style>
    <head>
        <meta charset="UTF-8">
        <title>users</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div  class="title"><h3>Your Tricounts <h3/> <input type="submit" value="Add"/>
        </div>
        <div class="main">
            <table>

                <?php foreach ($tricounts as $tricount): ?>
                    <tr>
                  <th style="width:50%"><h5> <?=  $tricount->title ?>  </h5></th>
                    </tr>
                    <tr>
                        <td> <?= $tricount->description ?></td>
                       <td><?php if ($tricount->nb_participant== 1){
                               echo " &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp You're alone ";
                           }else if ($tricount->nb_participant== 2) {
                               echo  " &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp with " , $tricount->nb_participant -1, "  Friend"   ;
                           } else {
                               echo  " &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp with " , $tricount->nb_participant -1, "  Friends"   ;
                           }
                           ?></td>
                    </tr>
                    <?php endforeach; ?>
            </table>

            <a href="settings/settings">Settings</a>
        </div>
    </body>
</html>  
