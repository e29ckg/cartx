<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_st".
 *
 * @property int $id
 * @property string $code
 * @property string $product_code
 * @property int $product_unit_id
 * @property double $unit_price
 * @property int $quantity
 * @property string $create_at
 */
class LogSt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_st';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['quantity'], 'integer'],
            // [['unit_price'], 'number'],
            [['create_at'], 'safe'],
            [['code'], 'string', 'max' => 32],
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
            'code' => 'Code',
            'product_code' => 'Product Code',
            'receipt_list_id' => 'receipt_list_id',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'create_at' => 'Create At',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }

    public function getReceipt()
    {
        return $this->hasOne(Receipt::className(), ['receipt_code' => 'code']);
    }
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_code' => 'code']);
    }

    public function getProductName(){
        $model = $this->product;
        return $model ? $model->product_name:'';
    }

    public function getUserName(){
        // $model = $this->receipt;
        $model = $this->order;
        if ($model){
            $modelP = Profile::find()->where(['user_id'=> $model->id_user])->one();
            return $modelP ? $modelP->fname.$modelP->name.' '.$modelP->sname : '-' ;
        }

        return $model ? $model->user_id:'-';
    }
    
}
