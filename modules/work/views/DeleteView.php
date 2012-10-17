  <?php echo Html::beginForm(); ?>

  <?php echo "Do you want delete record #".Html::getOption2()." ? "  ?>
<?php echo Html::hiddenField('id',Html::getOption2()); ?>
<?php echo Html::submitButton('Del','Yes'); ?>
<?php echo Html::submitButton('Del','No'); ?>

<?php echo Html::endForm();?>	  