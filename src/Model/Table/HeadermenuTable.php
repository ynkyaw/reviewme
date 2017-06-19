<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Headermenu Model
 *
 * @method \App\Model\Entity\Headermenu get($primaryKey, $options = [])
 * @method \App\Model\Entity\Headermenu newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Headermenu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Headermenu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Headermenu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Headermenu[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Headermenu findOrCreate($search, callable $callback = null, $options = [])
 */
class HeadermenuTable extends Table
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

        $this->table('headermenu');
        $this->displayField('name');
        $this->primaryKey('id');
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        /*$validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');
*/
        return $validator;
    }
}
