<?php
use yii\web\JsExpression;

//->dropDownList($ac_id)
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
//echo $form->field($model,'sn');
echo $form->field($model,'logo')->hiddenInput();


echo \yii\bootstrap\Html::img($model->logo,['id'=>'img','width'=>100]);

//外部TAG
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo \xj\uploadify\Uploadify::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'width' => 120,
        'height' => 40,
        'onUploadError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        //console.log(data.fileUrl);
        $("#brand-logo").val(data.fileUrl);
        $("#img").attr("src",data.fileUrl);
    }
}
EOF
        ),
    ]
]);


echo $form->field($model,'goods_category_id')->hiddenInput();
echo $form->field($model,'brand_id')->dropDownList(\backend\models\Goods::getClass());
echo $form->field($model,'market_price');
echo $form->field($model,'shop_price');
echo $form->field($model,'stock');
echo $form->field($model,'is_on_sale')->radioList(\backend\models\Goods::$is_on_sale);
echo $form->field($model,'status')->radioList(\backend\models\Goods::$status);
echo $form->field($model,'sort');
echo $form->field($goods_intro,'content')->textarea();
//echo $form->field($article,'inputtime');
echo \yii\bootstrap\Html::submitButton('提交',['class'=> 'btn btn-xs btn-success']);
\yii\bootstrap\ActiveForm::end();