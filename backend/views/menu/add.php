<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'url');
echo $form->field($model,'parent_id')->dropDownList(\backend\models\Menu::getClass());
echo $form->field($model,'description')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-xs btn-success']);
\yii\bootstrap\ActiveForm::end();