<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\user $model */

$this->title = 'Регистрация';
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
