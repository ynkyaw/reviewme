<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizationreviewsresults Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizationreviews
 * @property \Cake\ORM\Association\HasMany $Organizationreviewsresultdetail
 *
 * @method \App\Model\Entity\Organizationreviewsresult get($primaryKey, $options = [])
 * @method \App\Model\Entity\Organizationreviewsresult newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organizationreviewsresult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresult[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organizationreviewsresult findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationreviewsresultsTable extends Table
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

        $this->table('organizationreviewsresults');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organizationreviews', [
            'foreignKey' => 'organizationreviews_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Organizationreviewsresultdetail', [
            'foreignKey' => 'organizationreviewsresult_id'
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
            ->integer('reviewerid')
            ->requirePresence('reviewerid', 'create')
            ->notEmpty('reviewerid');

        $validator
            ->integer('revieweeid')
            ->requirePresence('revieweeid', 'create')
            ->notEmpty('revieweeid');

        $validator
            ->boolean('finish')
            ->requirePresence('finish', 'create')
            ->notEmpty('finish');

       /* $validator
            ->boolean('isdeleted')
            ->allowEmpty('isdeleted');*/

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
        $rules->add($rules->existsIn(['organizationreviews_id'], 'Organizationreviews'));

        return $rules;
    }
}
