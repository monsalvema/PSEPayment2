
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment page</title>

    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/business-frontpage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Payment page</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Header with Background Image -->
<header class="business-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="display-3 text-center text-white mt-4 mb-0">Payment test</h1>
            </div>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container">
    <?php if (isset($sMessage)) {
        ?>
        <div class="text-center col-sm-12 error mt-5">
            <p><?php echo $sMessage ?></p>
        </div>
    <?php } ?>
    <form action="index.php" method="post">
        <div class="row">
            <div class="text-center col-sm-12">
                <h2 class="mt-3 mb-3">Seleccione entidad financiera</h2>
                <select class="mt-12 mb-5 inputBanks" id="slcBanks" name="slcBanks">
                    <?php foreach($oBanks as $bank) { ?>
                        <option value="<?php echo $bank->bankCode; ?>"><?php echo $bank->bankName; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="text-center col-sm-12 mb-4">
                <input type="submit" class="btn" value="Continuar compra"/>
                <input type="hidden" id="action" name="action" value="transaction"/>
            </div>
        </div>
    </form>
</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Jhonatan Monsalve 2018</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.bundle.min.js"></script>

</body>

</html>
