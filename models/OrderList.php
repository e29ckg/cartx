<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_list".
 *
 * @property int $id
 * @property string $id_order
 * @property string $id_product
 * @property int $quantity
 * @property string $create_at
 */
class OrderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order'], 'required'],
            [['quantity'], 'integer'],
            [['create_at'], 'safe'],
            [['id_order'], 'string', 'max' => 32],
            [['id_product'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order' => 'Id Order',
            'id_product' => 'Id Product',
            'quantity' => 'Quantity',
            'create_at' => 'Create At',
        ];
    }
}
