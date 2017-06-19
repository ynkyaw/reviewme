<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizationreviewsresultdetail Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizationreviewsresults
 * @property \Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\Organizationreviewsresultdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Organizationreviewsresultdetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresultdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresultdetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organizationreviewsresultdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresultdetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresultdetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationreviewsresultdetailTable extends Table
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

        $this->table('organizationreviewsresultdetail');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organizationreviewsresults', [
            'foreignKey' => 'organizationreviewsresult_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Question', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
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
            ->decimal('mark')
            ->requirePresence('mark', 'create')
            ->notEmpty('mark');

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
        $rules->add($rules->existsIn(['organizationreviewsresult_id'], 'Organizationreviewsresults'));
        $rules->add($rules->existsIn(['question_id'], 'Question'));

        return $rules;
    }
}
