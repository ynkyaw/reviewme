<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewReviewee Model
 *
 * @method \App\Model\Entity\ReviewReviewee get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewReviewee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReviewReviewee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewReviewee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewReviewee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewReviewee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewReviewee findOrCreate($search, callable $callback = null, $options = [])
 */
class ReviewRevieweeTable extends Table
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

        $this->table('review_reviewee');
        $this->displayField('reviewid');
        $this->primaryKey(['reviewid', 'revieweeid']);

        $this->belongsToMany('Employee', [
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
            ->integer('reviewid')
            ->allowEmpty('reviewid', 'create');

        $validator
            ->integer('revieweeid')
            ->allowEmpty('revieweeid', 'create');

        return $validator;
    }
}
