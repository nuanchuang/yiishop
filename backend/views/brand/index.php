<?php
/* @var $this yii\web\View */
?>
<!--<h1>brand/index</h1>-->
<!---->
<!--<p>-->
<!--    You may change the content of this page by modifying-->
<!--    the file <code>--><?//= __FILE__; ?><!--</code>.-->
<!--</p>-->
<?=\yii\bootstrap\Html::a('添加',['brand/add'],['class'=>'btn btn-lg btn-primary active'])?>
<table class="table table-hover">
    <tr>
        <th>id</th>
        <th>品牌名</th>
        <th>头像</th>
        <th>状态</th>
        <th>操作</th>
        <th>修改状态</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->logo?\yii\bootstrap\Html::img('@web'.$model->logo,['style'=>'width:30px']):''?></td>
            <td><?=\backend\models\Brand::$status_now[$model->status]?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['brand/edit','id'=>$model->id],['class'=>'btn btn-xs btn-info active'])?>
            </td>
            <td>
            <?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger active'])?>
                <?=\yii\bootstrap\Html::a('隐藏',['brand/hide','id'=>$model->id],['class'=>'btn btn-xs btn-warning active'])?>
                <?=\yii\bootstrap\Html::a('正常',['brand/normal','id'=>$model->id],['class'=>'btn btn-xs btn-success active'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);