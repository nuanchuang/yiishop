<?php
//->dropDownList($ac_id)
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($article,'name');
echo $form->field($article,'article_category_id')->dropDownList(\backend\models\Article::getClass());
echo $form->field($article,'intro');
echo $form->field($article,'status')->radioList(\backend\models\Article::$status);
echo $form->field($article,'sort');
echo $form->field($article_detail,'content')->textarea();
//echo $form->field($article,'inputtime');
echo \yii\bootstrap\Html::submitButton('提交',['class'=> 'btn btn-xs btn-success']);
\yii\bootstrap\ActiveForm::end();