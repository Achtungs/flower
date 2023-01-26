<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_tovar',
            //'category_id',
            'name',
            'price',
            'country',
            'color',
            ['attribute'=>'Фото', 'format'=>'html',
                'value'=>function($data){return"<img src='{$data->image}' alt='photo'
style='width: 700px;'>";}],
            //'image',
            'count',
            //'date',
        ],
    ]) ?>

</div>
