<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviewquestion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Review
 * @property \Cake\ORM\Association\BelongsTo $Question
 *
 * @method \App\Model\Entity\Reviewquestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reviewquestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reviewquestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reviewquestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reviewquestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewquestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewquestion findOrCreate($search, callable $callback = null, $options = [])
 */
class ReviewQuestionTable extends Table
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

        $this->table('review_question');
        $this->displayField('reviewid');
        $this->primaryKey(['reviewid', 'questionid']);

        $this->belongsTo('Review', [
            'foreignKey' => 'reviewid',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Question', [
            'foreignKey' => 'questionid',
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
        $rules->add($rules->existsIn(['reviewid'], 'Review'));
        $rules->add($rules->existsIn(['questionid'], 'Question'));

        return $rules;
    }
}
