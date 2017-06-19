<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Itemreviewsresultdetail Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Itemreviewsresults
 * @property \Cake\ORM\Association\BelongsTo $Question
 *
 * @method \App\Model\Entity\Itemreviewsresultdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Itemreviewsresultdetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresultdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresultdetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Itemreviewsresultdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresultdetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresultdetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemreviewsresultdetailTable extends Table
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

        $this->table('itemreviewsresultdetail');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Itemreviewsresults', [
            'foreignKey' => 'itemreviewsresult_id',
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
        $rules->add($rules->existsIn(['itemreviewsresult_id'], 'Itemreviewsresults'));
        $rules->add($rules->existsIn(['question_id'], 'Question'));

        return $rules;
    }
}
