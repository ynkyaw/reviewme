<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReviewcategoryReviewer Entity
 *
 * @property int $reviewcategory_id
 * @property int $reviewer_id
 *
 * @property \App\Model\Entity\Reviewcategory $reviewcategory
 * @property \App\Model\Entity\Employee $employee
 */
class ReviewcategoryReviewer extends Entity
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
        'reviewcategory_id' => false,
        'reviewer_id' => false
    ];
}
