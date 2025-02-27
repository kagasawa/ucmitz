<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BaserCore\Test\TestCase\Model\Table;

use BaserCore\Model\Table\UserGroupsTable;
use BaserCore\TestSuite\BcTestCase;
use Cake\Validation\Validator;

/**
 * Class UserGroupsTableTest
 * @package BaserCore\Test\TestCase\Model\Table
 * @property UserGroupsTable $UserGroups
 */
class UserGroupsTableTest extends BcTestCase
{

    /**
     * Test subject
     *
     * @var UserGroupsTable
     */
    public $UserGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.BaserCore.UserGroups',
        'plugin.BaserCore.Permissions',
    ];

    /**
     * Set Up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserGroups')? [] : ['className' => 'BaserCore\Model\Table\UserGroupsTable'];
        $this->UserGroups = $this->getTableLocator()->get('UserGroups', $config);
    }

    /**
     * Tear Down
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserGroups);
        parent::tearDown();
    }

    /**
     * Test initialize
     */
    public function testInitialize()
    {
        $this->assertEquals('user_groups', $this->UserGroups->getTable());
        $this->assertEquals('name', $this->UserGroups->getDisplayField());
        $this->assertEquals('id', $this->UserGroups->getPrimaryKey());
        $this->assertIsBool($this->UserGroups->hasBehavior('Timestamp'));
        $this->assertEquals('Users', $this->UserGroups->getAssociation('Users')->getName());
    }

    /**
     * Test validationDefault
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $validator = $this->UserGroups->validationDefault(new Validator());
        $fields = [];
        foreach($validator->getIterator() as $key => $value) {
            $fields[] = $key;
        }
        $this->assertEquals(['id', 'name', 'title', 'auth_prefix', 'use_move_contents'], $fields);
        $userGroups = $this->UserGroups->get(2);

    }

    /**
     * Test copy
     *
     * @return void
     */
    public function testCopy()
    {
        $copied = $this->UserGroups->copy(3);
        $originalUserGroup = $this->UserGroups->get(3);
        $query = $this->UserGroups->find()->where(['name' => $originalUserGroup->name . '_copy']);
        $this->assertEquals(1, $query->count());
        $this->assertEquals(4, $copied->id);
    }

    /**
     * Test getAuthPrefix
     *
     * @return void
     */
    public function testGetAuthPrefix()
    {
        $result = $this->UserGroups->getAuthPrefix(1);
        $this->assertEquals('admin', $result);

        $result = $this->UserGroups->getAuthPrefix(999);
        $this->assertEquals(null, $result);
    }

}
