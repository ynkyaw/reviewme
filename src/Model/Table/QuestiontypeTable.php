<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questiontype Model
 *
 * @method \App\Model\Entity\Questiontype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Questiontype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Questiontype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Questiontype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Questiontype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Questiontype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Questiontype findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestiontypeTable extends Table
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

        $this->table('questiontype');
        $this->displayField('questiontypename');
        $this->primaryKey('id');

        $this->hasMany('question');
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
            ->allowEmpty('questiontypename');

        $validator
            ->allowEmpty('questiondescription');

        $validator
            ->decimal('questionweight')
            ->requirePresence('questionweight', 'create')
            ->notEmpty('questionweight');

        /*$validator
            ->integer('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

        return $validator;
    }
}
