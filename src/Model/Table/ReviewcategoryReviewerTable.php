<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewcategoryReviewer Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reviewcategory
 * @property \Cake\ORM\Association\BelongsTo $Employee
 *
 * @method \App\Model\Entity\ReviewcategoryReviewer get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewcategoryReviewer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryReviewer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryReviewer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewcategoryReviewer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryReviewer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryReviewer findOrCreate($search, callable $callback = null, $options = [])
 */
class ReviewcategoryReviewerTable extends Table
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

        $this->table('reviewcategory_reviewer');
        $this->displayField('reviewcategory_id');
        $this->primaryKey(['reviewcategory_id', 'reviewer_id']);

        $this->belongsTo('Reviewcategory', [
            'foreignKey' => 'reviewcategory_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Employee', [
            'foreignKey' => 'reviewer_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['reviewcategory_id'], 'Reviewcategory'));
        $rules->add($rules->existsIn(['reviewer_id'], 'Employee'));

        return $rules;
    }
}
