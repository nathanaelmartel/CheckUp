<h1>Sites List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Url</th>
      <th>Title</th>
      <th>Ip</th>
      <th>Host</th>
      <th>Http code</th>
      <th>Effective url</th>
      <th>Last check</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sites as $site): ?>
    <tr>
      <td><a href="<?php echo url_for('test/edit?id='.$site->getId()) ?>"><?php echo $site->getId() ?></a></td>
      <td><?php echo $site->getUrl() ?></td>
      <td><?php echo $site->getTitle() ?></td>
      <td><?php echo $site->getIp() ?></td>
      <td><?php echo $site->getHost() ?></td>
      <td><?php echo $site->getHttpCode() ?></td>
      <td><?php echo $site->getEffectiveUrl() ?></td>
      <td><?php echo $site->getLastCheck() ?></td>
      <td><?php echo $site->getCreatedAt() ?></td>
      <td><?php echo $site->getUpdatedAt() ?></td>
      <td><?php echo $site->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('test/new') ?>">New</a>
