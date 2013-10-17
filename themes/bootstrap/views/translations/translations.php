<?php
Yii::app()->clientScript->registerScript('mainPageScript', <<<JS

$('#localJSON').click(function(){
    var btn = $(this);
    btn.button('loading'); // call the loading function
    $.ajax({
        url: '/translations/WriteLocalJSON',
        type: 'POST',
        data: {},
        success: function(res){
              btn.button('reset');
        }
    })
})

$('#parser').click(function(){
    var btn = $(this);
    btn.button('loading'); // call the loading function
    $.ajax({
        url: '/translations/ParserJSON',
        type: 'POST',
        data: {},
        success: function(res){
              btn.button('reset');
        }
    })
})

JS
    , CClientScript::POS_READY);

?>
<div class="ParseJSON">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'button',
        'type'=>'primary',
        'label'=>'Обновить базу',
        'loadingText'=>'Тружусь...:)',
        'htmlOptions'=>array('id'=>'parser'),
    )); ?>
</div>
<br />
<div class="writeJSON">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'button',
        'type'=>'primary',
        'label'=>'Обновить внутренний JSON',
        'loadingText'=>'Тружусь...:)',
        'htmlOptions'=>array('id'=>'localJSON'),
    )); ?>
</div>