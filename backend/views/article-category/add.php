<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'status')->radioList(\backend\models\Articlecategory::$status);
echo $form->field($model,'sort');
echo $form->field($model,'is_help')->radioList(\backend\models\Articlecategory::$is_help);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
\yii\bootstrap\ActiveForm::end();