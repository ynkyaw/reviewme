<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Itemreviewsresult Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Itemreviews
 * @property \Cake\ORM\Association\BelongsTo $Products
 * @property \Cake\ORM\Association\HasMany $ItemreviewsresultDetail
 *
 * @method \App\Model\Entity\Itemreviewsresult get($primaryKey, $options = [])
 * @method \App\Model\Entity\Itemreviewsresult newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Itemreviewsresult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresult[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Itemreviewsresult findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemreviewsresultTable extends Table
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

        $this->table('itemreviewsresults');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Itemreviews', [
            'foreignKey' => 'itemreviews_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'products_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Employee', [
            'foreignKey' => 'reviewerid',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('itemreviewsresultdetail', [
            'foreignKey' => 'itemreviewsresult_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('reviewerid')
            ->requirePresence('reviewerid', 'create')
            ->notEmpty('reviewerid');

        $validator
            ->boolean('finish')
            ->requirePresence('finish', 'create')
            ->notEmpty('finish');

        $validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');

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
        $rules->add($rules->existsIn(['products_id'], 'Products'));

        return $rules;
    }
}
