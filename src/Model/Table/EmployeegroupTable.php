<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employeegroup Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Employee
 *
 * @method \App\Model\Entity\Employeegroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employeegroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employeegroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employeegroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employeegroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employeegroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employeegroup findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeegroupTable extends Table
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

        $this->table('employeegroup');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Employee', [
            'foreignKey' => 'employeegroup_id',
            'targetForeignKey' => 'employee_id',
            'joinTable' => 'employees_employeegroups'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

      /*  $validator
            ->requirePresence('employee','create')
            ->notEmpty('employee');*/
            
        /*$validator
            ->integer('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

        return $validator;
    }
}
