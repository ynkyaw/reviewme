<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemreviewsQuestion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Itemreviews
 * @property \Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\ItemreviewsQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemreviewsQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemreviewsQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemreviewsQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemreviewsQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemreviewsQuestionTable extends Table
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

        $this->table('itemreviews_question');
        $this->displayField('itemreviews_id');
        $this->primaryKey(['itemreviews_id', 'question_id']);

        $this->belongsTo('Itemreviews', [
            'foreignKey' => 'itemreviews_id',
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
        $rules->add($rules->existsIn(['itemreviews_id'], 'Itemreviews'));
        $rules->add($rules->existsIn(['question_id'], 'Question'));

        return $rules;
    }
}
