<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employee Model
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeeTable extends Table
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

        $this->table('employee');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('rank', [
        'foreignKey' => 'rankid',
        'joinType' => 'INNER'
        ]);

        $this->belongsTo('department', [
        'foreignKey' => 'departmentid',
        'joinType' => 'INNER'
        ]);

        $this->belongsTo('jobposition', [
        'foreignKey' => 'jobpostionid',
        'joinType' => 'INNER'
        ]);

         $this->belongsToMany('EmployeeGroup', [
            'foreignKey' => 'employee_id',
            'targetForeignKey' => 'employeegroup_id',
            'joinTable' => 'employee_employeegroup'
        ]);

         $this->belongsToMany('ReviewerReview', [
            'foreignKey' => 'employee_id',
            'targetForeignKey' => 'review_id',
            'joinTable' => 'review_reviewer'
        ]);

        $this->belongsToMany('RevieweeReview', [
            'foreignKey' => 'employee_id',
            'targetForeignKey' => 'review_id',
            'joinTable' => 'review_reviewee'
        ]);

        $this->belongsToMany('OrganizationreviewsReviewers', [
            'foreignKey' => 'reviewerid',
            'targetForeignKey' => 'organizationreviews_id',
            'joinTable' => 'organizationreviews_reviewers'
        ]);

        $this->belongsTo('ReviewresultReviewer', [
        'foreignKey' => 'reviewerid',
        'joinType' => 'INNER'
        ]);

        $this->belongsTo('ReviewresultReviewee', [
        'foreignKey' => 'revieweeid',
        'joinType' => 'INNER'
        ]);

        $this->belongsTo('Itemreviewsresult', [
        'foreignKey' => 'reviewerid',
        'joinType' => 'INNER'
        ]);

        $this->hasOne('user',[
            'foreignKey' => 'userid',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('fimalyname');

      $validator
            ->notEmpty('empoyeenumber');

          $validator
            ->allowEmpty('socialsecuritynumber');

        $validator
            ->date('dateofemployment')
            ->requirePresence('dateofemployment', 'create')
            ->notEmpty('dateofemployment');

        $validator
            ->integer('departmentid')
            ->requirePresence('departmentid', 'create')
            ->notEmpty('departmentid');

        $validator
            ->integer('jobpostionid')
            ->requirePresence('jobpostionid', 'create')
            ->notEmpty('jobpostionid');

        $validator
            ->integer('rankid')
            ->requirePresence('rankid', 'create')
            ->notEmpty('rankid');

        $validator
            ->integer('userid')
            ->allowEmpty('userid');

        $validator
            ->date('dateofbirth')
            ->requirePresence('dateofbirth', 'create')
            ->notEmpty('dateofbirth');

        $validator
            ->date('registered')
            ->requirePresence('registered', 'create')
            ->notEmpty('registered');

        $validator
            ->requirePresence('nrcnumber', 'create')
            ->notEmpty('nrcnumber');

       /* $validator
            ->boolean('isdeleted')
            ->requirePresence('isdeleted', 'create')
            ->notEmpty('isdeleted');*/

        return $validator;
    }
}
