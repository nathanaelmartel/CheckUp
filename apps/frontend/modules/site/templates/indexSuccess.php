
<header class="grid_14 prefix_1">
	<h1>Sites</h1>
</header>

<div class="clear"></div>

<section class="grid_16">
	<ul class="list">
		<?php foreach ($sites as $site): ?>
			<li class="http-code-<?php echo $site->getHttpCodeStyle() ?>">
				<div class="url grid_5 alpha"><?php echo $site->url ?></div>
				<div class="title grid_11 omega"><?php echo $site->title ?></div>
				<div class="clear"></div>
				<div class="icone grid_1 alpha">&nbsp;</div>
				<div class="http-code grid_1"><?php echo $site->http_code ?></div>
				<div class="http-code-description grid_3"><?php echo $site->getHttpCodeName() ?></div>
				<div class="ip grid_2"><?php echo $site->ip ?></div>
				<div class="host grid_4"><?php echo $site->host ?></div>
				<div class="clear"></div>
			</li>
		<?php endforeach?>
	</ul>
</section>

<div class="clear"></div>