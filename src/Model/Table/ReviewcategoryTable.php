<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviewcategory Model
 *
 * @method \App\Model\Entity\Reviewcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reviewcategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reviewcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reviewcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reviewcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewcategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewcategoryTable extends Table
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

        $this->table('reviewcategory');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('review', [
        'foreignKey' => 'reviewid',
        'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Question', [
            'foreignKey' => 'reviewcategory_id',
            'targetForeignKey' => 'question_id',
            'joinTable' => 'reviewcategory_question'
        ]);

        $this->belongsToMany('Employee', [
            'foreignKey' => 'reviewcategory_id',
            'targetForeignKey' => 'reviewer_id',
            'joinTable' => 'reviewcategory_reviewer'
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
            ->integer('reviewid')
            ->allowEmpty('reviewid');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');

        return $validator;
    }
}
