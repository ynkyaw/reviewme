<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questioncategory Model
 *
 * @method \App\Model\Entity\Questioncategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Questioncategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Questioncategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Questioncategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Questioncategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Questioncategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Questioncategory findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestioncategoryTable extends Table
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

        $this->table('questioncategory');
        $this->displayField('questioncategoryname');
        $this->primaryKey('id');

        $this->hasMany('question');

        $this->hasMany('subcategory');
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
            ->requirePresence('questioncategoryname','create')
            ->notEmpty('questioncategoryname');

        $validator
            ->allowEmpty('questioncategorydescription');

        $validator
            ->decimal('questioncategoryweight')
            ->requirePresence('questioncategoryweight', 'create')
            ->notEmpty('questioncategoryweight');

      /*  $validator
            ->integer('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

        return $validator;
    }
}
