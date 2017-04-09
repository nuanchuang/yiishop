<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password');
//echo $form->field($model,'salt');
echo $form->field($model,'email');
//echo $form->field($model,'token');
//echo $form->field($model,'token_create_time');
//echo $form->field($model,'add_time');
//echo $form->field($model,);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
\yii\bootstrap\ActiveForm::end();