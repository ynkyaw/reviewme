<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemreviewsReviewers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Itemreviews
 *
 * @method \App\Model\Entity\ItemreviewsReviewer get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewer findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemreviewsReviewersTable extends Table
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

        $this->table('itemreviews_reviewers');
        $this->displayField('itemreviews_id');
        $this->primaryKey(['itemreviews_id', 'reviewerid']);

        $this->belongsToMany('Itemreviews', [
            'foreignKey' => 'itemreviews_id',
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
        $rules->add($rules->existsIn(['itemreviews_id'], 'Itemreviews'));

        return $rules;
    }
}
