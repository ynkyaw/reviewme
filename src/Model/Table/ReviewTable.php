<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Review Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reviewtype
 * @property \Cake\ORM\Association\BelongsTo $Owners
 * @property \Cake\ORM\Association\BelongsToMany $Question
 *
 * @method \App\Model\Entity\Review get($primaryKey, $options = [])
 * @method \App\Model\Entity\Review newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Review[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Review|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Review patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Review[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Review findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewTable extends Table
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

        $this->table('review');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Reviewtype', [
            'foreignKey' => 'reviewtype_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Employee', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('reviewcategory');

        $this->belongsToMany('Reviewees', [
            'foreignKey' => 'review_id',
            'targetForeignKey' => 'employee_id',
            'joinTable' => 'review_reviewee'
        ]);

         $this->belongsToMany('Reviewers', [
            'foreignKey' => 'review_id',
            'targetForeignKey' => 'employee_id',
            'joinTable' => 'review_reviewer'
        ]);

        $this->belongsToMany('Question', [
            'foreignKey' => 'review_id',
            'targetForeignKey' => 'question_id',
            'joinTable' => 'review_question'
        ]);


        $this->belongsToMany('Reviewers', [
            'foreignKey' => 'reviewid',
            'targetForeignKey' => 'reviewerid',
            'joinTable' => 'review_reviewer'
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'reviewid',
            'targetForeignKey' => 'reviewerid',
            'joinTable' => 'review_reviewer'
        ]);

        //  $this->belongsTo('Reviewresult', [
        // 'foreignKey' => 'reviewid',
        // 'joinType' => 'INNER'
        // ]);
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('goal', 'create')
            ->notEmpty('goal');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->date('startdate')
            ->requirePresence('startdate', 'create')
            ->notEmpty('startdate');

        $validator
            ->date('enddate')
            ->requirePresence('enddate', 'create')
            ->notEmpty('enddate');

        $validator
            ->boolean('is_self')
            ->allowEmpty('is_self');

        $validator
            ->integer('maxreview')
            ->allowEmpty('maxreview');

        $validator
            ->integer('maxreviewed')
            ->allowEmpty('maxreviewed');

        $validator
            ->integer('minreview')
            ->allowEmpty('minreview');

        $validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');

        return $validator;
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
        $rules->add($rules->existsIn(['reviewtype_id'], 'Reviewtype'));
        //$rules->add($rules->existsIn(['owner_id'], 'Owners'));

        return $rules;
    }
}
