<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $name
 * @property string $fimalyname
 * @property string $empoyeenumber
 * @property string $socialsecuritynumber
 * @property \Cake\I18n\Time $dateofemployment
 * @property int $departmentid
 * @property int $jobpostionid
 * @property int $rankid
 * @property int $userid
 * @property \Cake\I18n\Time $dateofbirth
 * @property \Cake\I18n\Time $registered
 * @property \Cake\I18n\Time $modified
 * @property bool $isdeleted
 */
class Employee extends Entity
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
        'id' => false
    ];
}
