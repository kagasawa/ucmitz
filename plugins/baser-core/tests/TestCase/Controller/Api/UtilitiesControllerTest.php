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

namespace BaserCore\Test\TestCase\Controller\Api;

use BaserCore\Test\Factory\ContentFactory;
use BaserCore\Service\UtilitiesService;
use BaserCore\Test\Scenario\InitAppScenario;
use BaserCore\TestSuite\BcTestCase;
use Cake\Core\Configure;
use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;
use Cake\TestSuite\IntegrationTestTrait;

class UtilitiesControllerTest extends BcTestCase
{

    /**
     * ScenarioAwareTrait
     */
    use ScenarioAwareTrait;
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.BaserCore.Factory/Sites',
        'plugin.BaserCore.Factory/SiteConfigs',
        'plugin.BaserCore.Factory/Users',
        'plugin.BaserCore.Factory/UsersUserGroups',
        'plugin.BaserCore.Factory/UserGroups',
        'plugin.BaserCore.Factory/Contents',
    ];

    /**
     * Access Token
     * @var string
     */
    public $accessToken = null;

    /**
     * Refresh Token
     * @var null
     */
    public $refreshToken = null;

    /**
     * set up
     */
    public function setUp(): void
    {
        $this->setFixtureTruncate();
        parent::setUp();
        $this->loadFixtureScenario(InitAppScenario::class);
        $token = $this->apiLoginAdmin(1);
        $this->accessToken = $token['access_token'];
        $this->refreshToken = $token['refresh_token'];
    }

    /**
     * Tear Down
     *
     * @return void
     */
    public function tearDown(): void
    {
        Configure::clear();
        parent::tearDown();
    }

    /**
     * test verity_contents_tree
     * @return void
     */
    public function test_verity_contents_tree()
    {
        //ツリー構造チェックが成功
        ContentFactory::make(['id' => 101, 'name' => 'BaserCore 1', 'type' => 'ContentFolder', 'lft' => 1, 'rght' => 2])->persist();
        ContentFactory::make(['id' => 102, 'name' => 'BaserCore 2', 'type' => 'ContentFolder', 'lft' => 3, 'rght' => 4])->persist();

        $this->post('/baser/api/baser-core/utilities/verity_contents_tree.json?token=' . $this->accessToken);
        $this->assertResponseOk();
        $result = json_decode((string)$this->_response->getBody());
        $this->assertEquals('コンテンツのツリー構造に問題はありません。', $result->message);

        //ツリー構造チェックが失敗
        ContentFactory::make(['id' => 103, 'name' => 'BaserCore 3', 'type' => 'ContentFolder', 'lft' => 5, 'rght' => 6])->persist();
        ContentFactory::make(['id' => 104, 'name' => 'BaserCore 4', 'type' => 'ContentFolder', 'lft' => 7, 'rght' => 8, 'parent_id' => 103])->persist();

        $this->post('/baser/api/baser-core/utilities/verity_contents_tree.json?token=' . $this->accessToken);
        $this->assertResponseCode(400);
        $result = json_decode((string)$this->_response->getBody());
        $this->assertEquals('コンテンツのツリー構造に問題があります。ログを確認してください。', $result->message);
    }

    /**
     * test clear_cache
     * @return void
     */
    public function test_clear_cache()
    {
        $this->post('/baser/api/baser-core/utilities/clear_cache.json?token=' . $this->accessToken);
        $this->assertResponseOk();
        $result = json_decode((string)$this->_response->getBody());
        $this->assertEquals('サーバーキャッシュを削除しました。', $result->message);
    }

    /**
     * test reset_contents_tree
     * @return void
     */
    public function test_reset_contents_tree()
    {
        ContentFactory::make(['id' => 1, 'name' => 'BaserCore root', 'type' => 'ContentFolder', 'site_root' => 1, 'lft' => 1, 'rght' => 2])->persist();
        ContentFactory::make(['name' => 'BaserCore 1', 'type' => 'ContentFolder', 'site_root' => 1, 'lft' => 11, 'rght' => 12])->persist();
        ContentFactory::make(['name' => 'BaserCore 2', 'type' => 'ContentFolder', 'site_root' => 1, 'lft' => 13, 'rght' => 14])->persist();

        $this->post('/baser/api/baser-core/utilities/reset_contents_tree.json?token=' . $this->accessToken);
        $this->assertResponseOk();
        $result = json_decode((string)$this->_response->getBody());
        $this->assertEquals('コンテンツのツリー構造をリセットしました。', $result->message);
    }
}
