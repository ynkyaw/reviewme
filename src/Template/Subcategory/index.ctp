<?php
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="page-header">SubCategory</h4>
            </div>
            <div class="col-sm-2">                
            </div>            
        </div>
        <div class="row" style="margin-bottom: 10px;width:1100px;">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2" style="padding-top: 0px;">
                <a href="subcategory/add" class="btn btn-primary btn-circle btn-lg" style="color: white;width: 90px;padding-top: 0.75em;margin-top: -1em">                
                    <i class="fa fa-question-circle-o">
                    </i> New
                </a>
            </div>
        </div>
    </div>    

    <div class="row"    >
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <?= $this->Form->create('Subcategory',['type' => 'file','url' => ['controller'=>'Subcategory','action' => 'import'],'class'=>'form-inline','role'=>'form',]) ?>
            <div class="form-group">
                <label class="sr-only" for="csv"> CSV </label>
                <?php echo $this->Form->input('csv', ['type'=>'file','class' => 'form-control', 'label' => false ,'placeholder' => 'csv upload',]); ?>
            </div>
            <button type="submit" class="btn btn-default"> Upload </button>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="gab" style="height:30px;align:right;"></div>

    <div class="row">
        <div class="col-md-7">
        </div>
        <div class="col-md-4"> 
            <?php 
                $message = $this->Flash->render();
                if($message!= null && $message!=""){
                    echo "<div class='alert alert-success'>".$message."</div>";
                } 
            ?> 
        </div>
    </div>  

    <div class="panel-group" id="accordion" style="width:1000px;">

    <?php
        $count = 1;
        if($questiontype != null)
        {
        foreach ($questiontype as $questiontype): 
        $name = 'q'.$count;
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="fa fa-comment-o fa-fw"></i><a data-toggle="collapse" style="color:white" data-parent="#accordion" href="#groupA<?=$count?>"><?= h($questiontype->questioncategoryname) ?></a>
            </h4>
        
        </div>
        <div id="groupA<?=$count?>" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><b>No</b></th>
                                <th><b>Subcategory Name </b></th>
                                <th><b>Subcategory Description </b></th>
                                <th><b>Subcategory Weight</b></th>
                                <th><b>Actions</b></th>
                            <tr>
                        </thead>
                        <tbody>
                        <?php
                            $number1 = 1;
                            if($eachsubcategory[$name] != null)
                            { 
                            foreach ($eachsubcategory[$name] as $eachquestion1): 
                        ?>
                            <tr>
                                <td><?= $number1++ ?></td>
                                <td>
                                     <?= h($eachquestion1->name) ?>
                                </td>
                                <td ><?= h($eachquestion1->description) ?></td>
                                <td style="text-align:center"><?= h($eachquestion1->subcategoryweight) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eachquestion1->id]) ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eachquestion1->id], ['confirm' => __('Are you sure you want to delete subcategory : {0}?', $eachquestion1->name),'style'=>'color:red']) ?>
                                </td>                                              
                            </tr>
                           <?php endforeach; 
                            $count++;
                        }
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; 
    }
    ?>
    </div>
</div>