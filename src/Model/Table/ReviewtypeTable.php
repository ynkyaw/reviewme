<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviewtype Model
 *
 * @property \Cake\ORM\Association\HasMany $Review
 *
 * @method \App\Model\Entity\Reviewtype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reviewtype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reviewtype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reviewtype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reviewtype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewtype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewtype findOrCreate($search, callable $callback = null, $options = [])
 */
class ReviewtypeTable extends Table
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

        $this->table('reviewtype');
        $this->displayField('reviewtypename');
        $this->primaryKey('id');

        $this->hasMany('Review', [
            'foreignKey' => 'reviewtype_id'
        ]);

        $this->hasMany('Itemreviews', [
            'foreignKey' => 'reviewtype_id']);

        $this->hasMany('Organizationreviews', [
            'foreignKey' => 'reviewtype_id']);
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
            ->requirePresence('reviewtypename', 'create')
            ->notEmpty('reviewtypename');

        $validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');

        return $validator;
    }
}
