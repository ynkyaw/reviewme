<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewReviewer Model
 *
 * @method \App\Model\Entity\ReviewReviewer get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewReviewer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReviewReviewer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewReviewer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewReviewer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewReviewer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewReviewer findOrCreate($search, callable $callback = null, $options = [])
 */
class ReviewReviewerTable extends Table
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

        $this->table('review_reviewer');
        $this->displayField('reviewid');
        $this->primaryKey(['reviewid', 'reviewerid']);
        
        $this->belongsToMany('Review', [
            'foreignKey' => 'reviewid',
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
            ->integer('reviewid')
            ->allowEmpty('reviewid', 'create');

        $validator
            ->integer('reviewerid')
            ->allowEmpty('reviewerid', 'create');

        return $validator;
    }
}
