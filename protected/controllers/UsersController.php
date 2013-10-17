<?php


class UsersController extends CController
{
    public function actionIndex()
    {
        if (Yii::app()->user->getState('Role') != 'Admin111') $this->redirect(Yii::app()->createUrl('poi/index'));

        $modelName = 'Users';
        /** @var Users  $model */
        $model = new $modelName();

        if (isset($_POST[$modelName])){
            $model->setAttributes($_POST[$modelName]);
            if ($model->validate()){
                $model->password = crypt($model->password, 'secret_word_for_password blah-blah-blah');
                $model->role = 'helper';
                try {
                    if (!$model->save()){
                        throw new CException('Error during model saving.');
                    }
                    Yii::app()->user->setFlash('success', 'Новый помощник успешно добавлен');
                } catch (CException $exception) {
                    Yii::app()->user->setFlash('error', 'Не удалось сохщранить помощника');
                }
            }
        }

        $this->render('users', array(
            'model' => $model,
        ));
    }

    public function actionDelete()
    {
        if (Yii::app()->user->getState('Role') == 'Admin111'){
            if ($_GET){
//                var_dump((int)$_GET['id']);die;
                Users::model()->deleteByPk((int)$_GET['id']);
            }
        }
    }

}