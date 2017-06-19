<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviewresult Model
 *
 * @property \Cake\ORM\Association\HasMany $Reviewresultdetail
 *
 * @method \App\Model\Entity\Reviewresult get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reviewresult newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reviewresult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reviewresult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reviewresult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewresult[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewresult findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewresultTable extends Table
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

        $this->table('reviewresult');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Reviewresultdetail', [
            'foreignKey' => 'reviewresult_id'
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
            ->integer('reviewid')
            ->requirePresence('reviewid', 'create')
            ->notEmpty('reviewid');

        $validator
            ->integer('reviewerid')
            ->requirePresence('reviewerid', 'create')
            ->notEmpty('reviewerid');

        $validator
            ->integer('revieweeid')
            ->requirePresence('revieweeid', 'create')
            ->notEmpty('revieweeid');

        /*$validator
            ->boolean('IsDeleted')
            ->requirePresence('IsDeleted', 'create')
            ->notEmpty('IsDeleted');
*/
        return $validator;
    }
}
