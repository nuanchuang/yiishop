<h1>菜单与权限</h1>
<?=\yii\bootstrap\Html::a('添加',['menu/add'],['class'=>'btn btn-xs btn-info'])?>
<table class="table table-hover table-bordered">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>链接</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->url?></td>
            <td><?=$model->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['menu/edit','id'=>$model->id],['class'=>'btn btn-xs btn-primary'])?>
                <?=\yii\bootstrap\Html::a('删除',['menu/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>