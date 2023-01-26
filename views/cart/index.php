<?php

use app\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Product;

/** @var yii\web\View $this */
/** @var app\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Цена за единицу товара</th>
            <th scope="col">Количество</th>
        </tr>
        </thead>
        <?php
        $carts=Cart::find()->where(['user_id'=>Yii::$app->user->identity->id_user])->all();
        $product = Product::find();
        foreach ($carts as $cart){
            echo "<tr>";
            echo "<td>" .  $cart->getProduct()->one()->name ."</td>";
            echo "<td>" .  $cart->getProduct()->one()->price ."</td>";
            echo "<td>" .  $cart->count ."</td>";
            ?> <td>
                <button class="btn btn-primary" onclick="add_product(<?=$cart->product_id?>,1)">+</button>
                <button  class="btn btn-danger" onclick="add_product(<?=$cart->product_id?>,-1)">-</button>
            </td>
            <?php
            echo "</tr>";

        }
        $total=0;
        ?>
    </table>
    <input id="password" name="password" type="password">   Введите пароль</input>
    <p></p>
    <button class="btn btn-dark" onclick="Loginn()">Оформить заказ</button>
</div>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
