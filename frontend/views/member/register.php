<?php
?>
<!-- 登录主体部分start -->
<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
                <?php
                $form = \yii\widgets\ActiveForm::begin();
                $a = '<input type="button" onclick="bindPhoneNum(this)" id="get_captcha" value="获取验证码" style="height: 25px;padding:3px 8px">';

                echo '<ul>';
                echo $form->field($model,'username',
                    [
                        'options' => ['tag'=>'li'],
                        'errorOptions' => ['tag'=>'p'],
                        'template' => "{label}\n{input}\n{hint}\n{error}"
                    ]
                    )->textInput(['class'=>'txt','placeholder'=>'3-20位字符，可由中文、字母、数字和下划线组成']);

                echo $form->field($model,'password',
                    [
                        'options' => ['tag'=>'li'],
                        'errorOptions' => ['tag'=>'p'],
                        'template' => "{label}\n{input}\n{hint}\n{error}"
                    ])->passwordInput(['class'=>'txt','placeholder'=>'6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号']);


                echo $form->field($model,'repassword',
                    [
                        'options' => ['tag'=>'li'],
                        'errorOptions' => ['tag'=>'p'],
                        'template' => "{label}\n{input}\n{hint}\n{error}"
                    ])->passwordInput(['class'=>'txt','placeholder'=>'请再次输入密码']);

                echo $form->field($model,'email',
                    [
                        'options' => ['tag'=>'li'],
                        'errorOptions' => ['tag'=>'p'],
                        'template' => "{label}\n{input}\n{hint}\n{error}"
                    ])->textInput(['class'=>'txt','placeholder'=>'请输入邮箱']);

                echo $form->field($model,'tel',
                    [
                        'options' => ['tag'=>'li'],
                        'errorOptions' => ['tag'=>'p'],
                        'template' => "{label}\n{input}$a\n{hint}\n{error}"
                    ])->textInput(['class'=>'txt','placeholder'=>'请输入电话号码']);

                echo $form->field($model,'yanzheng',
                    [
                        'options' => ['tag'=>'li'],
                        'errorOptions' => ['tag'=>'p'],
                        'template' => "{label}\n{input}\n{hint}\n{error}"
                    ])->textInput(['class'=>'txt','placeholder'=>'请输入收到的验证码']);


                echo '<li><label for="">&nbsp;</label>'.\yii\helpers\Html::submitButton('',['class'=>'login_btn','id'=>'sms']).'</li>';

                echo '</ul>';

                \yii\widgets\ActiveForm::end();
                ?>
        </div>

        <div class="mobile fl">
            <h3>手机快速注册</h3>
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>

    </div>
</div>
<!-- 登录主体部分end -->
<?php
$url = \yii\helpers\Url::to(['member/smscode']);//将数据发送到控制器的获取电话方法中生成验证码
$token = Yii::$app->request->csrfToken;
$this->registerJs(new \yii\web\JsExpression(
    <<<EOT
    //发送ajax请求
    var tel = $('#member_tel').val();//获取电话
    $.post("{$url}",{"tel":tel,"_csrf-frontend":"{$token}"},function(data){
        //console.log(data);
    })
            //启用输入框
            $('#get_captcha').click(function(){

            $('#captcha').prop('disabled',false);
            var time=30;
            var interval = setInterval(function(){
                time--;
                if(time<=0){
                    clearInterval(interval);
                    var html = '获取验证码';
                    $('#get_captcha').prop('disabled',false);
                } else{
                    var html = time + ' 秒后再次获取';
                    $('#get_captcha').prop('disabled',true);
                }

                $('#get_captcha').val(html);
            },1000);
        })
EOT
));

