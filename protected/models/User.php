<?php

/**
 * This is the model base class for the table "user".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "User".
 *
 * Columns in table "user" available as properties of the model,
 * followed by relations of table "user" available as properties of the model.
 *
 * @property integer $idUSER
 * @property string $username
 * @property string $password
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property integer $GROUP_idGROUP
 * @property integer $FACILITY_idFACILITY
 *
 * @property MailgroupUserStatus[] $mailgroupUserStatuses
 * @property Requisition[] $requisitions
 * @property Requisition[] $requisitions1
 * @property Requisition[] $requisitions2
 * @property Requisition[] $requisitions3
 * @property Requisition[] $requisitions4
 * @property Requisition[] $requisitions5
 * @property Requisition[] $requisitions6
 * @property Requisition[] $requisitions7
 * @property Requisition[] $requisitions8
 * @property Group $gROUPIdGROUP
 * @property UserFacility[] $userFacilities
 */
class User extends GxActiveRecord {

 public $reset_password;
 
  public function beforeSave(){
    if($this->reset_password == '1' or $this->isNewRecord)
      $this->password = md5($this->password);
    return parent::beforeSave();
  }
  
  public static function getList(){
    return CHtml::listdata(self::model()->findAll(array('order'=>'l_name asc')),'idUSER','fullName');
  }
  
  public static function getName($idUSER){
    $u = self::model()->findByPk($idUSER);
    return empty($u) ? '' : $u->getFullName();
  }
  
 
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'User|Users', $n);
	}

	public static function representingColumn() {
		return 'username';
	}

	public function rules() {
		return array(
			array('username, password, f_name, l_name', 'required'),
			array('GROUP_idGROUP, FACILITY_idFACILITY', 'numerical', 'integerOnly'=>true),
			array('username, f_name, l_name, m_name', 'length', 'max'=>45),
			array('password', 'length', 'max'=>100),
			array('m_name, FACILITY_idFACILITY', 'default', 'setOnEmpty' => true, 'value' => null),
			array('role, reset_password, username, password, f_name, l_name, m_name, GROUP_idGROUP, FACILITY_idFACILITY', 'safe'),
		);
	}

	public function relations() {
		return array(
			'mailgroupUserStatuses' => array(self::HAS_MANY, 'MailgroupUserStatus', 'USER_idUSER'),
			'requisitions' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_req'),
			'requisitions1' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_fceo'),
			'requisitions2' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_admin'),
			'requisitions3' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_apmnl'),
			'requisitions4' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_apcorp'),
			'requisitions5' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_apceo'),
			'requisitions6' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_purch'),
			'requisitions7' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_rcvr'),
			'requisitions8' => array(self::HAS_MANY, 'Requisition', 'USER_idUSER_sign_apinv'),
			'gROUPIdGROUP' => array(self::BELONGS_TO, 'Group', 'GROUP_idGROUP'),
			'userFacilities' => array(self::HAS_MANY, 'UserFacility', 'USER_idUSER'),
			'myFacilities' => array(self::HAS_MANY, 'Facility', 'FACILITY_idFACILITY','through'=>'userFacilities'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'idUSER' => Yii::t('app', 'Id User'),
			'username' => Yii::t('app', 'Username'),
			'password' => Yii::t('app', 'Password'),
			'f_name' => Yii::t('app', 'First Name'),
			'l_name' => Yii::t('app', 'Last Name'),
			'm_name' => Yii::t('app', 'Middle Name'),
			'GROUP_idGROUP' => null,
			'FACILITY_idFACILITY' => Yii::t('app', 'Facility'),
			'mailgroupUserStatuses' => null,
			'requisitions' => null,
			'requisitions1' => null,
			'requisitions2' => null,
			'requisitions3' => null,
			'requisitions4' => null,
			'requisitions5' => null,
			'requisitions6' => null,
			'requisitions7' => null,
			'requisitions8' => null,
			'gROUPIdGROUP' => null,
			'userFacilities' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		//$criteria->with = array('userFacilities');
		//$criteria->join = 'left outer join user_facility uf on uf.USER_idUSER = t.idUSER';
		
		$criteria->compare('idUSER', $this->idUSER);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('f_name', $this->f_name, true);
		$criteria->compare('l_name', $this->l_name, true);
		$criteria->compare('m_name', $this->m_name, true);
		$criteria->compare('GROUP_idGROUP', $this->GROUP_idGROUP);
		//$criteria->compare('uf.FACILITY_idFACILITY', $this->FACILITY_idFACILITY);
		//$criteria->compare('userFacilities.FACILITY_idFACILITY', $this->FACILITY_idFACILITY, true);
		if(!empty($this->FACILITY_idFACILITY)){
			$criteria->join = 'left join user_facility uf on uf.USER_idUSER = t.idUSER';
			$criteria->compare('uf.FACILITY_idFACILITY',$this->FACILITY_idFACILITY);
		}

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
	
	public function getFullName(){return $this->l_name.', '.$this->f_name;}
	
	public function getMyFacilities($option=''){		
		$my_facilities = $this->myFacilities;		
		if($option=='string'){
			$str = "";
			foreach($my_facilities as $facility){
				$str .= $facility->title.", ";
			}
			return $str;
		}else if($option=='result_set'){
			return $my_facilities;
		}else{
			$arr = array();
			foreach($my_facilities as $facility){
				$arr[$facility->idFACILITY] = $facility->acronym." - ".$facility->title;
			}
			return $arr;
		}
	}
	
	public function getGroup()
	{
		return $this->gROUPIdGROUP->description;
	}
}