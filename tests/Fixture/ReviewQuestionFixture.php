<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReviewquestionFixture
 *
 */
class ReviewquestionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'review_question';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'review_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'rq_question' => ['type' => 'index', 'columns' => ['question_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['review_id', 'question_id'], 'length' => []],
            'rq_question' => ['type' => 'foreign', 'columns' => ['question_id'], 'references' => ['question', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'rq_review' => ['type' => 'foreign', 'columns' => ['review_id'], 'references' => ['review', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'review_id' => 1,
            'question_id' => 1
        ],
    ];
}
