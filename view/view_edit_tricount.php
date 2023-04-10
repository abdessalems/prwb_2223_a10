<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>Edit Tricount</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


</head>
<body>




<div id="subscriber-message"></div>
<form id="addForm" action='tricount/view_tricount/<?= $tricount->id ?>' method="post">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">


            <a  class="btn btn-outline-danger" href='tricount/view_tricount/<?= $tricount->id ?>'>Cancel</a>


            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h3><?= $tricount->title ?> > Edit</h3>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Save"/>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

    <div>
        <label for="exampleFormControlInput1" class="form-label">Title:</label><br>
        <input type="text" id="title" name="title" class="form-control" value="<?= $tricount->title ?>"><br><br>
    </div>

    <div class="form-floating mb-3">
        <label>Description (optional):</label><br>
        <textarea class="form-control mb-3" name="description"><?= $tricount->description ?></textarea>
    </div>
</form>

<form action="tricount/editSubscriber/<?= $tricount->id ?>/<?= $id_user ?>" method="post">
    <input type="hidden" name="tricount_id" value="<?php echo $tricount->id; ?>" id="tricount_id"
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Subscribers</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($subscribers as $subscriber): ?>
                <td>
                    <?= $subscriber['full_name'] ?>
                    <form class="delete-subscriber-form" data-fullname="<?= $subscriber['full_name'] ?>" action="tricount/deleteSubscriber/<?= $tricount->id ?>/<?= $subscriber['full_name'] ?>" method="post">
                        <input type="hidden" name="tricount_id" value="<?= $tricount->id ?>">
                        <input type="hidden" name="subscriber_fullname" value="" class="subscriber-fullname-input">
                        <button class="btn btn-danger delete-subscriber-btn" type="submit">Delete</button>
                    </form>
                </td>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="d-flex">
        <select class="form-control me-2" aria-label="Default select example" name="subscriber" id="subscriber">
            <option selected>--Add a new subscriber--</option>
            <?php foreach ($Nosubscribers as $user): ?>
                <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
            <?php endforeach; ?>
        </select>
        <input class="btn btn-primary" type="submit" name="add_subsciber" value="Add" id="add-subscriber">
    </div>
</form>

<footer>
    <form action="tricount/first_delete/<?= $tricount->id ?>/<?= $id_user ?>" method="post">
        <input class="btn btn-danger w-100" type="submit" style="background-color:red; color:white;" name="monBouton" value="delete this tricount">
    </form>
</footer>
</body>

</html>
<script>
    $(document).ready(function() {

        $("#add-subscriber").on("click", function(event) {
            event.preventDefault();


            var subscriberName = $("#subscriber option:selected").val();
            var tricountId = $("#tricount_id").val();


            if (subscriberName !== "--Add a new subscriber--") {

                $.ajax({
                    type: "POST",
                    url: "tricount/editSubscriber",
                    data: { tricount_id: tricountId, subscriber_name: subscriberName },
                    success: function(response) {

                        if (response === "success") {
                            location.reload();
                        } else {
                            alert("Failed to add subscriber.");
                        }
                    }
                });
            }
        });

        $(".delete-subscriber-btn").on("click", function(event) {
            event.preventDefault();


            var subscriberId = $(this).closest("form").data("subscriber-id");


            delete_participant(subscriberId);
        });

        function delete_participant(id) {
            $.ajax({
                type: "POST",
                url: "tricount/deleteSubscriber",
                data: {
                    subscriber_id: id,
                    tricount_id: $("#tricount_id").val(),
                },
                dataType: "json",
                encode: true,
                success: function(data) {

                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Failed to delete subscriber.");
                    }
                },
                error: function(xhr, status, error) {
                    alert("Failed to delete subscriber.");
                }
            })
        }
    });
</script>
