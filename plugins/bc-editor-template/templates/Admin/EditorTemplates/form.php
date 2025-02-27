<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @package         Baser.View
 * @since           baserCMS v 0.1.0
 * @license         https://basercms.net/license/index.html
 */

/**
 * [ADMIN] エディタテンプレートー登録・編集
 *
 * @var BcAppView $this
 */
$this->BcBaser->js('BcEditorTemplate.admin/editor_templates/form.bundle', false);
?>


<?php $this->BcBaser->css('admin/ckeditor/editor', true); ?>
<?php echo $this->BcAdminForm->create('EditorTemplate', ['type' => 'file']) ?>

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section">
  <table id="FormTable" class="form-table bca-form-table">
    <?php if ($this->action == 'admin_edit'): ?>
      <tr>
        <th class="col-head bca-form-table__label"><?php echo $this->BcForm->label('EditorTemplate.id', 'No') ?></th>
        <td class="col-input bca-form-table__input">
          <?php echo $this->BcForm->getSourceValue('EditorTemplate.id') ?>
          <?php echo $this->BcAdminForm->control('EditorTemplate.id', ['type' => 'hidden']) ?>
        </td>
      </tr>
    <?php endif ?>
    <tr>
      <th
        class="col-head bca-form-table__label"><?php echo $this->BcForm->label('EditorTemplate.name', __d('baser', 'テンプレート名')) ?>
        &nbsp;<span class="required bca-label"
                    data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span></th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('EditorTemplate.name', ['type' => 'text', 'size' => 20, 'maxlength' => 50]) ?>
        <?php echo $this->BcForm->error('EditorTemplate.name') ?>
      </td>
    </tr>
    <tr>
      <th
        class="col-head bca-form-table__label"><?php echo $this->BcForm->label('EditorTemplate.image', __d('baser', 'アイコン画像')) ?></th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('EditorTemplate.image', ['type' => 'file']) ?>
        <?php echo $this->BcForm->error('EditorTemplate.image') ?>
      </td>
    </tr>
    <tr>
      <th
        class="col-head bca-form-table__label"><?php echo $this->BcForm->label('EditorTemplate.description', __d('baser', '説明文')) ?></th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcAdminForm->control('EditorTemplate.description', ['type' => 'textarea', 'cols' => 60, 'rows' => 2]) ?>
        <?php echo $this->BcForm->error('EditorTemplate.description') ?>
      </td>
    </tr>
    <tr>
      <th
        class="col-head bca-form-table__label"><?php echo $this->BcForm->label('EditorTemplate.html', __d('baser', 'コンテンツ')) ?></th>
      <td class="col-input bca-form-table__input">
        <?php echo $this->BcForm->ckeditor('EditorTemplate.html', ['editorWidth' => 'auto', 'editorUseTemplates' => false]) ?>
        <?php echo $this->BcForm->error('EditorTemplate.html') ?>
        <?php echo $this->BcForm->error('EditorTemplate.html') ?>
      </td>
    </tr>
    <?php echo $this->BcForm->dispatchAfterForm() ?>
  </table>
</div>

<?php echo $this->BcFormTable->dispatchAfter() ?>

<!-- button -->
<div class="bca-actions">
  <div class="bca-actions__main">
    <?php echo $this->BcForm->button(__d('baser', '保存'), [
      'type' => 'submit',
      'id' => 'BtnSave',
      'div' => false,
      'class' => 'button bca-btn bca-actions__item',
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
    ]) ?>
  </div>
  <?php if ($this->action == 'admin_edit'): ?>
    <div class="bca-actions__sub">
      <?php $this->BcBaser->link(__d('baser', '削除'),
        ['action' => 'delete', $this->BcForm->getSourceValue('EditorTemplate.id'), $this->BcForm->getSourceValue('FeedDetail.id')],
        ['class' => 'bca-submit-token button bca-btn bca-actions__item', 'data-bca-btn-type' => 'delete', 'data-bca-btn-size' => 'sm', 'data-bca-btn-color' => 'danger'],
        sprintf(__d('baser', '%s を本当に削除してもいいですか？'), $this->BcForm->getSourceValue('EditorTemplate.name'))
      ) ?>
    </div>
  <?php endif ?>
</div>

<?php echo $this->BcAdminForm->end() ?>
