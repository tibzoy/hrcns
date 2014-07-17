<?php

class HruserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return AccessRules::getRules('admin_hruser');
	}
  
  public function actionPasswordreset(){
    $model = new HrUser('pwreset');
    
    $this->performAjaxValidation($model);
    
    if(isset($_POST['HrUser'])){
      $model->attributes = $_POST['HrUser'];
      if($model->validate()){
        $user = User::model()->findByPk(Yii::app()->user->getState('id'));
        $user->password = md5($model->new_password);
        $user->save(false);
        $subj = "Password Personalized";
        $msg = "Hi,\n\nYou have successfully personalized your password. If you did not initiate this, please call support immediately.";
        Helper::queueMail($user->username,$subj,$msg);
        Yii::app()->user->setFlash("feedback", "Your password has been personalized successfully.");
        Yii::log('ACCOUNT: Password Personalized for '.$user->username,'error','app');
      } 
    }
    
    $this->render('password_reset',array(
      'model'=>$model,
    ));
  }

	public function actionAccountrecovery(){
    $model = new HrUser('recovery');
    
    $this->performAjaxValidation($model);
    
    if(isset($_POST['HrUser'])){
      $model->attributes = $_POST['HrUser'];
      if($model->validate()){
        $tmp_pass = uniqid();
        $user = User::model()->find('username = :email',array('email'=>$model->email));        
        $user->password = md5($tmp_pass);
        $user->save(false);
        $subj = "Password Reset";
        $msg = "Hi,\n\nYour temporary password: $tmp_pass\n\nIt is strongly recommended that you personalize your password once you have logged in successfully.";
        Helper::queueMail($model->email,$subj,$msg);
        Yii::app()->user->setFlash("feedback", "We've sent you a temporary password to $model->email. Please check in about 2-5 minutes from now.");
        Yii::log('ACCOUNT: Account Recovery Temp password sent to '.$model->email,'error','app');
      }  
    }
    
    $this->render('recovery',array(
      'model'=>$model,
    ));
  }
  
  
  /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new HrUser('new');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HrUser']))
		{
			$model->attributes=$_POST['HrUser'];

			if($model->save())
				//$this->redirect(array('view','id'=>$model->user_id));
        $this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HrUser']))
		{
			$model->attributes=$_POST['HrUser'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
// 		$dataProvider=new CActiveDataProvider('HrUser');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));
      $this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HrUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HrUser']))
			$model->attributes=$_GET['HrUser'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=HrUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		//if(isset($_POST['ajax']) && $_POST['ajax']==='hr-user-form')
    if(isset($_POST['ajax']))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
  
  
}
