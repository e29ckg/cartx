<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

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
            [['order_code'], 'required'],
            [['quantity'], 'integer'],
            [['create_at'], 'safe'],
            [['order_code'], 'string', 'max' => 32],
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
            'order_code' => 'Id Order',
            'product_code' => 'ชื่อสินค้า',
            'unit_price' => 'ราคาต่อหน่วย',
            'quantity' => 'จำนวน',
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

    public function getProductUnitName(){
        $model = $this->product;
        $modelUnit = ProductUnit::find()->where(['id' => $model->unit])->one();
        return $modelUnit ? $modelUnit->name_unit:'';
    }

    // public function getProductImg(){
    //     $model = $this->product;
    //     return $model ? $model->img:'';
    // }

    public function getProductImg(){
        $model = $this->product;
        $source = Url::to('@webroot/uploads/product/img/'.$model->img);
        if(is_file($source)){
            return Url::to('@web/uploads/product/img/'.$model->img);
        }
        return  Url::to('@web/img/none.png'); 
    }

    public function getReceiptList()
    {
        return $this->hasOne(ReceiptList::className(), ['receipt_code' => 'product_code']);
    }
    
    public function getProductUnitPrice(){
        $model = $this->receiptList;
        return $model ? $model->unit_price:'';
    }

    public function DateThai_full($strDate)
	{
        if($strDate == ''){
            return "-";
        }
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม",
                            "สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai $strYear";
    }
}
