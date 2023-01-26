<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use app\models\Product;


//$this->title = 'О нас';
?>
<link rel="stylesheet" href="../../web/css/about.scss" type="text/css">
<div class="site-about">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class='container'>
        <section>
            <img src="../../web/productImage/мир.png">
            <div class='info'>
                <br><br><br><br><br><br><br>
                <h1>Хороший букет</h1>
                <h1>красноречивее слов!</h1>
            </div>
        </section>
    </div>
    <?php $articles=Product::find()->orderBy(['date'=>SORT_DESC])->limit(5)->all();
    $items=[];

    foreach ($articles as $product){
        $items[]="<div class='bg-white m-2 p-2 d-flex flex-column justify-content-center'>
    <h1 class='text-primary text-center m-2'>{$product->name}</h1>
    <img class='m-auto w-100' src='{$product->image}' alt='photo'/></div>";
    }
    echo yii\bootstrap5\Carousel::widget(['items'=>$items]);
    ?>
