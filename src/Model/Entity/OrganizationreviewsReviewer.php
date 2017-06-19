<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationreviewsReviewer Entity
 *
 * @property int $organizationreviews_id
 * @property int $reviewerid
 *
 * @property \App\Model\Entity\Organizationreview $organizationreview
 * @property \App\Model\Entity\Employee[] $employee
 */
class OrganizationreviewsReviewer extends Entity
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
        'organizationreviews_id' => false,
        'reviewerid' => false
    ];
}
