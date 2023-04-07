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





<form id="addForm" action="tricount/addTricounts" method="post">
    <div style="background-color: lightsteelblue; padding: 10px;">
        <div class="d-flex justify-content-between mt-3">
            <button style="color:red; background-color:white;  border: 1px solid red;"">
            <a href="" style="text-decoration: none; color: red;"> Cancel</a>
            </button>


            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h3>Your Tricounts</h3>
                </div>
            </div>


            <input class="btn btn-primary" value="Save" type="submit">


        </div>

    </div>

    <div class="form-group">
        <label class="form-control-label">Titre :</label><br>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="title" id="title" aria-label="title" aria-describedby="basic-addon1">
        </div>
        <span class="text-danger" id="title-error"></span>
        <span class="text-success" id="title-message"></span>
    </div>

    <div>
        <label class="form-control-label">Description (optionnelle) :</label><br>
        <textarea name="description" id="description" rows="10" cols="30" style="width: 100%; height: 100px;"></textarea>
    </div>
    <span class="text-danger" id="description-error"></span>
    <span class="text-success" id="description-message"></span>


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

        $('#title, #description').on('input', function() {
            validateForm();
        });


        function validateForm() {
            var title = $.trim($("input[name='title']").val());
            var description = $.trim($("textarea[name='description']").val());


            if (title == "") {
                $('#title-error').html('The titre is obligatory.');
            } else if (title.length < 3) {
                $('#title-error').html('The title must have at least 3 characters');
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



