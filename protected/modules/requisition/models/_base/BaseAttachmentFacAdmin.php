<?php

/**
 * This is the model base class for the table "attachment_fac_admin".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AttachmentFacAdmin".
 *
 * Columns in table "attachment_fac_admin" available as properties of the model,
 * followed by relations of table "attachment_fac_admin" available as properties of the model.
 *
 * @property integer $id
 * @property integer $REQ_idREQ
 * @property string $filename
 *
 * @property Requisition $rEQIdREQ
 */
abstract class BaseAttachmentFacAdmin extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'attachment_fac_admin';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'AttachmentFacAdmin|AttachmentFacAdmins', $n);
	}

	public static function representingColumn() {
		return 'filename';
	}

	public function rules() {
		return array(
			array('REQ_idREQ, filename', 'required'),
			array('REQ_idREQ', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>500),
			array('id, REQ_idREQ, filename', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'rEQIdREQ' => array(self::BELONGS_TO, 'Requisition', 'REQ_idREQ'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'REQ_idREQ' => null,
			'filename' => Yii::t('app', 'Filename'),
			'rEQIdREQ' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('REQ_idREQ', $this->REQ_idREQ);
		$criteria->compare('filename', $this->filename, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}