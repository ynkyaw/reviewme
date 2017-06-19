<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeeFixture
 *
 */
class EmployeeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'employee';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fimalyname' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'empoyeenumber' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'socialsecuritynumber' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'dateofemployment' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'departmentid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'jobpostionid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rankid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'userid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dateofbirth' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'registered' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'isdeleted' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'employee_department' => ['type' => 'index', 'columns' => ['departmentid'], 'length' => []],
            'employee_rank' => ['type' => 'index', 'columns' => ['rankid'], 'length' => []],
            'employee_jobposition' => ['type' => 'index', 'columns' => ['jobpostionid'], 'length' => []],
            'employee_user' => ['type' => 'index', 'columns' => ['userid'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'employee_department' => ['type' => 'foreign', 'columns' => ['departmentid'], 'references' => ['department', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'employee_jobposition' => ['type' => 'foreign', 'columns' => ['jobpostionid'], 'references' => ['jobposition', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'employee_rank' => ['type' => 'foreign', 'columns' => ['rankid'], 'references' => ['rank', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'employee_user' => ['type' => 'foreign', 'columns' => ['userid'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'fimalyname' => 'Lorem ipsum dolor ',
            'empoyeenumber' => 'Lorem ipsum dolor sit amet',
            'socialsecuritynumber' => 'Lorem ipsum dolor sit amet',
            'dateofemployment' => '2017-02-28',
            'departmentid' => 1,
            'jobpostionid' => 1,
            'rankid' => 1,
            'userid' => 1,
            'dateofbirth' => '2017-02-28',
            'registered' => '2017-02-28 06:18:14',
            'modified' => '2017-02-28 06:18:14',
            'isdeleted' => 1
        ],
    ];
}
