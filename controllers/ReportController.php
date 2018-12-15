<?php

namespace app\controllers;

use app\models\Branch;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'branches' => Branch::find()->all()
        ]);
    }

}
