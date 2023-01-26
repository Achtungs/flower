<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;

echo "<br><h1>Каталог товаров</h1>";


$products = $dataProvider->getModels();


echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    Категория
  </button>
  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
$items = '';
$categories = \app\models\Category::find()->all();
foreach ($categories as $category) {
    $items .= "<li><a class='dropdown-item' href='/product/catalog?ProductSearch[category_id]={$category->id_category}'>$category->name_category</a></li>";
}
echo $items;
echo "

</div>";
echo "<div class='btn-group'
<div class='dropdown p-2'>
  <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    Цена
  </button>
  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
    <a class='dropdown-item' href='https://pr-belov.сделай.site/product/catalog?sort=price'>По возрастанию</a>
    <a class='dropdown-item' href='https://pr-belov.сделай.site/product/catalog?sort=-price'>По убыванию</a>
  </div>
</div>";

echo "
<div class='btn-group'
<div class='dropdown p-2'>
  <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    Дата прибытия
  </button>
  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
    <a class='dropdown-item' href='/product/catalog?sort=-date'>Новее</a>
    <a class='dropdown-item' href='/product/catalog?sort=date'>Старее</a>
  </div>
</div>
";

echo "<div class='btn-group'
<div class='dropdown p-2'>
  <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    Производитель
  </button>
  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
    <a class='dropdown-item' href='https://pr-belov.сделай.site/product/catalog?sort=country'>По алфавиту</a>
    <a class='dropdown-item' href='https://pr-belov.сделай.site/product/catalog?sort=-country'>Против алфавита</a>
  </div>
</div>
<br>
<br>";

echo "<div class='row row-cols-1 row-cols-md-3 g4'>";
foreach ($products as $product) {
    if ($product->count > 0) {

        echo "<div class='col'>";
        echo "<div class='card m-1' style='width: 22%; min-width: 400px;'>
 
 <a href='/product/view?id_tovar={$product->id_tovar}'><img src='{$product->image}'
    class='card-img-top' style='max-height: 300px;' alt='image'></a>
    
 <div class='card-body'>
 <h5 class='card-title'>{$product->name}</h5>
 <p class='card-text'>{$product->country}</p>
 <p class='text-danger'>{$product->price} руб</p>";

        echo(Yii::$app->user->isGuest ? "<a href='/product/view?
id_tovar={$product->id_tovar}' class='btn btn-primary'>Просмотр товара</a>" : "<p
onclick='add_product({$product->id_tovar}, 1)' class='btn btn-primary'>Добавить в корзину</p>");

        echo "</div>
    </div>";
    }
    echo "</div>";
}

echo "</div>";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</div>
