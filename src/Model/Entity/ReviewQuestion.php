<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reviewquestion Entity
 *
 * @property int $review_id
 * @property int $question_id
 *
 * @property \App\Model\Entity\Review[] $review
 * @property \App\Model\Entity\Question[] $question
 */
class ReviewQuestion extends Entity
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
        'reviewid' => false,
        'questionid' => false
    ];
}
