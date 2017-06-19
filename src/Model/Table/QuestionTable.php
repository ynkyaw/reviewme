<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Question Model
 *
 * @method \App\Model\Entity\Question get($primaryKey, $options = [])
 * @method \App\Model\Entity\Question newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionTable extends Table
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

        $this->table('question');
        $this->displayField('questionname');
        $this->primaryKey('id');

        $this->belongsTo('questioncategory', [
        'foreignKey' => 'questiontypeid',
        'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('subcategory', [
        'foreignKey' => 'subcategoryid',
        'joinType' => 'INNER'
        ]);

        $this->belongsToMany('QuestionReview', [
            'foreignKey' => 'questionid',
            'targetForeignKey' => 'reviewid',
            'joinTable' => 'review_question'
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
            ->integer('questiontypeid')
            ->requirePresence('questiontypeid', 'create')
            ->notEmpty('questiontypeid');
            
       /* $validator
            ->integer('subcategoryid')
            ->requirePresence('subcategoryid', 'create')
            ->notEmpty('subcategoryid');*/

        $validator
            ->requirePresence('questionname','create')
            ->notEmpty('questionname');

        $validator
            ->decimal('questionweight')
            ->requirePresence('questionweight', 'create')
            ->notEmpty('questionweight');

        /*$validator
            ->integer('isactive')
            ->requirePresence('isactive', 'create')
            ->notEmpty('isactive');

        $validator
            ->integer('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

        return $validator;
    }
}
