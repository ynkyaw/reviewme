<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher; //Default Password Hasher
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\Time $registered
 * @property bool $isactive
 * @property \Cake\I18n\Time $activated
 * @property bool $islock
 * @property \Cake\I18n\Time $locked
 * @property \Cake\I18n\Time $lastlogined
 * @property bool $isdeleted
 */
class User extends Entity
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
        'id' => false,
        'isdeleted' => false

    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
    $hasher = new DefaultPasswordHasher();
    return $hasher->hash($value);
    }
}
