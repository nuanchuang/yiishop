<?php
//$form=\yii\bootstrap\ActiveForm::begin([
//    'options'=>['class'=>'form-inline']
//]);
//echo $form->field($models,'name');
//echo $form->field($models,'sn');
//echo \yii\bootstrap\Html::submitButton('搜索');
//\yii\bootstrap\ActiveForm::end();
//?>
<table class="table table-hover table-bordered">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品LOGO</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sn?></td>
            <td><?=\yii\bootstrap\Html::img('@web/'.$model->logo.['style'=>'width:30px'])?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->stock?></td>
            <td>
                <?=\yii\bootstrap\Html::a('cka ',['goods/edit','id'=>$model->id],['class'=>'btn btn-xs btn-info'])?>
                <?=\yii\bootstrap\Html::a('编辑',['goods/edit','id'=>$model->id],['class'=>'btn btn-xs btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['goods/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\bootstrap\Html::a('添加',['goods/add'],['class'=>'btn btn-sm btn-success'])?>
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $pages
])?>