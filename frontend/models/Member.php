<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $tel
 * @property integer $status
 * @property integer $last_login_time
 * @property integer $last_login_ip
 */
class Member extends \yii\db\ActiveRecord
{
    public $password;
    public $repassword;
    public $yanzheng;
    public $code;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'tel'], 'required'],
            [['last_login_time', 'last_login_ip'], 'integer'],
            [['username', 'password_hash', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['tel'], 'string', 'max' => 11],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password','repassword','yanzheng','code','openid'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名：',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => '邮箱：',
            'tel' => '电话号码：',
            'status' => '状态',
            'last_login_time' => '最后登陆时间',
            'last_login_ip' => '最后登陆IP',
            'password' => '密码：',
            'repassword' => '确认密码：',
            'yanzheng' => '验证码：',
            'code' => '验证码：',
            'openid' => '微信',
        ];
    }
}
