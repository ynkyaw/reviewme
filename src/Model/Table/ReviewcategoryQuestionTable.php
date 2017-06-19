<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewcategoryQuestion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reviewcategory
 * @property \Cake\ORM\Association\BelongsTo $Question
 *
 * @method \App\Model\Entity\ReviewcategoryQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewcategoryQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewcategoryQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewcategoryQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class ReviewcategoryQuestionTable extends Table
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

        $this->table('reviewcategory_question');
        $this->displayField('reviewcategory_id');
        $this->primaryKey(['reviewcategory_id', 'question_id']);

        $this->belongsTo('Reviewcategory', [
            'foreignKey' => 'reviewcategory_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Question', [
            'foreignKey' => 'question_id',
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
        $rules->add($rules->existsIn(['question_id'], 'Question'));

        return $rules;
    }
}
