<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
use Cake\Routing\Router;
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
   <div class="row">
        <div class="col-sm-10">                
            <h4 class="page-header" >Users</h4>            
        </div>            
    </div>
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info"  style="width:700px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($user) ?>
                    <fieldset>
                        
                        <div class="form-group">    
                            <label for="en" style="floating:right">User Name </label><label style="color:red;font-size:18px;">*</label><br/>
                            <span id="txtHint"></span>
                            <?= $this->Form->input('username',['class'=>'form-control','id'=>'username','onblur'=>'findUser()','label'=>false,'placeholder'=>'UserName','autofocus','required','pattern'=>'[a-z][a-z\d]+','type'=>'text','oninvalid'=>'this.setCustomValidity("Name must be start with character and must avoid special characters and whitespace!")','onchange'=>'try{this.setCustomValidity(\'\')}catch(e){}']) ?>
                        </div>

                        <div class="form-group">
                            <label for="en" style="floating:right">Employee </label><label style="color:red;font-size:18px;">*</label>
                           
                           <?= $this->Form->input('employee_id',['options' => $employees,'empty' => 'Select Employee','class'=>'form-control','label'=>false]) ?>
                        </div>
                        
                        <div class="form-group">
                           <label for="en" style="floating:right">Email </label><label style="color:red;font-size:18px;">*</label><br/>
                           <span id="txtHint1"></span>
                            <?= $this->Form->input('email',['class'=>'form-control','id'=>'email','onblur'=>'findEmail()','placeholder'=>'Email','autofocus','label'=>false]) ?>
                        </div>                            
                        <div class="form-group">
                            <label for="en" style="floating:right">Password </label><label style="color:red;font-size:18px;">*</label>
                            <?= $this->Form->input('password',['class'=>'form-control','label'=>false,'placeholder'=>'Password','type'=>'password','autofocus','required','pattern'=>'(?=.*\d)(?=.*[a-zA-Z]).{6,}','onchange'=>'this.setCustomValidity(this.validity.patternMismatch ? "Must have at least 6 characters" : ""); if(this.checkValidity()) form.password_two.pattern = this.value;','name'=>'password','id'=>'password']) ?>
                        </div>
                        <div class="form-group">
                            <label for="en" style="floating:right">Verify Password </label><label style="color:red;font-size:18px;">*</label>
                            <input id="password" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" class="form-control" placeholder="Verify Password" required > 
                           
                        </div>

                        <div class="form-group">
                            <label for="en" style="floating:right">Roles </label><label style="color:red;font-size:18px;">*</label>
                           
                           <?= $this->Form->input('roleid',['options' => $roles,'empty' => 'Select Role','class'=>'form-control','label'=>false]) ?>
                        </div>
                        
                    </fieldset>
                    <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        function findUser()
        {
            var userName = $("#username").val().trim();
            if(userName.length>3)
            {
                $.ajax({
                      type: "GET",
                      url: "<?php echo Router::url('/', true);?>users/checkuser/"+userName
                    }).done(function(data){
                       $("#txtHint").html(data);

                    }).fail(function ( jqXHR, textStatus, errorThrown ) {
                        console.log(jqXHR);
                        console.log(jqXHR.responseText);
                        
                    });
            }
        }

        function findEmail(){
            var email = $("#email").val().trim();
            if(email.length>3)
            {
                $.ajax({
                    type: "GET",
                      url: "<?php echo Router::url('/', true);?>users/checkemail/"+email
                      }).done(function(data){
                       $("#txtHint1").html(data);

                    }).fail(function ( jqXHR, textStatus, errorThrown ) {
                        console.log(jqXHR);
                        console.log(jqXHR.responseText);
                        
                    });
            }
        }



        function CheckValidation()
        {



        }
    </script>

   