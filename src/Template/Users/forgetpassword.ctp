<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

$this->layout = false;


?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ReviewMe</title>

    
    <link href="<?php echo Router::url('/', true);?>css/treeview.min.css" rel="stylesheet"  type="text/css">
    <link href="<?php echo Router::url('/', true);?>css/bypeople.css" rel="stylesheet"  type="text/css">
    <link href="<?php echo Router::url('/', true);?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="<?php echo Router::url('/', true);?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/jquery/jquery.ui.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo Router::url('/', true);?>dist/js/sb-admin-2.js"></script>
    <script src="<?php echo Router::url('/', true);?>js/bypeople.js"></script>    
    <script src="<?php echo Router::url('/', true);?>js/date-util.js"></script>
</head>
<?= $this->Flash->render();?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Forget Password</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            Forgot your account's password? Enter your email address and we'll send you a recovery link.
                        </div>
                    </div>


                    <div id="errorContainer">
                        
                    </div>


                    <div class="row" style="padding-bottom: 5px;">
                        <div class="col-sm-4">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" name="txtEmial" id="txtEmial" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 5px;padding-top: 5px;">
                        <div class="col-md-4 col-md-offset-4">
                            <input type="button" name="btnSendMail" id="btnSendMail" class="btn btn-primary" value="Send E-mail"> &nbsp;
                            <img src="<?php echo Router::url('/', true);?>img/preloader.gif" width='20px;' height='20px;' style="visibility: hidden;" id='loadingImg'/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {



        $('#btnSendMail').click(function(e){
            document.getElementById('btnSendMail').disabled = true;
            document.getElementById('loadingImg').style = "";
            document.getElementById("errorContainer").innerHTML = "";
            var email = document.getElementById('txtEmial').value;
            var regEmailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!regEmailPattern.test(email))
            {
                var errMessage = "<br/><div class='alert alert-danger'>Invalid Email Format!</div>";
                document.getElementById("errorContainer").innerHTML = errMessage;
                return;
            }

            $.ajax({
              type: "POST",
              url: "<?php echo Router::url('/', true);?>users/sendemail/"+document.getElementById('txtEmial').value
            }).done(function(result)
            {            
                
                //alert(result);
                document.getElementById("errorContainer").innerHTML = result;
                document.getElementById('btnSendMail').disabled = false;
                document.getElementById('loadingImg').style = "visibility: hidden;";
                return;
                console.log(result);
                document.getElementById("btnCloseCategory").click();
                CreateNewCategory(JSON.parse(result));

            }).fail(function ( jqXHR, textStatus, errorThrown ) 
            {
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                document.getElementById('btnSendMail').disabled = false;
                document.getElementById('loadingImg').style = "visibility: hidden;";
                alert(textStatus);
                alert(errorThrown);
            });
        });
    });
</script>