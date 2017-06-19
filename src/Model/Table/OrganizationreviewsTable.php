<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizationreviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reviewtypes
 * @property \Cake\ORM\Association\BelongsTo $Owners
 * @property \Cake\ORM\Association\BelongsToMany $Question
 *
 * @method \App\Model\Entity\Organizationreview get($primaryKey, $options = [])
 * @method \App\Model\Entity\Organizationreview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Organizationreview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organizationreview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreview findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationreviewsTable extends Table
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

        $this->table('organizationreviews');
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

        $this->belongsToMany('Question', [
            'foreignKey' => 'organizationreviews_id',
            'targetForeignKey' => 'question_id',
            'joinTable' => 'organizationreviews_question'
        ]);

        $this->belongsToMany('Reviewers', [
            'foreignKey' => 'organizationreviews_id',
            'targetForeignKey' => 'employee_id',
            'joinTable' => 'organizationreviews_reviewers'
        ]);

        $this->belongsToMany('Reviewees', [
            'foreignKey' => 'organizationreviews_id',
            'targetForeignKey' => 'department_id',
            'joinTable' => 'organizationreviews_reviewees'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('goal');

        $validator
            ->allowEmpty('description');

        $validator
            ->date('startdate')
            ->requirePresence('startdate', 'create')
            ->notEmpty('startdate');

        $validator
            ->date('enddate')
            ->requirePresence('enddate', 'create')
            ->notEmpty('enddate');

        /*$validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

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
        $rules->add($rules->existsIn(['owner_id'], 'Employee'));

        return $rules;
    }
}
