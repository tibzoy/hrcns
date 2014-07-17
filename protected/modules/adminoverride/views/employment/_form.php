<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'employment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'emp_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'facility_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>29)); ?>

	<?php echo $form->textFieldRow($model,'date_of_hire',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_of_termination',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'department_code',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'position_code',Position::getList(),array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'start_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'end_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'contract_file',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'has_union',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'reports_to',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'is_approved',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'timestamp',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
