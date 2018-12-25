<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_m_l".
 *
 * @property int $id
 * @property string $month
 * @property string $product_name
 * @property string $product_unit
 * @property int $kb
 * @property int $r
 * @property int $o
 * @property int $k
 * @property double $unit_price
 * @property double $total_price
 * @property string $detail
 * @property string $create_at
 */
class ReportML extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_m_l';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kb', 'r', 'o', 'k'], 'integer'],
            [['unit_price', 'total_price'], 'number'],
            [['create_at'], 'safe'],
            [['month', 'product_name', 'product_unit', 'detail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month' => 'Month',
            'product_name' => 'Product Name',
            'product_unit' => 'Product Unit',
            'kb' => 'Kb',
            'r' => 'R',
            'o' => 'O',
            'k' => 'K',
            'unit_price' => 'Unit Price',
            'total_price' => 'Total Price',
            'detail' => 'Detail',
            'create_at' => 'Create At',
        ];
    }
}
