<?php
/*
 * @var
 */
?>
<!--<h1>goods-category/index</h1>-->
<!---->
<!--<p>-->
<!--    You may change the content of this page by modifying-->
<!--    the file <code>--><?//= __FILE__; ?><!--</code>.-->
<!--</p>-->
<?=\yii\bootstrap\Html::a('添加',['goods-category/add'],['class'=>'btn btn-sm btn-success'])?>
<table class="table table-hover table-bordered">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>操作</th>
    </tr>
    <tbody id="category">
    <?php foreach($models as $model):?>
        <tr date-lft = "<?=$model->lft?>" date-rgt = "<?=$model->rgt?>" date-tree = "<?=$model->tree?>">
            <td><?=$model->id?></td>
            <td><?=str_repeat('—    ',$model->depth),$model->name?><span class="glyphicon glyphicon-chevron-down expand" style="float: right"></span></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['goods-category/edit','id'=>$model->id],['class'=>'btn btn-xs btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['goods-category/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger'])?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php
$js = <<<EOT
    $(".expand").click(function(){
        $(this).toggleClass("glyphicon glyphicon-chevron-down");
        $(this).toggleClass("glyphicon glyphicon-chevron-right");

        var current_tr = $(this).closest("tr");//获取当前点击图标所在的tr
        var current_lft = parseInt(current_tr.attr("date-lft"));//当前分类左值
        var current_rgt = parseInt(current_tr.attr("date-rgt"));//当前分类右值
        var current_tree = parseInt(current_tr.attr("date-tree"));//当前分类tree值
//
//console.log(current_lft);
//console.log(current_rgt);
//console.log(current_tree);

        $("#category tr").each(function(){
            var lft = parseInt($(this).attr("date-lft"));//分类的左值
            var rgt = parseInt($(this).attr("date-rgt"));//分类的右值
            var tree = parseInt($(this).attr("date-tree"));//分类的tree值

            if(tree == current_tree && lft > current_lft && rgt < current_rgt){
                //显示或隐藏当前分类的子孙
//                console.log(current_lft);
//                console.log(current_rgt);
//                console.log(current_tree);
                $(this).toggle();
            }
        })
    })
EOT;

$this->registerJs($js);