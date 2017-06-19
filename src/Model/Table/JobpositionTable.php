<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobposition Model
 *
 * @method \App\Model\Entity\Jobposition get($primaryKey, $options = [])
 * @method \App\Model\Entity\Jobposition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Jobposition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Jobposition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Jobposition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Jobposition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Jobposition findOrCreate($search, callable $callback = null, $options = [])
 */
class JobpositionTable extends Table
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

        $this->table('jobposition');
        $this->displayField('jobtitle');
        $this->primaryKey('id');

        $this->hasMany('employee');
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
            ->requirePresence('jobtitle', 'create')
            ->notEmpty('jobtitle');

        $validator
            ->requirePresence('jobdescription', 'create')
            ->notEmpty('jobdescription');

        /*$validator
            ->integer('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

        return $validator;
    }
}
