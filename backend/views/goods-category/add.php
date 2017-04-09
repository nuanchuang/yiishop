<?php
/*
 * @var $this \yii\webView
 */
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'parent_id')->hiddenInput();
echo '<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>';
echo $form->field($model,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-xs btn-success']);
\yii\bootstrap\ActiveForm::end();


$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',['depends'=>\yii\web\JqueryAsset::className()]);//给当前视图添加js文件


//加载js文件
$js = <<<EOT
var zTreeObj;
    // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
    var setting = {
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "parent_id",
                rootPId: 0
            }
        },
        callback:{
            onClick: function(event,treeId,treeNode){
                console.log(treeNode.id);
                $("#goodscategory-parent_id").val(treeNode.id)
            }
        }
    };
    // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
//    var zNodes = [
//        {id:1, pId:0, name: "父节点1"},
//        {id:11, pId:1, name: "子节点1"},
//        {id:12, pId:1, name: "子节点2"}
//    ];
      var zNodes = {$models}

      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
      zTreeObj.expandAll(true);//默认展开节点
      zTreeObj.selectNode(zTreeObj.getNodeByParam("id","{$model->parent_id}",null));//根据ID选中节点
EOT;
$this->registerJs($js);
?>
<!--<TITLE> 实例 </TITLE>-->
<!--<meta http-equiv="content-type" content="text/html; charset=UTF-8">-->
<!--    <link rel="stylesheet" href="/zTree/css/demo.css" type="text/css">-->
<link rel="stylesheet" href="/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--<script type="text/javascript" src="/zTree/js/jquery-1.4.4.min.js"></script>-->


