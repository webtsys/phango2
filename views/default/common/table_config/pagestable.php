<?php

function PagesTableView($pages, $more_data)
{

?>
	<div class="head_list">
		<?php echo i18n_lang('common', 'pages', 'Pages'); ?>: <?php echo $pages; ?>
	</div>

	<div class="head_list_right">
		<?php echo $more_data; ?>
	</div>
<?php

}

?>