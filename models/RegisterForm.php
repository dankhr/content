<?
namespace app\models;

use yii;
use yii\base\Model;

/**
 * Register form
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password2;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Логин уже занят.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password2', 'required'],
            ['password2', 'string', 'min' => 6],
            ['password2', 'compare', 'compareAttribute'=>'password', 'message' => 'Пароли не совпадают.'],  // Проверка совпадения паролей
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'password2' => 'Укажите пароль ещё раз',
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

}