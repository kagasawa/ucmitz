<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Permissions seed.
 */
class PermissionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'no' => 1,
                'sort' => 1,
                'name' => 'システム管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/*',
                'auth' => 0,
                'status' => 1,
                'created' => '2015-09-30 01:21:40',
                'method' => 'ALL',
                'modified' => null,
            ],
            [
                'id' => 2,
                'no' => 2,
                'sort' => 2,
                'name' => 'ページ管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/pages/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => null,
            ],
            [
                'id' => 3,
                'no' => 3,
                'sort' => 3,
                'name' => 'ページテンプレート読込・書出',
                'user_group_id' => 2,
                'url' => '/baser/admin/pages/*_page_files',
                'auth' => 0,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => null,
            ],
            [
                'id' => 4,
                'no' => 4,
                'sort' => 4,
                'name' => '新着情報記事管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/blog/blog_posts/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => '2016-08-16 19:29:56',
            ],
            [
                'id' => 5,
                'no' => 5,
                'sort' => 5,
                'name' => '新着情報カテゴリ管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/blog/blog_categories/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => '2016-08-16 19:30:12',
            ],
            [
                'id' => 6,
                'no' => 6,
                'sort' => 6,
                'name' => '新着情報コメント一覧',
                'user_group_id' => 2,
                'url' => '/baser/admin/blog/blog_comments/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => '2016-08-16 19:30:19',
            ],
            [
                'id' => 7,
                'no' => 7,
                'sort' => 7,
                'name' => 'ブログタグ管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/blog/blog_tags/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => null,
            ],
            [
                'id' => 8,
                'no' => 8,
                'sort' => 8,
                'name' => 'お問い合わせ管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/mail/mail_fields/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => '2016-08-16 19:30:34',
            ],
            [
                'id' => 9,
                'no' => 9,
                'sort' => 9,
                'name' => 'お問い合わせ受信メール一覧',
                'user_group_id' => 2,
                'url' => '/baser/admin/mail/mail_messages/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => '2016-08-16 19:29:11',
            ],
            [
                'id' => 10,
                'no' => 10,
                'sort' => 15,
                'name' => 'エディタテンプレート呼出',
                'user_group_id' => 2,
                'url' => '/baser/admin/editor_templates/js',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => null,
            ],
            [
                'id' => 11,
                'no' => 11,
                'sort' => 11,
                'name' => 'アップローダー',
                'user_group_id' => 2,
                'url' => '/baser/admin/uploader/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2015-09-30 01:21:40',
                'modified' => null,
            ],
            [
                'id' => 12,
                'no' => 12,
                'sort' => 12,
                'name' => 'コンテンツ管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/contents/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2016-08-16 19:28:39',
                'modified' => '2016-08-16 19:28:39',
            ],
            [
                'id' => 13,
                'no' => 13,
                'sort' => 13,
                'name' => 'リンク管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/content_links/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2016-08-16 19:28:56',
                'modified' => '2016-08-16 19:28:56',
            ],
            [
                'id' => 14,
                'no' => 14,
                'sort' => 14,
                'name' => 'DebugKit 管理',
                'user_group_id' => 2,
                'url' => '/baser/admin/debug_kit/*',
                'auth' => 1,
                'status' => 1,
                'method' => 'ALL',
                'created' => '2021-05-06 15:25:59',
                'modified' => '2021-05-06 15:25:59',
            ],
        ];

        $table = $this->table('permissions');
        $table->insert($data)->save();
    }
}
