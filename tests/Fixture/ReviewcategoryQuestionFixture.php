<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewcategoryQuestionFixture
 *
 */
class ReviewcategoryQuestionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'reviewcategory_question';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'reviewcategory_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'question_questionreviewcategory' => ['type' => 'index', 'columns' => ['question_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['reviewcategory_id', 'question_id'], 'length' => []],
            'question_questionreviewcategory' => ['type' => 'foreign', 'columns' => ['question_id'], 'references' => ['question', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'reviewcategory_reviewcategoryquestion' => ['type' => 'foreign', 'columns' => ['reviewcategory_id'], 'references' => ['reviewcategory', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'question_id' => 1
        ],
    ];
}
