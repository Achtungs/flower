<?php

namespace app\models;

use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $name
 * @property string $surname
 * @property int $patronymic
 * @property string $login
 * @property string $email
 * @property string $password

 * @property int $admin
 *
 * @property Cart[] $carts
 * @property Order $order
 * @property Product[] $products
 */
class User extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id_user;
    }

    public function getAuthKey()
    {
        return;
    }

    public function validateAuthKey($authKey)
    {
        return;
    }

    public function validatePassword($password)
    {
        return $this->password == $password;
    }

    public static function findByLogin($login)
    {
        return self::find()->where(['login' => $login])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'login', 'email', 'password', 'password_repeat'], 'required'],
            [['admin'], 'integer'],
            [['name', 'surname', 'login', 'email', 'password', 'password_repeat', 'patronymic', 'agree'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['user_id' => 'id_user']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['user_id' => 'id_user']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id_tovar' => 'product_id'])->viaTable('cart', ['user_id' => 'id_user']);
    }
}


