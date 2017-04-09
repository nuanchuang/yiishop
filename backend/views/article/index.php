<?php
/* @var $this yii\web\View */
?>
<!--<h1>article/index</h1>-->
<!---->
<!--<p>-->
<!--    You may change the content of this page by modifying-->
<!--    the file <code>--><?//= __FILE__; ?><!--</code>.-->
<!--</p>-->
<?=\yii\bootstrap\Html::a('添加',['article/add'],['class'=>'btn btn-lg btn-primary'])?>
<table class="table table-hover table-bordered">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>文章分类</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->ArticleCategory->name?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->status?></td>
            <td><?=$model->sort?></td>
            <td><?=date('Y-m-d H:i:s',$model->inputtime)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['article/edit','id'=>$model->id],['class'=>'btn btn-xs btn-warning'])?>
                <?=\yii\bootstrap\Html::a('删除',['article/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $pages
])?>