<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $id
 * @property string $title
 * @property int $reviewtype_id
 * @property string $goal
 * @property int $owner_id
 * @property string $description
 * @property \Cake\I18n\Time $startdate
 * @property \Cake\I18n\Time $enddate
 * @property int $maxreview
 * @property int $maxreviewed
 * @property int $minreview
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $isdeleted
 *
 * @property \App\Model\Entity\Reviewtype $reviewtype
 * @property \App\Model\Entity\Owner $owner
 * @property \App\Model\Entity\Question[] $question
 */
class Review extends Entity
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
