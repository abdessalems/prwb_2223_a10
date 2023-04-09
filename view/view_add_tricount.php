<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>users</title>

    <title>add tricount</title>

    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>





<form class="col-7 mx-auto my-2" id="addForm" action="tricount/addTricounts" method="post">
    <div style="background-color: lightblue; padding: 10px;">
        <div class="d-flex justify-content-between mt-3">

            <a  class="btn btn-outline-danger" href="" > Cancel</a>



            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h3>Your Tricounts</h3>
                </div>
            </div>


            <input  data-bs-placement="bottom" class="btn btn-primary" value="Save" type="submit">


        </div>

    </div>




    <!--    <div class="form-group">-->
    <!--        <label class="form-control-label">Titre :</label><br>-->
    <!--        <div class="input-group mb-3">-->
    <!--            <input type="text" class="form-control" name="title" id="title" aria-label="title" aria-describedby="basic-addon1">-->
    <!--        </div>-->
    <!--        <span class="text-danger" id="title-error"></span>-->
    <!--        <span class="text-success" id="title-message"></span>-->
    <!--    </div>-->
    <div class="container">
        <div>
            <label class="form-control-label">Titre :</label><br>
            <input type="text" class="form-control" name="title" id="title" aria-label="title" aria-describedby="basic-addon1">
            <span class="text-danger" id="title-error"></span>
            <span class="text-success" id="title-message"></span>
        </div>
        <div>
            <label class="form-control-label">Description (optionnelle) :</label><br>
            <textarea name="description" textarea class="form-control" aria-label="With textarea" id="description" "></textarea>
            <span class="text-danger" id="description-error"></span>
            <span class="text-success" id="description-message"></span>
        </div>
    </div>


    <!--    <div class="input-group">-->
    <!--        <label class="form-control-label">Description (optionnelle) :</label><br>-->
    <!--        <div>-->
    <!--        <textarea name="description" textarea class="form-control" aria-label="With textarea" id="description" "></textarea>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <span class="text-danger" id="description-error"></span>-->
    <!--    <span class="text-success" id="description-message"></span>-->


</form>
</div>
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
</body>
</html>
<script>

    $(document).ready(function() {

        // Ajouter l'événement input pour surveiller les changements dans le champ du titre
        $('#title').on('input', function() {
            validateForm();
        });

        $('#title, #description').on('input', function() {
            validateForm();
        });


        function validateForm() {
            var title = $.trim($("input[name='title']").val());
            var description = $.trim($("textarea[name='description']").val());


            if (title == "") {
                $('#title-error').html('The titre is obligatory.').removeClass('text-success').addClass('text-danger');
            } else if (title.length < 3) {
                $('#title-error').html('The title must have at least 3 characters').removeClass('text-success').addClass('text-danger');
            } else {
                $('#title-error').html('It looks good!').removeClass('text-danger').addClass('text-success');
            }


            if ($.trim(description).length > 0) {
                if (description.length < 3) {
                    $('#description-error').html('If description is not empty, it must contain at least 3 characters').removeClass('text-success').addClass('text-danger');
                } else {
                    $('#description-error').html('It looks good!').removeClass('text-danger').addClass('text-success');
                }
            } else {
                $('#description-error').html('').removeClass('text-danger').addClass('text-success');
            }
        }


        $('#addForm').submit(function(e) {
            e.preventDefault();
            validateForm();
            if ($('#title-error').hasClass('text-success') && $('#description-error').hasClass('text-success')) {
                this.submit();
            }

        });
    });
</script>
