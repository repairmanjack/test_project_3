<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 */
class ItemMove extends yii\base\Model
{
    /**
     * @var int[]
     */
    public $idList;

    /**
     * @var int
     */
    public $targetBranch;

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'idList' => 'Укажите товары для переноса',
            'targetBranch' => 'Укажите целевой филиал',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idList'], 'required'],
            [['idList'], 'each', 'rule' => ['exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['idList' => 'id']]],
            [['targetBranch'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['targetBranch' => 'id']],
        ];
    }

    public function accept()
    {
        if ($this->validate()) {
            foreach ($this->idList as $id) {
                $item = Item::findOne(['id' => $id]);

                if (!is_null($item) && !$item->sold) {
                   $item->branch_id = $this->targetBranch;
                   $item->save();
                }
            }

            return true;
        } else {
            return false;
        }
    }
}