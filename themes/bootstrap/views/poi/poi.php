<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('js/tinymce/tinymce.min.js'));
?>

<script type="text/javascript">
    $('.edit').live('click', function(){
        var poi_id = $(this).attr('poi_id');
        $.ajax({
            url: '<?= Yii::app()->createUrl('poi/GetEditDialog') ?>',
            type: 'POST',
            data: {poi_id: poi_id},
            success: function(response){
                $('#description').html(response);
                tinymce.init({
                    selector: "#description",
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste moxiemanager"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                });
                $('#mydialog').dialog('open');
            }
        });
    });
</script>

<div id="poi-table">
    <?php
    /** @var Poi $model */
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'template' => "{pager}{summary}\n{items}\n{pager}",
        'filter' => $model,
        'columns' => $model->getColumns(),
        'enableSorting' => true,
    )); ?>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Editing description',
        'autoOpen'=>false,
    ),
));

echo '<textarea id="description"></textarea>';

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

