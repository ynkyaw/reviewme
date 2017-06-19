<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
/**
 * Employeegroup Controller
 *
 * @property \App\Model\Table\EmployeegroupTable $Employeegroup
 */
class ReportListController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()    
    {
    	$obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('headerAry','menuAry'));
        $this->set('_serialize', ['']);
    }

    public function indexproduct()
    {
    	$obj = parent::getauthorization();
        $menuAry = $obj->menu;
        $headerAry =$obj->header;

        $this->set(compact('headerAry','menuAry'));
        $this->set('_serialize', ['']);
    }
}