<?php

namespace app\models;

use Yii;
use app\models\ProductUnit;
use app\models\ProductCatalog;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $product_name
 * @property string $code
 * @property string $img
 * @property int $category
 * @property string $Description
 * @property string $location
 * @property int $status
 * @property int $lower
 * @property int $instoke
 * @property string $create_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const UPLOAD_FOLDER = '/uploads/contact/';
    public $urlfiles ='/uploads/contact';


    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'category', 'unit'], 'required'],
            [['category', 'status', 'unit',  'lower', 'instoke'], 'integer'],
            [['create_at'], 'safe'],
            [['product_name', 'img', 'Description', 'location'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 32],
            [['product_name'], 'unique'],
            [['img'], 'file', 'extensions' => 'png, jpg', 'maxSize'=> 1024 * 1024 * 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'ชื่อวัสดุ',
            'code' => 'Code',
            'img' => 'รูปภาพ',
            'category' => 'ประเภท',
            'unit' => 'หน่วยนับ',
            'Description' => 'รายละเอียด',
            'location' => 'ที่เก็บ',
            'instoke' => 'จำนวนคงเหลือ',
            'status' => 'สถานะ',
            'lower' => 'แจ้งเตือนขั้นต่ำ',
            'create_at' => 'Create At',
        ];
    }
    

    public function getCatalog()
    {
        return $this->hasOne(ProductCatalog::className(), ['id' => 'category']);
    }

    public function getCatalogtName(){
        $model=$this->catalog;
        return $model?$model->name_catalog:'';
    }

    public function getCatalogList(){
        $model = ProductCatalog::find()->select('id, name_catalog')->orderBy('id')->all();
        return ArrayHelper::map($model,'id','name_catalog');
    }

    public function getProductUnit()
    {
        return $this->hasOne(ProductUnit::className(), ['id' => 'unit']);
    }

    public function getUnitName(){
        $model =$this->productUnit;
        return $model ? $model->name_unit : '';
    }

    public function getUnitList(){
        $model = ProductUnit::find()->select('id, name_unit')->orderBy('id')->all();
        return ArrayHelper::map($model,'id','name_unit');
    }

    public function getProductImg($img){
        // $model = $this->product;
        $source = Url::to('@webroot/uploads/product/img/'.$img);
        if(is_file($source)){
            return Url::to('@web/uploads/product/img/'.$img);
        }
        return  Url::to('@web/img/none.png'); 
    }

    public function getCountAll()
    {        
        return Product::find()->count();           
    }

    public function getStatus()
    {
        return [
            '1' => 'ปกติ',
            '4' => 'ยกเลิก',
        ];
    }

    public function getStatusName($st)
    {
        if(!empty($st)){
            return $this->getStatus()[$st];
        }        
        return '----';
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
