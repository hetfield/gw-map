<?php


class PoiController extends CController
{
    public function actionIndex()
    {
        if (Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('site/login'));


        $modelName = 'Poi';
        /** @var Poi $model */
        $model = new $modelName('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$modelName])){
            $model->attributes=$_GET[$modelName];
        }

        $this->render('poi', array(
            'model' => $model,
        ));
    }

    public function actionSave()
    {
        if (Yii::app()->user->isGuest) return;

        if (isset($_POST)){
            /** @var Poi $poi */
            $poi = Poi::model()->findByAttributes(array('poi_id' => $_POST['id']));
            if ($poi){
                $poi->description = htmlentities($_POST['text']);
                $poi->save();
            }

        }
    }



}