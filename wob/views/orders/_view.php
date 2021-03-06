<?php
/* @var $this OrdersController */
/* @var $data WobOrders */
?>

<div class="view">

	<?php echo CHtml::link(WobModule::t('main', 'pay'), array('/wob/pay/index', 'hash'=>$data->hash), array('class'=>'btn btn-primary')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_status')); ?>:</b>
	<?php echo CHtml::encode($data->status->name); ?>
	<br />

	<?php if (!empty($data->id_currency_1)) { ?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('adress')); ?>:</b>
		<?php echo CHtml::encode($data->adress); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('amount_1')); ?>:</b>
		<?php echo ViewPrice::format($data->amount_1, $data->currency_1->code, $data->currency_1->round); ?>
		<br />
	<?php } else { ?>
		<b><?php echo WobModule::t('main', 'Not selected payment method'); ?></b>
	<?php } ?>

	<fieldset style="border: 1px solid #C9E0ED;padding: 10px">
		<legend><?php echo WobModule::t('main', 'Information from the store'); ?></legend>

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_order_shop')); ?>:</b>
		<?php echo CHtml::encode($data->id_order_shop); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('amount_2')); ?>:</b>
		<?php echo ViewPrice::format($data->amount_2, $data->currency_2->code, $data->currency_2->round); ?>
		
		<br />
		<?php echo CHtml::encode($data->note); ?>
	</fieldset>

</div>