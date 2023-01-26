<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Где нас найти';
//$this->params['breadcrumbs'][] = $this->title;
?>
    <link rel="stylesheet" href="../../web/css/arrow.css" type="text/css">
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
<?php
   echo "<div class='container'>
  <section class='mx-auto my-5' style='max-width: 23rem;'>

    <div class='card map-card'>
      <div id='map-container-google-1' class='z-depth-1-half map-container' style='height: 500px'>
        <iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190029.01772586376!2d12.395915746150822!3d41.90998597595415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f6196f9928ebb%3A0xb90f770693656e38!2z0KDQuNC8LCDQmNGC0LDQu9C40Y8!5e0!3m2!1sru!2sru!4v1674310723448!5m2!1sru!2sru' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>
      </div>
      <div class='card-body closed px-0'>
        
        <div class='bg-white px-4 pb-4 pt-3-5'>
          <h5 class='card-title h5 living-coral-text'>Колизей</h5>
          <div class='d-flex justify-content-between living-coral-text'>
            <h6 class='card-subtitle font-weight-light'>buba@gmail.com</h6>
            <h6 class='font-small font-weight-light mt-n1'>8(800)555-35-35</h6>
          </div>
          <div
            class='d-flex justify-content-between pt-2 mt-1 text-center text-uppercase living-coral-text'>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>";
   ?>


