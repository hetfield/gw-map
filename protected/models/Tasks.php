<?php
/**
 * @property integer $id
 * @property integer $task_id
 * @property string $objective
 * @property string $description
 */

class Tasks extends CActiveRecord
{


    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tasks';
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('task_id', $this->task_id);
        $criteria->compare('objective',$this->objective,true);
        $criteria->compare('description',$this->description,true);


        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'description',
            ),
            'pagination'=>array(
                'pageSize'=>'20',
            ),
        ));
    }

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, task_id, objective, description', 'safe', 'on'=>'search'),
        );
    }


    public function getColumns()
    {
        return array(
            array(
                'name' => 'task_id',
                'htmlOptions' => array('style'=>'width: 50px; text-align: center;'),
            ),
            array(
                'name' => 'objective',
                'htmlOptions' => array('style'=>'width: 40%; text-align: center;'),
            ),
            array(
                'name' => 'description',
                'value' => 'htmlspecialchars_decode($data->description, ENT_QUOTES)',
                'htmlOptions' => array('class' => 'editable'),
            ),

        );



    }



}