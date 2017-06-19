<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeEmployeegroup Entity
 *
 * @property int $employee_id
 * @property int $employeegroup_id
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Employeegroup $employeegroup
 */
class EmployeeEmployeegroup extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'employee_id' => false,
        'employeegroup_id' => false
    ];
}
