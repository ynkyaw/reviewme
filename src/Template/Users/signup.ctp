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
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Signup</h3>
                </div>
                <div class="panel-body">
                    <?= $this->Form->create($user) ?>
                        <fieldset>
                            <span id="txtHint"></span>
                            <div class="form-group" style="padding: .5em;">                               
                                <?= $this->Form->input('username',['class'=>'form-control','id'=>'username','onblur'=>'findUser()','label'=>false,'placeholder'=>'UserName','autofocus','required','pattern'=>'^[A-Za-z0-9_]{1,15}$','type'=>'text','oninvalid'=>'this.setCustomValidity("Name must be start with character and must avoid special characters and whitespace!")'])?>
                            </div>
                            <span id="txtHint1"></span>
                            
                            <div class="form-group" style="padding: .5em;">
                                <?= $this->Form->input('email',['class'=>'form-control','id'=>'email','onblur'=>'findEmail()','placeholder'=>'Email','autofocus','label'=>false])?>
                            </div>

                            <div class="form-group" style="width: 100%; padding: .5em;">
                                <?= $this->Form->input('password',['class'=>'form-control','label'=>false,'placeholder'=>'Password','type'=>'password','autofocus','required','pattern'=>'(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}','onchange'=>'this.setCustomValidity(this.validity.patternMismatch ? "Must have at least 6 characters" : ""); if(this.checkValidity()) form.password_two.pattern = this.value;','name'=>'password','id'=>'password'])?>
                            </div>
                            <div class="form-group" style="width: 100%; padding: .5em;">
                               <input id="password" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" class="form-control" placeholder="Verify Password" required>   
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <?= $this->Form->button(__('Submit'),['class'=>'btn btn-lg btn-primary btn-block']) ?>
                        </fieldset>
                            <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function findUser(){
       
            $.ajax({
                  type: "GET",
                  url: "<?php echo Router::url('/', true);?>users/checkuser/"+$("#username").val()
                }).done(function(data){
                   $("#txtHint").html(data);

                }).fail(function ( jqXHR, textStatus, errorThrown ) {
                    console.log(jqXHR);
                    console.log(jqXHR.responseText);
                    
                });
        }

        function findEmail(){
            $.ajax({
                type: "GET",
                  url: "<?php echo Router::url('/', true);?>users/checkemail/"+$("#email").val()
                  }).done(function(data){
                   $("#txtHint1").html(data);

                }).fail(function ( jqXHR, textStatus, errorThrown ) {
                    console.log(jqXHR);
                    console.log(jqXHR.responseText);
                    
                });
        }

    </script>
   

