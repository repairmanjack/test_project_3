<?php

use app\models\Branch;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider->query->joinWith('branch');
$dataProvider->setSort([
    'attributes' => [
        'branch_id' => [
            'asc' => ['branch.name' => SORT_ASC],
            'desc' => ['branch.name' => SORT_DESC],
        ],
        'name',
        'description'
    ]
]);
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Купить товар', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Переместить товары', ['move'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => '[name="ItemSearch[sold]"]',
        'columns' => [
            [
                'attribute' => 'branch_id',
                'value' => 'branch.name',
                'filter' => ArrayHelper::map(Branch::find()->all(), 'id', 'name')
            ],
            'name',
            'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {sell} {return}',
                'buttons' => [
                    'sell' => function ($url) {
                        return Html::a('', $url, [
                            'title' => 'Продать',
                            'class' => 'glyphicon glyphicon-ruble',
                        ]);
                    },
                    'return' => function ($url) {
                        return Html::a('', $url, [
                            'title' => 'Возврат',
                            'class' => 'glyphicon glyphicon-fire',
                        ]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function ($model) {
                        return !intval($model->sold);
                    },
                    'sell' => function ($model) {
                        return !intval($model->sold);
                    },
                    'return' => function ($model) {
                        return intval($model->sold);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
