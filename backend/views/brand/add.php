<?php
use yii\web\JsExpression;

$from = \yii\bootstrap\ActiveForm::begin();
echo $from->field($model,'name');
echo $from->field($model,'intro')->textarea();
//echo $from->field($model,'logo_file')->fileInput();
echo $from->field($model,'logo')->hiddenInput();

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
//        $("#img").css(width,300px);
    }
}
EOF
        ),
    ]
]);
echo $from->field($model,'sort');
echo $from->field($model,'status')->radioList(\backend\models\Brand::$status_now);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info btn-sm']);
\yii\bootstrap\ActiveForm::end();