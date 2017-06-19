<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organizationreviewsresult Entity
 *
 * @property int $id
 * @property int $organizationreviews_id
 * @property int $reviewerid
 * @property int $revieweeid
 * @property bool $finish
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $isdeleted
 *
 * @property \App\Model\Entity\Organizationreview $organizationreview
 * @property \App\Model\Entity\Organizationreviewsresultdetail[] $organizationreviewsresultdetail
 */
class Organizationreviewsresult extends Entity
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
