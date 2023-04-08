<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_tricount</title>
    <base href="<?= $web_root ?>"/>
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

    <!-- Jquery-->
    <script src="./lib/jquery-3.6.3.min.js" type="text/javascript"></script>

    <!--Sort the operations script-->
    <script>
        // Pass the PHP variable $operations to JavaScript
        const operations = <?php echo json_encode($operations); ?>;
        // Parse the amount to integer so we can sort it after
        for (let operation of operations) {
            operation.amount = parseInt(operation.amount);
        }
        const user_id = <?= $id_user ?>;
        let selectElement;
        let operationsListElement;
        // Get the select element and the list of operations element once the DOM has mounted
        document.onreadystatechange = function () {
            if (document.readyState === 'complete') {
                selectElement = $('.form-select');
                operationsListElement = $('#operations_list');
                // Add a listener to the 'OnChange' event in the select element
                sort();
            }
        };

        function sortOperations(option,sorType) {
            const sortAscending = (sorType === 'asc');
            operations.sort(function (a,b) {
                let aValue = a[option];
                let bValue = b[option];
                // We should compare strings based on their Unicode code points => we need only lower-cases
                if (typeof aValue === "string") {
                    aValue = aValue.toLowerCase();
                }
                if (typeof bValue === "string") {
                    bValue = bValue.toLowerCase();
                }
                if (aValue < bValue)
                    return sortAscending ? -1 : 1;
                if (aValue > bValue)
                    return sortAscending ? 1 : -1;
                return 0;
            });
        }

        function sort() {
            selectElement.on('change', function () {
                // Get the selected value from the <select> element
                const selectedValue = $(this).val().split('-')[0];
                const sorType = $(this).val().split('-')[1];
                sortOperations(selectedValue,sorType);
                displayTable();
            });
        }

        function displayTable(){
            operationsListElement.innerHTML = '';
            let html = "";
            for (let operation of operations) {
                html += "<a href='operation/view_operation/"+ operation.id + "/"+ user_id + "'class='list-group-item list-group-item-action' aria-current='true'>";
                html += "<div class='d-flex w-100 justify-content-between'>";
                html += "<h5 class='mb-1'>"+ operation.title + "</h5>";
                html += "<h6>" + operation.amount + " €</h6></div>";
                html += "<div class='d-flex w-100 justify-content-between'>";
                html += "<small class='mb-1'>Paid by " + operation.name_paid + " </small>";
                html += "<small class='mb-1' style='float: right'>"+ operation.operation_date + " </small></div>";
                html += "</a>";
            }
            //
            operationsListElement.html(html);
        }
    </script>
</head>
<body>



<div class="card-header">
    <div class="d-flex w-100 justify-content-between">
        <a  class="btn btn-outline-danger" href="tricount/tricount">Back</a>
        <h5 style="align-self: center " class="card-title" ><?= $tricount->title ?> > Expenses <h5/>
            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit tricount"  class="btn btn-primary" href="your link of edit here yassin ok ">Edit</a>
    </div>

</div>
<div class="card mx-2">

    <div class ="card-body ">
        <?php if (empty($operations)) : ?>
        <?php if ($tricount->nb_participant < 1) : ?>
            <div>
                <h3> Your are alone !</h3>
                <p> Click below to add your friends ! </p>
                <a href="link ">Add Friends</a>
            </div>
        <?php else : ?>
        <h3> Your Tricount is empty !</h3>
        <p> Click below to add your first expense ! </p>
        <a href="link ">Add an expense</a>
    </div>
    <?php endif; ?>
    <?php else : ?>
        <div class="list-group">
            <a class="btn btn btn-success" href="view balance ">   <i class="bi bi-arrow-left-right"></i>  view balance </a>
            <div class="row mb-3">
                <label for="customRange1" class="form-label">Order this expenses by</label>
                <select class="form-select" >
                    <option selected value="amount-asc">Amount ▲</option>
                    <option value="amount-desc">Amount ▼</option>
                    <option value="operation_date-asc">Date ▲</option>
                    <option value="operation_date-desc">Date ▼</option>
                    <option value="name_paid-asc">Initiator ▲</option>
                    <option value="name_paid-desc">Initiator ▼</option>
                    <option value="title-asc">Title ▲</option>
                    <option value="title-desc">Title ▼</option>
                </select>
            </div>

            <div id="operations_list">
                <?php foreach ($operations as $operation): ?>
                    <a href="operation/view_operation/<?= $operation->id ?>/<?= $id_user ?>" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= $operation->title ?></h5>
                            <h6><?= $operation->amount ?> €</h6>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <small class="mb-1">Paid by <?= $operation->name_paid ?> </small>
                            <small class="mb-1" style="float: right"><?= $operation->operation_date ?> </small>
                        </div>

                    </a>
                <?php endforeach; ?>
            </div>

        </div>
    <?php endif; ?>
</div>

</div>


<div class="card-footer">
    <div class="d-flex w-100 justify-content-between">
        <div class="list-group-item list-group-item-action">
            <small>My total</small>
            <h5 class="mb-1"><?= round($My_total, 2) ?> €</h5>
        </div>
        <a href="operation/add_operation/<?= $tricount->id ?>">

            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add new operation" type="button"
               href="operation/add_operation/<?= $tricount->id ?>"><i
                        class="btn btn-primary bi bi-plus-circle-fill"></i> </a>
            <div class="list-group-item list-group-item-action">

            </div>
            <small>Total expenses</small><br><br>
            <h5> <?= round($Total_expenses, 2) ?>€</h5>
    </div>
</div>

</body>
</html>
