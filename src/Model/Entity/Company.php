<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property string $industry
 * @property string $adderssline1
 * @property string $addressline2
 * @property int $township_id
 * @property string $website
 * @property string $fax
 * @property string $phone
 * @property string $email
 * @property bool $isdeleted
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Department[] $department
 */
class Company extends Entity
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