<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id_tovar
 * @property int $category_id
 * @property string $name
 * @property int $price
 * @property string $country
 * @property string $color
 * @property string $category
 * @property resource $image
 * @property int $count
 * @property string $date
 *
 * @property Cart[] $carts
 * @property Category $category0
 * @property Order $order
 * @property User[] $users
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'country', 'color', 'category', 'image', 'count'], 'required'],
            [['category_id', 'price', 'count'], 'integer'],
            [['image'], 'file',  'extensions' => ['png', 'jpg', 'gif'],'skipOnEmpty' => false ],
            [['date'], 'safe'],
            [['name', 'country', 'color', 'category'], 'string', 'max' => 255],
            [['category_id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tovar' => 'Id Tovar',
            'category_id' => 'Category ID',
            'name' => 'Наименование',
            'price' => 'Цена',
            'country' => 'Производитель',
            'color' => 'Цвет',
            'category' => 'Category',
            'image' => 'Image',
            'count' => 'Количество',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['product_id' => 'id_tovar']);
    }

    /**
     * Gets query for [[Category0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id_category' => 'category_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['product_id' => 'id_tovar']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_user' => 'user_id'])->viaTable('cart', ['product_id' => 'id_tovar']);
    }
}
