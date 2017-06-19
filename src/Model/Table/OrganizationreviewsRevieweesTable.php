<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationreviewsReviewees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizationreviews
 *
 * @method \App\Model\Entity\OrganizationreviewsReviewee get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewee findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationreviewsRevieweesTable extends Table
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

        $this->table('organizationreviews_reviewees');
        $this->displayField('organizationreviews_id');
        $this->primaryKey(['organizationreviews_id', 'revieweeid']);

        $this->belongsTo('Organizationreviews', [
            'foreignKey' => 'organizationreviews_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Department', [
            'foreignKey' => 'reviewerid',
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
            ->integer('revieweeid')
            ->allowEmpty('revieweeid', 'create');

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
