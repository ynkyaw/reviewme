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

$this->layout = false;

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ReviewMe</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Reviewme Login</h3>
                </div>
                <div class="panel-body">
                    <?= $this->Form->create() ?>
                        <!-- <fieldset> -->
                        <?php
                            $message =  $this->Flash->render();
                            if($message!=null)
                            {
                                echo "<div class='form-group'>";
                                    echo "<div class='alert alert-info'>";
                                        echo $message;
                                    echo "</div>";
                                echo "</div>";

                            }

                        ?>

                        <div class="form-group">
                        <?= $this->Form->input('username',['placeholder'=>'User Name','class'=>'form-control','name'=>'username', 'label'=>false,'style'=>'width:100%']) ?>
                        </div>
                        <div class="form-group">
                        	<?= $this->Form->input('password',['placeholder'=>'Password','name'=>'password','class'=>'form-control','label'=>false,'style'=>'width:100%']) ?>
                            
                        </div>
                        <div class="form-group">
                            <p class="text-muted">
                                <a href="forgetpassword">Forget Password?</a>

                                <a href="signup">Sign Up</a>
                            </p>
                        </div>
                        <div class="form-group">
                            
                        </div>
                        <?= $this->Form->button('Login',['class'=>'btn btn-md btn-primary btn-block']) ?>
						<?= $this->Form->end() ?>
                        <!-- </fieldset> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>