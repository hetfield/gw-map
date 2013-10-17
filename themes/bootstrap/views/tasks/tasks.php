<?php
Yii::app()->clientScript->registerScript('mainPageScript', <<<JS

$('body').bind('mousedown',function(){
    $('.editable').each(function(k){
        $(this).click(function(){
            var width = $(this).width();
            var height = $(this).height();
            var id = $(this).closest('tr').find('td').eq(0).html();
            var text = $(this).html();
            if (text.indexOf('<textarea') == -1){
                $(this).html('<textarea style="width: '+width+'px; height: '+height+'px; margin: 0px; padding: 0px;">'+$(this).html()+'</textarea>');
                $(this).find('textarea').focus();
                $(this).find('textarea').bind('focusout', function(){
                    var text = $(this).val();
                    $.ajax({
                        url: '/tasks/save/',
                        type: 'POST',
                        data: {'id':id,'text':text, 'k':k},
                        success:  function(res) {
                            console.log(res);
                    }
                    });
                $(this).parent().html(text);
                $(this).css('width','');
            });
            }
        })
})
})
JS
    , CClientScript::POS_READY);

?>

<div id="tasks-table">
    <?php
    /** @var Poi $model */
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'template'=>"{pager}{summary}\n{items}\n{pager}",
        'filter' => $model,
        'columns'=>$model->getColumns(),
        'enableSorting' => true,
    )); ?>
</div>

