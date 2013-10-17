<?php
/** @var Users $model */
/** @var TbActiveForm $form */
?>
<div class="users">
    <?php if (Yii::app()->user->hasFlash('success')) : ?>
        <div class="flash-success">
            <?= Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('error')) : ?>
        <div class="flash-error">
            <?= Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>


    <div class="form">

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'users',
            'type'=>'horizontal',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <p class="note">Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</p>

        <?php echo $form->textFieldRow($model,'login'); ?>

        <?php echo $form->passwordFieldRow($model,'password'); ?>

        <?php echo $form->textFieldRow($model,'email'); ?>

        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Добавить',
            )); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->getDataProvider(),
        'template'=>"{items}",
        'columns'=>$model->getUsersColumns(),
    )); ?>

</div><!-- users -->