<?php
/**
 * @property integer $id
 * @property integer $poi_id
 * @property string $name
 * @property string $description
 */

class Poi extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'poi';
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('poi_id', $this->poi_id);
        $criteria->compare('name',$this->name,true);
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
            array('id, poi_id, name, description', 'safe', 'on'=>'search'),
        );
    }


    public function getColumns()
    {
        return array(
            array(
                'name' => 'poi_id',
                'htmlOptions' => array('style'=>'width: 50px; text-align: center;'),
            ),
            array(
                'name' => 'name',
                'htmlOptions' => array('style'=>'width: 40%; text-align: center;'),
            ),
            array(
                'name' => 'description',
                'value' => 'htmlspecialchars_decode($data->description, ENT_QUOTES)',
                'htmlOptions' => array('class' => 'editable', 'style'=>'width: 55%;'),
                'type' => 'html',
            ),
            array(
                'value' => 'CHtml::link("Edit", "#", array("class" => "edit", "poi_id" => $data->poi_id));',
                'type' => 'raw',
            ),
        );
    }


}