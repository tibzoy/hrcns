<?php

/**
 * This is the model base class for the table "mail_group".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MailGroup".
 *
 * Columns in table "mail_group" available as properties of the model,
 * followed by relations of table "mail_group" available as properties of the model.
 *
 * @property integer $idMAIL_GROUP
 * @property integer $STATUS_idSTATUS
 * @property string $name
 *
 * @property Status $sTATUSIdSTATUS
 * @property MailgroupUserStatus[] $mailgroupUserStatuses
 */
abstract class BaseMailGroup extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'mail_group';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MailGroup|MailGroups', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('STATUS_idSTATUS, name', 'required'),
			array('STATUS_idSTATUS', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('idMAIL_GROUP, STATUS_idSTATUS, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'sTATUSIdSTATUS' => array(self::BELONGS_TO, 'Status', 'STATUS_idSTATUS'),
			'mailgroupUserStatuses' => array(self::HAS_MANY, 'MailgroupUserStatus', 'MAILGROUP_idMAILGROUP'),
			'myUsers'=>array(self::HAS_MANY, 'User', 'USER_idUSER','through'=>'mailgroupUserStatuses'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'idMAIL_GROUP' => Yii::t('app', 'Id Mail Group'),
			'STATUS_idSTATUS' => null,
			'name' => Yii::t('app', 'Name'),
			'sTATUSIdSTATUS' => null,
			'mailgroupUserStatuses' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('idMAIL_GROUP', $this->idMAIL_GROUP);
		$criteria->compare('STATUS_idSTATUS', $this->STATUS_idSTATUS);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
	
	public function getUserList()
	{
		$str = "<ol>";
		foreach($this->myUsers as $user){
			$str .= "<li>".$user->f_name." ".$user->l_name." - ".$user->username."</li>";
		}
		$str .= "</ol>";
		return $str;
	}

}