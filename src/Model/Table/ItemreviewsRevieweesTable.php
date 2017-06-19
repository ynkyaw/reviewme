<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemreviewsReviewees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Itemreviews
 *
 * @method \App\Model\Entity\ItemreviewsReviewee get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsReviewee findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemreviewsRevieweesTable extends Table
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

        $this->table('itemreviews_reviewees');
        $this->displayField('itemreviews_id');
        $this->primaryKey(['itemreviews_id', 'revieweeid']);

        $this->belongsTo('Itemreviews', [
            'foreignKey' => 'itemreviews_id',
            'joinType' => 'INNER'
        ]);

       /* $this->belongsToMany('Employee', [
                'foreignKey' => 'revieweeid',
                'joinType' => 'INNER'
            ]);*/

        $this->belongsToMany('Products', [
            'foreignKey' => 'revieweeid',
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
        $rules->add($rules->existsIn(['itemreviews_id'], 'Itemreviews'));

        return $rules;
    }
}
