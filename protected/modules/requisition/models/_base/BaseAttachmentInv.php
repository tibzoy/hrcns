<?php

/**
 * This is the model base class for the table "attachment_inv".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AttachmentInv".
 *
 * Columns in table "attachment_inv" available as properties of the model,
 * followed by relations of table "attachment_inv" available as properties of the model.
 *
 * @property integer $idATTACH_INV
 * @property integer $REQUISITION_idREQUISITION
 * @property string $filename
 *
 * @property Requisition $rEQUISITIONIdREQUISITION
 */
abstract class BaseAttachmentInv extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'attachment_inv';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'AttachmentInv|AttachmentInvs', $n);
	}

	public static function representingColumn() {
		return 'filename';
	}

	public function rules() {
		return array(
			array('REQUISITION_idREQUISITION, filename', 'required'),
			array('REQUISITION_idREQUISITION', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>500),
			array('idATTACH_INV, REQUISITION_idREQUISITION, filename', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'rEQUISITIONIdREQUISITION' => array(self::BELONGS_TO, 'Requisition', 'REQUISITION_idREQUISITION'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'idATTACH_INV' => Yii::t('app', 'Id Attach Inv'),
			'REQUISITION_idREQUISITION' => null,
			'filename' => Yii::t('app', 'Filename'),
			'rEQUISITIONIdREQUISITION' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('idATTACH_INV', $this->idATTACH_INV);
		$criteria->compare('REQUISITION_idREQUISITION', $this->REQUISITION_idREQUISITION);
		$criteria->compare('filename', $this->filename, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}