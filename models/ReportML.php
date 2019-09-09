<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_m_l".
 *
 * @property int $id
 * @property string $month
 * @property string $product_code
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
            // [['unit_price','total_price'], 'number'],
            [['create_at'], 'safe'],
            [['month', 'product_code', 'detail'], 'string', 'max' => 255],
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
            'product_code' => 'Product ode',
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

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }

    public function getProductUnit()
    {
        return $this->hasOne(ProductUnit::className(), ['id' => 'product_unit']);
    }

    public function getProductName(){
        $model = $this->product;
        return $model ? $model->product_name:'';
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
