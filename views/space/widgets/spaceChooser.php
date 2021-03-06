<?php
/* @var $this \humhub\components\WebView */
/* @var $currentSpace \humhub\modules\space\models\Space */
use yii\helpers\Url;
use yii\helpers\Html;
use humhub\libs\Helpers;
$this->registerJsFile("@web/resources/space/spacechooser.js");
$this->registerJsVar('scSpaceListUrl', Url::to(['/space/list', 'ajax' => 1]));
?>
<li>
	<a class="waves dropdown-toggle" data-toggle="modal" data-target="#space-menu-dropdown">
		<!-- start: Show space image and name if chosen -->
		<?php if ($currentSpace) { ?>
			<?php echo \humhub\modules\space\widgets\Image::widget([
                'space' => $currentSpace,
                'width' => 24,
                'htmlOptions' => [
                    'class' => 'current-space-image',
                ]
            ]); ?>
		<?php } ?>

		<?php
        if (!$currentSpace) {
            echo '<i class="material-icons">assignment_turned_in</i>';
        }
        ?>
		<!-- end: Show space image and name if chosen -->
	</a>
	<ul class="dropdown-menu" id="space-menu-dropdownXXX">
		<li>
			<form action="" class="dropdown-controls">
				<input type="text" id="space-menu-search" class="form-control"
					autocomplete="off" placeholder="<?php echo Yii::t('SpaceModule.widgets_views_spaceChooser', 'Search'); ?>">
				<div class="search-reset" id="space-search-reset"><i class="fa fa-times-circle"></i></div>
			</form>
		</li>

	</ul>
</li>


	<!-- modal-space -->
	<div class="modal fade" id="space-menu-dropdown" data-backdrop="false"><div class="right w264 bg-white md-whiteframe-z2"><div class="box">
		<div class="p p-h-md b-b"><a data-dismiss="modal" class="pull-right text-muted-lt text-2x m-t-n inline p-sm">&times;</a><strong><?php echo Yii::t('SpaceModule.widgets_views_spaceChooser', 'My spaces'); ?></strong></div>

		<div class="box-row"><div class="box-cell"><div class="box-inner"><div class="list-group no-radius no-borders">
				<?php foreach ($memberships as $membership): ?>
					<?php $newItems = $membership->countNewItems(); ?>
					<li>
						<a href="<?php echo $membership->space->getUrl(); ?>">
							<div class="media">
								<!-- Show space image -->
								<?php echo \humhub\modules\space\widgets\Image::widget([
                                    'space' => $membership->space,
                                    'width' => 24,
                                    'htmlOptions' => [
                                        'class' => 'pull-left',
                                    ]
                                ]); ?>
								<div class="media-body">
									<strong><?php echo Html::encode($membership->space->name); ?></strong>
									<?php if ($newItems != 0): ?>
										<div class="badge badge-space pull-right"
											 style="display:none"><?php echo $newItems; ?></div>
									<?php endif; ?>
									<br>

									<p><?php echo Html::encode(Helpers::truncateText($membership->space->description, 60)); ?></p>
								</div>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
		</div></div></div></div>

		<div class="p-sm b-t">
			<a href="<?php echo Yii::getAlias("@web"); ?>/directory/spaces" class="md-btn md-flat waves">Show All</a>
			<?php if ($canCreateSpace): ?>
				<a class="md-btn md-flat text-danger waves" style="float: right" href="<?php echo Url::to(['/space/create/create']); ?>" data-target="#globalModal">
				<i class="material-icons md-18">add_box</i> <?php echo Yii::t('SpaceModule.widgets_views_spaceChooser', 'Create new'); ?></a>
			<?php endif; ?>
		</div>
	</div></div></div>

<script type="text/javascript">

	// set niceScroll to SpaceChooser menu
	$("#space-menu-spaces").niceScroll({
		cursorwidth: "7",
		cursorborder: "",
		cursorcolor: "#555",
		cursoropacitymax: "0.2",
		railpadding: {top: 0, right: 3, left: 0, bottom: 0}
	});
	jQuery('.badge-space').fadeIn('slow');
</script>
