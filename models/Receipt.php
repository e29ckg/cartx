<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property string $receipt_code
 * @property int $user_id
 * @property string $receipt_from
 * @property double $sumtotal
 * @property int $status
 * @property string $create_at
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receipt_from'], 'required'],
            // [['user_id', 'status'], 'integer'],
            // [['sumtotal'], 'number'],
            // [['create_at'], 'safe'],
            // [['receipt_code'], 'string', 'max' => 32],
            // [['receipt_from'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'receipt_from' => 'รับของจากร้าน/บริษัท',
            'sumtotal' => 'Sumtotal',
            'status' => 'Status',
            'create_at' => 'Create At',
        ];
    }

    public function getCountAll()
    {        
        return Receipt::find()->count();           
    }

    public function getSeller()
    {
        return $this->hasOne(Seller::className(), ['id' => 'receipt_from']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getProfileName(){
        $model = $this->profile;
        return $model ? $model->fname.$model->name.' '.$model->sname:'';
    }

    public function getSellerName(){
        $model = $this->seller;
        return $model ? $model->name : '-' ;
    }

    public function getSellerNameList(){
        $model = Seller::find()->select('id, name')->orderBy('name')->all();
        return ArrayHelper::map($model,'id','name');
    }

    public function getStatus()
    {
        return [
            '1' => 'ปกติ',
            '4' => 'ยกเลิก',
        ];
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
		return "$strDay $strMonthThai $strYear ";
    }
}
