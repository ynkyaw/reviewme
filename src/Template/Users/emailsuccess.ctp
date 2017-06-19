<?php
/**
  * @var \App\View\AppView $this
  */
    $this->layout=false;
    use Cake\Routing\Router;
?>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ForgetPswd.css" rel="stylesheet" type="text/css">
    <script src="<?php echo Router::url('/', true);?>vendor/jquery/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-success">
              <strong>Success!</strong> Please check your email to reset password.
            </div>
        </div>
    </div>
</div>