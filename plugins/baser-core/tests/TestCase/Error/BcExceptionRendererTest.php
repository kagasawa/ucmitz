<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS User Community <https://basercms.net/community/>
 *
 * @copyright     Copyright (c) baserCMS User Community
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       http://basercms.net/license/index.html MIT License
 */

namespace BaserCore\Test\TestCase\Error;

use Cake\Core\Configure;
use BaserCore\TestSuite\BcTestCase;

/**
 * Class BcExceptionRendererTest
 * @package BaserCore\Test\TestCase\Error
 */
class BcExceptionRendererTest extends BcTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.BaserCore.Sites',
    ];

    /**
     * set up
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * tearDown
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * test _getController
     */
    public function test_getController()
    {
        // デバッグモードが有効だとcakeのエラー画面が表示されるため一時的に無効にする
        $debug = Configure::read('debug');
        Configure::write('debug', false);

        $this->get('/baser/admin/baser-core/users_test/');
        $this->assertResponseError();
        $this->assertResponseContains('bca-app');
        $this->assertResponseContains('Not Found');

        $this->post('/baser/admin/baser-core/users_test/');
        $this->assertResponseError();
        $this->assertResponseContains('bca-app');
        $this->assertResponseContains('Missing or incorrect CSRF cookie type.');

        Configure::write('debug', $debug);
    }
}