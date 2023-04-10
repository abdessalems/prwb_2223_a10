<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <base href="<?=$web_root?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicons -->
    <link href="./assets/img/fav_icon.png" rel="icon">
    <link href="./assets/img/touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/styles.css" rel="stylesheet">

</head>
<body>



<form class="col-7 mx-auto my-2" action="operation/add_operation/<?= $tricount->id ?>" method="post" onsubmit="return validateForm()">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">


            <a  class="btn btn-outline-danger" href='tricount/view_tricount/<?= $tricount->id ?>' > Cancel</a>



            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h5 style="color: gray;"><?= $tricount->title ?> > new Expense </h5>
                </div>
            </div>


            <input  data-bs-placement="bottom" class="btn btn-primary" value="Save" type="submit">


        </div>
    </div>





    <div class="card">
        <div class="card-body">

    <div class="row mb-3">
        <div class="col-sm-10">

            <input  class="form-control" id="title" name="title" type="text"  placeholder="Title" value="<?php if(isset($title)) { echo $title; } ?>"  aria-label="Amount (to the nearest dollar)">

        </div>
    </div>



    <div class="form-inline">
        <div class="form-group mb-3">
            <label for="amount" class="sr-only">Amount</label>
            <div class="input-group col-md-70">
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?php if(isset($amount)) { echo $amount; } ?>" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">euro</span>
                </div>
            </div>
        </div>
    </div>









    <p>Date</p>
    <div class="input-group mb-3">

        <input  class="form-control" type="date" id="date" name="date" value="<?= $date ?>" aria-label="Amount (to the nearest dollar)">

    </div>





    <div class="row mb-3" >
        <div class="col-sm-10">
            <label class="form-label" for="Paid">Paid By</label>
            <select name="paid" id="paid" value="<?= $itr ?>" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"">
                <?php foreach ($paidBy as $user): ?>
                     <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
                <?php endforeach ;?>
                </select>
        </div>
    </div>



 <div class="row mb-3">
     <div class="col-sm-10">
        <p>For Whom ? (select at least one ) </p>
         <table class="table table-borderless datatable">
            <form action="operation/add_operation" method="post">
                <tbody>
                <?php foreach ($paidBy as $index => $person): ?>
                <tr>
                        <td>
                            <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox_<?= $index ?>">
                        </td>
                        <td >
                            <label class="form-label" for="check"><?=$person['full_name']  ?></label>
                        </td>
                        <td >
                            <input class="form-control" type="number" id="weight_<?= $index ?>" name="weight_<?= $index ?>" min="1" max="10">
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
        </form>
    </div>
</div>





</form>
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
function validateForm() {

    var title = document.getElementById("title").value;
    var amount = document.getElementById("amount").value;


    if (title == "" || amount == "") {
    alert("Veuillez remplir tous les champs obligatoires.");
    return false;
    }


    if (isNaN(amount) || amount <= 0) {
        alert("Le montant doit être un nombre positif.");
        return false;
    }


    return true;
}
</script>

