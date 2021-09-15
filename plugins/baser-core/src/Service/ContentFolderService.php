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


namespace BaserCore\Service;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;
use BaserCore\Annotation\UnitTest;
use Cake\Datasource\EntityInterface;
use BaserCore\Model\Table\ContentFoldersTable;
use BaserCore\Service\ContentFolderServiceInterface;
/**
 * Class ContentFolderService
 * @package BaserCore\Service
 * @property ContentFoldersTable $ContentFolders
 * @property ContentsTable $Contents
 */
class ContentFolderService implements ContentFolderServiceInterface
{

    /**
     * ContentFolders Table
     * @var ContentFoldersTable
     */
    public $ContentFolders;

    /**
     * ContentFolderService constructor.
     */
    public function __construct()
    {
        $this->ContentFolders = TableRegistry::getTableLocator()->get('BaserCore.ContentFolders');
        $this->Contents = TableRegistry::getTableLocator()->get('BaserCore.Contents');
    }

    /**
     * コンテンツフォルダーを取得する
     * @param int $id
     * @return EntityInterface
     * @checked
     * @noTodo
     * @unitTest
     */
    public function get($id): EntityInterface
    {
        $contentFolder = $this->ContentFolders->get($id, ['contain' => ['Contents']]);
        $contentFolder->content = $contentFolder->content ?? $this->Contents->find('all', ['withDeleted'])->where(['entity_id' => $id])->first();
        return $contentFolder;
    }

    /**
     * コンテンツフォルダー一覧用のデータを取得
     * @param array $queryParams
     * @return Query
     * @checked
     * @noTodo
     * @unitTest
     */
    public function getIndex(array $queryParams=[]): Query
    {
        $options = [];
        if (!empty($queryParams['num'])) {
            $options = ['limit' => $queryParams['num']];
        }
        $query = $this->ContentFolders->find('all', $options)->contain('Contents');
        if (!empty($queryParams['folder_template'])) {
            $query->where(['folder_template LIKE' => '%' . $queryParams['folder_template'] . '%']);
        }
        if (!empty($queryParams['page_template'])) {
            $query->where(['page_template LIKE' => '%' . $queryParams['page_template'] . '%']);
        }
        return $query;
    }

    /**
     * コンテンツフォルダー登録
     * @param array $data
     * @return \Cake\Datasource\EntityInterface
     * @checked
     * @noTodo
     * @unitTest
     */
    public function create(array $postData)
    {
        $contentFolder = $this->ContentFolders->newEmptyEntity();
        $contentFolder = $this->ContentFolders->patchEntity($contentFolder, $postData);
        return ($result = $this->ContentFolders->save($contentFolder)) ? $result : $contentFolder;
    }

    /**
     * コンテンツフォルダーを削除する
     * @param int $id
     * @return bool
     * @checked
     * @noTodo
     * @unitTest
     */
    public function delete($id)
    {
        $ContentFolder = $this->get($id);
        return $this->ContentFolders->delete($ContentFolder);
    }
}