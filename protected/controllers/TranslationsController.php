<?php
set_time_limit(0);

class TranslationsController extends CController
{
    public function actionIndex()
    {
        if (Yii::app()->user->getState('Role') != 'Admin111') $this->redirect(Yii::app()->createUrl('poi/index'));



        $this->render('translations');
    }

    public function actionParserJSON()
    {
        if (Yii::app()->user->getState('Role') != 'Admin111') return;

        for ($floor = 1; $floor <= 39; $floor++){
            $gwApi = json_decode(file_get_contents('https://api.guildwars2.com/v1/map_floor.json?continent_id=1&floor='.$floor));
            if (isset($gwApi->regions)){
                foreach($gwApi->regions as $regions){
                    foreach($regions->maps as $maps){
                        foreach($maps->points_of_interest as $point_of_interest){
                            $current_poi = Poi::model()->findByAttributes(array(
                                'poi_id' => $point_of_interest->poi_id,
                            ));
                            if (!$current_poi){
                                $poi = new Poi();
                                $poi->poi_id = $point_of_interest->poi_id;
                                $poi->name = $point_of_interest->name;
                                $poi->save();
                            }
                        }
                        foreach($maps->tasks as $tasks){
                            $current_task = Tasks::model()->findByAttributes(array(
                                'task_id' => $tasks->task_id,
                            ));
                            if (!$current_task){
                                $task = new Tasks();
                                $task->task_id = $tasks->task_id;
                                $task->objective = $tasks->objective;
                                $task->save();
                            }
                        }
                    }
                }
            }
        }

        echo 'done!';
    }

    public function actionWriteLocalJSON()
    {
        if (Yii::app()->user->getState('Role') != 'Admin111') return;

        $path = Yii::app()->basePath.DIRECTORY_SEPARATOR.'JSON';
        if (!is_dir($path)){
            mkdir($path);
        }

        for ($floor = 1; $floor <= 39; $floor++){
            $gwApi = json_decode(file_get_contents('https://api.guildwars2.com/v1/map_floor.json?continent_id=1&floor='.$floor));
            if (isset($gwApi->regions)){
                foreach($gwApi->regions as $regions){
                    foreach($regions->maps as $maps){
                        foreach($maps->points_of_interest as $point_of_interest){
                            $current_poi = Poi::model()->findByAttributes(array(
                                'poi_id' => $point_of_interest->poi_id,
                            ));
//                            if ($current_poi){
//                                $point_of_interest->description = $current_poi->description;
//                            } else {
//                                $point_of_interest->description = '';
//                            }
                        }
                        foreach($maps->tasks as $tasks){
                            $current_task = Tasks::model()->findByAttributes(array(
                                'task_id' => $tasks->task_id,
                            ));
//                            if ($current_task){
//                                $tasks->description = $current_task->description;
//                            } else {
//                                $tasks->description = '';
//                            }
                        }
                    }
                }
            }
            file_put_contents($path.DIRECTORY_SEPARATOR.$floor.'.json', json_encode($gwApi));
        }
    }

    public function actionGetJSON()
    {
        if (isset($_GET['floor'])){
            $path = Yii::app()->basePath.DIRECTORY_SEPARATOR.'JSON';
            if (!is_file($path.DIRECTORY_SEPARATOR.$_GET['floor'].'.json'))
                echo '';
            else {
                header('Content-Type: application/json');
                readfile($path.DIRECTORY_SEPARATOR.$_GET['floor'].'.json');
//                echo file_get_contents($path.DIRECTORY_SEPARATOR.$_GET['floor'].'.json');
            }

        }
    }

}