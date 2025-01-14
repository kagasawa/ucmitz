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

namespace BaserCore\Service;

use BaserCore\Model\Entity\Site;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\EntityInterface;

/**
 * Interface ContentFoldersServiceInterface
 */
interface ContentFoldersServiceInterface extends CrudBaseServiceInterface
{

    /**
     * コンテンツフォルダーをゴミ箱から取得する
     * @param int $id
     * @return EntityInterface|array
     */
    public function getTrash($id);

    /**
     * フォルダのテンプレートリストを取得する
     *
     * @param $contentId
     * @param $theme
     * @return array
     */
    public function getFolderTemplateList($contentId, $theme);

    /**
     * 親のテンプレートを取得する
     *
     * @param int $id
     * @param string $type folder|page
     */
    public function getParentTemplate($id, $type);

    /**
     * サイトルートフォルダを保存
     *
     * @param Site $site
     * @param bool $isUpdateChildrenUrl 子のコンテンツのURLを一括更新するかどうか
     * @return false|EntityInterface
     * @throws RecordNotFoundException
     */
    public function saveSiteRoot($site, $isUpdateChildrenUrl = false);

}


