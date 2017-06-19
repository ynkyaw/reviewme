<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationreviewsQuestion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizationreviews
 * @property \Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\OrganizationreviewsQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationreviewsQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationreviewsQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationreviewsQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationreviewsQuestionTable extends Table
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

        $this->table('organizationreviews_question');
        $this->displayField('organizationreviews_id');
        $this->primaryKey(['organizationreviews_id', 'question_id']);

        $this->belongsTo('Organizationreviews', [
            'foreignKey' => 'organizationreviews_id',
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
        $rules->add($rules->existsIn(['organizationreviews_id'], 'Organizationreviews'));
        $rules->add($rules->existsIn(['question_id'], 'Question'));

        return $rules;
    }
}
