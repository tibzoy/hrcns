<?php

/**
 * This is the model base class for the table "facility".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Facility".
 *
 * Columns in table "facility" available as properties of the model,
 * followed by relations of table "facility" available as properties of the model.
 *
 * @property integer $idFACILITY
 * @property string $acronym
 * @property string $title
 * @property string $description
 *
 * @property Requisition[] $requisitions
 * @property UserFacility[] $userFacilities
 */
class Facility extends GxActiveRecord {

	
 
  public static function getList(){
    return CHtml::listdata(self::model()->findAll(array(
      'order'=>'title asc',
      'condition'=>'idFACILITY in ('.implode(',',Yii::app()->user->getState('hr_facility_handled_ids')).')'
    )),'idFACILITY','title');
  }
  
  public static function getFullList(){
    return CHtml::listdata(self::model()->findAll(array(
      'order'=>'title asc',
    )),'idFACILITY','title');  
  }
  
 
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'facility';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Facility|Facilities', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('acronym, title', 'required'),
			array('acronym', 'length', 'max'=>2),
			array('title, description', 'length', 'max'=>45),
			array('description', 'default', 'setOnEmpty' => true, 'value' => null),
			array('idFACILITY, acronym, title, description', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'requisitions' => array(self::HAS_MANY, 'Requisition', 'FACILITY_idFACILITY'),
			'userFacilities' => array(self::HAS_MANY, 'UserFacility', 'FACILITY_idFACILITY'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'idFACILITY' => Yii::t('app', 'Id Facility'),
			'acronym' => Yii::t('app', 'Acronym'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'requisitions' => null,
			'userFacilities' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('idFACILITY', $this->idFACILITY);
		$criteria->compare('acronym', $this->acronym, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}