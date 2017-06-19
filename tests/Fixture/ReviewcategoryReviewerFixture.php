<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewcategoryReviewerFixture
 *
 */
class ReviewcategoryReviewerFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'reviewcategory_reviewer';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'reviewcategory_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'reviewer_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'reviewcategoryreviewer_reviewer' => ['type' => 'index', 'columns' => ['reviewer_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['reviewcategory_id', 'reviewer_id'], 'length' => []],
            'reviewcategoryreviewer_reviewcategory' => ['type' => 'foreign', 'columns' => ['reviewcategory_id'], 'references' => ['reviewcategory', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'reviewcategoryreviewer_reviewer' => ['type' => 'foreign', 'columns' => ['reviewer_id'], 'references' => ['employee', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'reviewcategory_id' => 1,
            'reviewer_id' => 1
        ],
    ];
}
