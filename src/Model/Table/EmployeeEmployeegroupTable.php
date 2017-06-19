<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeEmployeegroup Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employee
 * @property \Cake\ORM\Association\BelongsTo $Employeegroup
 *
 * @method \App\Model\Entity\EmployeeEmployeegroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeEmployeegroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeeEmployeegroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeEmployeegroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeEmployeegroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeEmployeegroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeEmployeegroup findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeeEmployeegroupTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('employee_employeegroup');
        $this->displayField('employee_id');
        $this->primaryKey(['employee_id', 'employeegroup_id']);

        $this->belongsTo('Employee', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Employeegroup', [
            'foreignKey' => 'employeegroup_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['employee_id'], 'Employee'));
        $rules->add($rules->existsIn(['employeegroup_id'], 'Employeegroup'));

        return $rules;
    }
}
