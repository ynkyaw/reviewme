<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Routing\Router;
$this->layout = 'superadmin';
?>

 <div id="page-wrapper1" style="margin: 0 0 0 290px;">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="page-header">Users</h4>
            </div>
            <div class="col-sm-2" style="text-align: right;">
                <a href="<?php echo Router::url('/', true);?>users/add" style="color: white;">
                    <button type="button" class="btn btn-primary btn-circle btn-lg" id="btnNew" style="margin-top:5em;margin-bottom:40px;padding:0px;"> New
                </a>
            </div>
        </div>
        <!-- Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary" style="width:950px;">
                    <div class="panel-heading">
                        User Table
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                    $currentpage = $this->Paginator->current($model = null)-1;
                                    $count = (10*$currentpage)+1;
                                    foreach ($users as $user): 
                                ?>
                                <tr class="odd gradeX">
                                    <td><?= $count++ ?></td>
                                    <td><?= h($user->username) ?></td>
                                    <td><?= h($user->email) ?></td>
                                    <td><?= h($user->role->rolename) ?></td>
                                    
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete user : {0}?', $user->username),'style'=>'color:red']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>                                
                            </tbody>
                        </table>
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->first('<< ' . __('first')) ?>
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                                <?= $this->Paginator->last(__('last') . ' >>') ?>
                            </ul>
                            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            <!-- /.panel -->
            </div>
        </div>
    </div>