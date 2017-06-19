<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewRevieweeFixture
 *
 */
class ReviewRevieweeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'review_reviewee';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'reviewid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'revieweeid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'rreviewee_employee' => ['type' => 'index', 'columns' => ['revieweeid'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['reviewid', 'revieweeid'], 'length' => []],
            'rreviewee_employee' => ['type' => 'foreign', 'columns' => ['revieweeid'], 'references' => ['employee', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'rreviewee_review' => ['type' => 'foreign', 'columns' => ['reviewid'], 'references' => ['review', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'reviewid' => 1,
            'revieweeid' => 1
        ],
    ];
}
