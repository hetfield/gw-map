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
                $poi->description = htmlspecialchars($_POST['text'], ENT_QUOTES);
                $poi->save();
            }

        }
    }

    public function actionGetEditDialog()
    {
        if (Yii::app()->user->isGuest) return;

        $poi_id = Yii::app()->request->getPost('poi_id');

        if ($poi_id){
            /** @var Poi $result */
            $result = Poi::model()->findByAttributes(array(
                'poi_id' => $poi_id,
            ));

            if ($result){
                echo($result->description);
            } else {
                echo("Can't find a record in DataBase!");
            }
        } else {
            echo('Poi_id is not set!');
        }
    }

}