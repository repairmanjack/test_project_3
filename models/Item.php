<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property string $description
 * @property int $sold
 *
 * @property Branch $branch
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'sold'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name', 'branch_id'], 'required'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_id' => 'Филиал',
            'name' => 'Название товара',
            'description' => 'Описание товара',
            'sold' => 'Показать проданные товары'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * Продать товар
     */
    public function sell()
    {
        $this->sold = 1;
        $this->save();
    }

    /**
     * Вернуть товар
     */
    public function restore()
    {
        $this->sold = 0;
        $this->save();
    }

    /**
     * Текстовое представление состояния товара
     */
    public function getStatus()
    {
        return is_null($this->sold)
            ? 'Куплен'
            : ($this->sold
                ? 'Продан'
                : 'Возвращён');
    }
}
