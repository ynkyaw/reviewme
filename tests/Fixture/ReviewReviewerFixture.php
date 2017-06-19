<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewReviewerFixture
 *
 */
class ReviewReviewerFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'review_reviewer';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'reviewid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'reviewerid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'rreviewer_employee' => ['type' => 'index', 'columns' => ['reviewerid'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['reviewid', 'reviewerid'], 'length' => []],
            'rreviewer_employee' => ['type' => 'foreign', 'columns' => ['reviewerid'], 'references' => ['employee', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'rreviewer_review' => ['type' => 'foreign', 'columns' => ['reviewid'], 'references' => ['review', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'reviewerid' => 1
        ],
    ];
}
