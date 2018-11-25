<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt_list".
 *
 * @property int $id
 * @property string $receipt_code
 * @property string $product_code
 * @property int $product_unit_id
 * @property double $unit_price
 * @property int $quantity
 * @property string $create_at
 */
class ReceiptList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receipt_code'], 'required'],
            [['product_unit_id', 'quantity'], 'integer'],
            [['unit_price'], 'number'],
            [['create_at'], 'safe'],
            [['receipt_code'], 'string', 'max' => 32],
            [['product_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_code' => 'Receipt Code',
            'product_code' => 'Product Code',
            'product_unit_id' => 'Product Unit ID',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'create_at' => 'Create At',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }

    public function getProductName(){
        $model = $this->product;
        return $model ? $model->product_name:'';
    }

    public function getProductPrice(){
        $model = $this->product;
        return $model ? $model->price:'';
    }

    public function getProductImg(){
        $model = $this->product;
        return $model ? $model->img:'';
    }

    public function getProductUnit()
    {
        return $this->hasOne(ProductUnit::className(), ['id' => 'product_unit_id']);
    }

    public function getProductUnitName(){
        $model = $this->productUnit;
        return $model ? $model->name_unit:'';
    }
}
