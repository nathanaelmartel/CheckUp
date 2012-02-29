<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('test/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('test/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'test/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['url']->renderLabel() ?></th>
        <td>
          <?php echo $form['url']->renderError() ?>
          <?php echo $form['url'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ip']->renderLabel() ?></th>
        <td>
          <?php echo $form['ip']->renderError() ?>
          <?php echo $form['ip'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['host']->renderLabel() ?></th>
        <td>
          <?php echo $form['host']->renderError() ?>
          <?php echo $form['host'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['http_code']->renderLabel() ?></th>
        <td>
          <?php echo $form['http_code']->renderError() ?>
          <?php echo $form['http_code'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['effective_url']->renderLabel() ?></th>
        <td>
          <?php echo $form['effective_url']->renderError() ?>
          <?php echo $form['effective_url'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['last_check']->renderLabel() ?></th>
        <td>
          <?php echo $form['last_check']->renderError() ?>
          <?php echo $form['last_check'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['slug']->renderLabel() ?></th>
        <td>
          <?php echo $form['slug']->renderError() ?>
          <?php echo $form['slug'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
