<?php

namespace app\models;

use yii;
use yii\helpers\ArrayHelper;



/**
 * This is the model class for table "w15_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 */

//class User extends \yii\base\Object implements \yii\web\IdentityInterface
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_ADMIN = 'admin';
    const ROLE_EDITOR = 'editor';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_AUTHOR = 'author';

    public static function getRoleName($param)
    {
        return ArrayHelper::getValue(self::getRolesArray(), $param);
    }

    // Получить ассоциативный массив всех ролей с их русскими названиями
    public static function getRolesArray()
    {
        return [
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_EDITOR => 'Редактор',
            self::ROLE_MODERATOR => 'Модератор',
            self::ROLE_AUTHOR => 'Автор'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w15_users';
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id'])->select('item_name');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'role' => 'Роль',
        ];
    }
}
