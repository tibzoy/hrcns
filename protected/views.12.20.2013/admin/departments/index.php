<?php
$this->breadcrumbs=array(
	'Departments',
);

$this->menu=array(
	array('label'=>'Create Department','url'=>array('create')),
	array('label'=>'Manage Department','url'=>array('admin')),
);
?>

<h1 class="page-header">Departments</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
