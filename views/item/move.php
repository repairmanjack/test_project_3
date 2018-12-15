<?php

use app\models\Branch;
use app\models\Item;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemMove */

$this->title = 'Переместить товары';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="item-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'idList')->checkboxList(ArrayHelper::map(Item::find()->where([
            'or', ['sold' => null], ['sold' => 0]
        ])->all(), 'id', 'name'))?>

        <?= $form->field($model, 'targetBranch')->dropDownList(
                ArrayHelper::map(Branch::find()->all(), 'id', 'name'))?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
