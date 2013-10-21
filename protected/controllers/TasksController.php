<?php


class TasksController extends CController
{
    public function actionIndex()
    {
        if (Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('site/login'));

        $modelName = 'Tasks';
        /** @var Poi $model */
        $model = new $modelName('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$modelName])){
            $model->attributes=$_GET[$modelName];
        }


        $this->render('tasks', array(
            'model' => $model,
        ));
    }

    public function actionSave()
    {
        if (Yii::app()->user->isGuest) return;

        if (isset($_POST)){
            /** @var Tasks $poi */
            $tasks = Tasks::model()->findByAttributes(array('task_id' => $_POST['id']));
            if ($tasks){
                $tasks->description = htmlspecialchars($_POST['text'], ENT_QUOTES);
                $tasks->save();
            }
        }
    }
}