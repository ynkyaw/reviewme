<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationreviewsReviewers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizationreviews
 *
 * @method \App\Model\Entity\OrganizationreviewsReviewer get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsReviewer findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationreviewsReviewersTable extends Table
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

        $this->table('organizationreviews_reviewers');
        $this->displayField('organizationreviews_id');
        $this->primaryKey(['organizationreviews_id', 'reviewerid']);

        $this->belongsTo('Organizationreviews', [
            'foreignKey' => 'organizationreviews_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Employee', [
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
            ->integer('reviewerid')
            ->allowEmpty('reviewerid', 'create');

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
