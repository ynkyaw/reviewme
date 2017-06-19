<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
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
        
        $this->table('products');
        $this->displayField('productname');
        $this->primaryKey('id');

        $this->belongsToMany('ItemreviewsReviewees', [
            'foreignKey' => 'revieweeid',
            'targetForeignKey' => 'itemreviews_id',
            'joinTable' => 'itemreviews_reviewees'
        ]);

        $this->belongsTo('itemreviewsresults', [
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('productname', 'create')
            ->notEmpty('productname');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->allowEmpty('color');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('made_in');

        $validator
            ->allowEmpty('size');

        $validator
            ->allowEmpty('weight');

        $validator
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        /*$validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');
*/
        return $validator;
    }
}
