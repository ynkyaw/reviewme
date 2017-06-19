<?php
namespace App\Controller;

use Cake\Utility\Text;
use Cake\I18n\Time;
use Cake\Routing\Router;
use App\Controller\AppController;
use Cake\View\Helper\SessionHelper;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Device;
use Cake\Mailer\Email;
use Cake\Cache\Cache;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher; //Default Password Hasher
//use Cake\I18n\Time;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $users = $this->paginate($this->Users);

         $this->paginate = array(
        'limit' => 20);
        $users = $this->paginate($this->Users->find('all')->contain(['role'])->where(['Users.isdeleted' => 0]));

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        // $this->set(compact('user','roles','ur','layout'));
        // $this->set('_serialize', ['user','roles','ur','layout']);

        $this->set(compact('users','menuAry','headerAry'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->Role = TableRegistry::get('Role');

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $employees = $this->Users->Employee->find('list', array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);
        $roles = $this->Role->find('list', array('fields' => array('id', 'rolename')))->where(['isdeleted' =>0]);

        $this->set(compact('user','menuAry','headerAry','roles','employees'));
        $this->set('_serialize', ['user','roles','employees']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $this->Employee = TableRegistry::get('Employee');
        $this->Role = TableRegistry::get('Role');
        
        if ($this->request->is('post')) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            $today = date("Y-m-d H:i:s");
            $user->registered = $today;
            $user->isactive = true;
            $user->activated = $today;
            $user->islock = false;
            $user->isdeleted = false;
            
            //echo json_encode($user);
            
            if ($this->Users->save($user)) 
            {
                $this->Flash->success(__('The user has been saved.'));
                $employee = $this->Employee->find('all')->where(['isdeleted' => 0,'id'=>$user->employee_id])->first();

                $employee->userid = $user->id;
                $this->Employee->save($employee);

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $employees = $this->Users->Employee->find('list', array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);
        $roles = $this->Role->find('list', array('fields' => array('id', 'rolename')))->where(['isdeleted' =>0]);

        $this->set(compact('user','menuAry','headerAry','roles','employees'));
        $this->set('_serialize', ['user','roles','employees']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->Role = TableRegistry::get('Role');

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $roles = $this->Role->find('list', array('fields' => array('id', 'rolename')))->where(['isdeleted' =>0]);
        $employees = $this->Users->Employee->find('list', array('fields' => array('id', 'name')))->where(['isdeleted' => 0]);

        $this->set(compact('user','menuAry','headerAry','roles','employees'));
        $this->set('_serialize', ['user','roles','employees']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put','delete'])) 
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->isdeleted = 1;
            if ($this->Users->save($user)) 
            {
                $this->Flash->success(__('The user has been deleted.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function signup()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            $now = Time::now();
            $user->registered = $now;
            //$user->isactive=true;
            $user->islock=false;
            $user->isdeleted=false;
            $user->isactive=false;
            //echo $user;

            if ($this->Users->save($user)) 
            {
                $this->Flash->success(__('SignUp Success!'));

                return $this->redirect(['controller'=>'Pages','action'=>'welcome']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function activate($empid=null)
    {
        $this->Users = TableRegistry::get('Users');
        $roles = TableRegistry::get('Role');

        $user = $this->Users->get($empid,['contain' => []]);
        
        $roles = $this->Users->Role->find('list', array('fields' => array('id', 'rolename')));

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            //echo $this->request->data('id');
            $ur = $this->Users->get($this->request->data('id'),['contain' => []]);
            
            $ur->roleid = $this->request->data('role');
            $ur->isactive = true;
            
            if ($this->Users->save($ur)) 
            {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'activatelist']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('user','roles','ur','menuAry','headerAry'));
        $this->set('_serialize', ['user','roles','ur']);
    }

    public function activatelist()
    {
        $this->Users = TableRegistry::get('Users');
        $roles = TableRegistry::get('Role');

        $user = $this->Users->newEntity();

        $userList = $this->Users->find('all')->where(['isactive' => false]);

        $obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('user','userList','menuAry','headerAry'));
        $this->set('_serialize', ['user','userList']);
    }

    public function doactivate($id,$role)
    {
        //echo "reached";
        $this->layout = 'ajax';

         if ($this->request->is('post') || $this->request->is('put')) 
         {
             if(!$id)
            {
                $id = @$this->request->data('id');
            }

            if(!$role)
            {
                $role = @$this->request->data('role');
            }
        }
        $user = $this->Users->newEntity();
        $users = $this->Users->find('all')->where(['id' => 'id']);
        $users->isactive=true;

        if ($this->Users->save($user))
        {
            $this->Flash->success(__('Activate Success!'));

            return $this->redirect(['controller'=>'Pages','action'=>'welcome']);
        }
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }   

    public function login()
    {
        $session = $this->request->session();
        $this->Users = TableRegistry::get('Users');
        
        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $this->request->data);
        $username = $user->username;
        $password = $user->password;
           
        if ($this->request->is('post')) 
        {            
            $login = $this->Users->find('all', array('conditions' => array('Users.username' => $username)))->toArray();            
            
            if(count($login)>0)
            {
                $myuser = null;
                foreach ($login as $l) {
                    $myuser = $l;
                }
                //$user = $login[0];
                if(!$myuser ->islock)
                {                
                    $authuser = $this->Auth->identify();
                    if ($authuser) 
                    {
                        $session->write('logincount',0);
                        if($myuser->isactive)
                        {
                            $this->Auth->setUser($authuser);
                            $session->write('userid',$myuser->id);
                            $session->write('username',$myuser->username);                           

                            return $this->redirect(['controller'=>'Dashboard','action'=>'index']);
                        }
                        else
                        {
                            $this->Flash->error(__('The user account need to activate.Please contact your administrator'));
                        }
                    }else
                    {
                        if(count($login)>0)
                        {
                        
                            $logincount = $session->read('logincount');
                            echo $logincount;
                            //die();
                            if(!$logincount)
                            {
                                $logincount=1;
                            }
                            else
                            {
                                $logincount+=1;
                                if($logincount>5)
                                {
                                    $this->Flash->error(__('Account is locked'));
                                    $user->islock= true;
                                    if($this->Users->save($user)){
                                        $this->Flash->error(__('The user account has been locked.'));
                                    }   
                                }else
                                {
                                    $this->Flash->error(__('Invalid Password.'));           
                                }
                                
                            }
                            $session->write('logincount',$logincount);
                        }
                    }
                }
                else
                {
                    $this->Flash->set('Locked.');
                }
            }
            else
            {
                $this->Flash->error(__('Invalid Username.'));
            }            
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout']);
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function checkuser($username){

        // $user = $this->Users->newEntity();
        // $user = $this->Users->patchEntity($user, $this->request->data);
        // $username = $user->username;
       
            $user = $this->Users->findByUsername($username)->first();
            if($username != ""){
                if($user==null){
                    echo "<span style='color:green; margin-left: .1em;'>User Available</span>";
                }
                else{
                    echo "<span style='color:red; margin-left: .1em;'>User Already Exist!</span>";
                }
            }else{
                echo "<span style='color:red; margin-left: .1em;'>User Name must be filled!</span>";
            }
            die();        
    }

    public function checkemployee($empname)
    {        
        $employee = $this->Users->find()->where(['isdeleted' => 0,'employee_id' => $empname])->first();
        if($empname != "")
        {
            if($employee == null)
            {
                echo "<span style='color:green; margin-left: .1em;'>Available Employee</span>";
            }
            else
            {
                echo "<span style='color:red; margin-left: .1em;'>Employee Already Exists!</span>";
            }
        }
        else
        {
            echo "<span style='color:red; margin-left: .1em;'>Employee must be filled!</span>";
        }
        die();
    }

    public function checkemail($email){
       
            $user = $this->Users->findByEmail($email)->first();
            if($email != "")
            {
                if($user==null)
                {
                    echo "<span style='color:green; margin-left: .1em;'>Available Email</span>";
                }
                else
                {
                    echo "<span style='color:red; margin-left: .1em;'>Email Already Exists!</span>";
                }
            }
            else
            {
                echo "<span style='color:red; margin-left: .1em;'>Email must be filled!</span>";
            }
            die;        
    }

    public function forgetpassword(){


    }

    public function changepassword($id)
    {
        $user = $this->Users->newEntity();
        $user = $this->Users->findById($id)->first();

        
        if (count($this->request->data)>0) {
            
            $change_user = $this->Users->patchEntity($user, $this->request->data);
            $hasher = new DefaultPasswordHasher();
            $newpassword = $hasher->hash($change_user->password);
            if($newpassword==$user->password)
            {
                
                    $this->Flash->error(__('New password shouldn\'t be same with old one.'));
                
            }else{
                
                if ($this->Users->save($user))
                {
                    $this->Flash->success(__('Password successfully changed.'));    
                    return $this->redirect(['controller'=>'Users','action'=>'passwordchangesuccess']);
                }
            }         
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function passwordchangesuccess(){}

    public function reset($encrypted=null)
    {        
        if($encrypted!=null)
        {
            $plain = base64_decode($encrypted);
            //$array = Text::tokenize($plain, '|','','');
             $array = explode(",", $plain);
            $userid = $array[0];
            //echo "User:".$userid;
            $time = new Time($array[1], 'Asia/Rangoon');
            //echo "Time:".$time;
            $isWithinOneDay =$time->wasWithinLast(1); 
                
                if($isWithinOneDay)
                {
                    //echo "Within";
                    return $this->redirect(['controller'=>'Users','action'=>'changepassword',$userid]);
                }
                else
                {
                    //echo "expire";
                    return $this->redirect(['controller'=>'Users','action'=>'expirelink']);
                }
        }
        else{
            echo "Fool!";
            die();
        }

    }

    public function expirelink()
    {
        
    }

    public function sendemail($email = "")
    {
        if($email != "")
        {
            $user = $this->Users->findByEmail($email)->first();
            if($user==null)
            {
               echo "<div class='alert alert-warning'>Email doesn't exist!</div>";
               die();
            }
            else
            {                
                try{
                    // Get the current time.
                    $time = Time::now();
                    $time->timezone = 'Asia/Rangoon';

                    $plain = $user->id."|".$time;
                    $encrypted = base64_encode($plain);

                    //echo 'encrypted string:'.$encrypted;

                    $body = 'Hi '.$user->username;
                    $body = $body.",<br/>";
                    $body = $body."<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    $body = $body."You recently requested a password reset.<br/>";
                    $body = $body."To change your ReviewMe password, click ";
                    $body = $body."<a href='".Router::url('/', true)."users/reset/";
                    $body = $body.$encrypted."' > here</a> or paste the following link ";
                    $body = $body."into your browser <u>".Router::url('/', true);
                    $body = $body."users/reset/".$encrypted."</u>.<br/>";
                    $body = $body."The link will expire in 24 hours, so be sure to use it right away. <br/><br/>";
                    $body = $body ."Thanks for using ReviewMe!<br/>";
                    $body = $body ."The ReviewMe Team";


                    $send_email = new Email('default');
                    $send_email->from(['reviewme.owner@gmail.com' => 'ReviewMe Team'])
                        ->emailFormat('html')
                        ->to($email)
                        ->subject($user->username.',here\'s the link to reset your password')
                        ->send($body);

                    }catch(\Exception $ex){
                        echo "<div class='alert alert-warning'>Invalid Email Address! Sending Failed!</div>";
                        echo $ex->getMessage();
                        die();
                    }
                    echo "<div class='alert alert-info'>Success Email!</div>";
                    // $email->template('welcome', 'fancy')
                    // ->emailFormat('html')
                    // ->to($email)
                    // ->from('reviewme.owner@domain.com')
                    // ->send();

                    die();
            }
        }
        else
        {
            echo "<span style='color:red; margin-left: .1em;'>Email must be filled!</span>";
            die();
        }
    }
}
