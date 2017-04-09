<?php
/* @var $this yii\web\View */
?>
<?=\yii\bootstrap\Html::a('添加',['admin/add'],['class'=>'btn btn-sm btn-primary active'])?>
    <table class="table table-hover">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>注册时间</th>
            <th>最后登陆ip</th>
            <th>操作</th>
        </tr>
        <?php foreach($models as $model):?>
            <tr>
                <td><?=$model->id?></td>
                <td><?=$model->username?></td>
                <td><?=$model->email?></td>
                <td><?=date('Y-m-d H:i:s',$model->add_time)?></td>
                <td><?=$model->last_login_ip?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('编辑',['admin/edit','id'=>$model->id],['class'=>'btn btn-xs btn-success active'])?>
                    <?=\yii\bootstrap\Html::a('删除',['admin/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger active'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);