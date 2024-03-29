<?php

namespace app\models;

use app\models\Product;
use app\models\profile;

use yii\base\Model;
use yii\web\UploadedFile;

use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

use Yii;

class Cart extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = '/uploads/contact/';
    public $urlfiles ='/uploads/contact';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'],'unique','message'=>'Name already exist. Please try another one.'],
            ['email', 'email'],
            [['birthday'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['photo', 'dep', 'address', 'email', 'tel'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 255],
            [['photo'], 'file', 'extensions' => 'png, jpg', 'maxSize'=> 1024 * 1024 * 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'photo' => 'รูปภาพ',
            'dep' => 'ตำแหน่ง',
            'email' => 'E-Mail',
            'tel' => 'เบอร์โทรศัพท์',
            'address' => 'ที่อยู่',
            'comment' => 'หมายเหตุ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getDep(){
        return [
            'ที่ปรึกษากฎหมาย' => 'ที่ปรึกษากฎหมาย',
            'name' => 'ชื่อ',
            'photo' => 'รูปภาพ',
            'dep' => 'ตำแหน่ง',
            'email' => 'E-Mail',
            'tel' => 'เบอร์โทรศัพท์',
            'address' => 'ที่อยู่',
            'comment' => 'หมายเหตุ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getItemTitle(){
        return self::itemsAlias('title');
    }

    public function getItemDep(){
        return self::itemsAlias('dep');
    }

    public function getCountAll()
    {        
        return Co::find()->count();           
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    
    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }
    
    private function uploadSingleFile($model,$tempFile=null){
        $file = [];
        $json = '';
        try {
             $UploadedFile = UploadedFile::getInstance($model,'photo');
             if($UploadedFile !== null){
                 $oldFileName = $UploadedFile->basename.'.'.$UploadedFile->extension;
                 $newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
                 $UploadedFile->saveAs(Co::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                 $file[$newFileName] = $oldFileName;
                 $json = Json::encode($file);
             }else{
                $json=$tempFile;
             }
        } catch (Exception $e) {
            $json=$tempFile;
        }
        return $json ;
    }

    private function uploadMultipleFile($model,$tempFile=null){
        $files = [];
        $json = '';
        $tempFile = Json::decode($tempFile);
        $UploadedFiles = UploadedFile::getInstances($model,'docs');
        if($UploadedFiles!==null){
           foreach ($UploadedFiles as $file) {
               try {   $oldFileName = $file->basename.'.'.$file->extension;
                       $newFileName = md5($file->basename.time()).'.'.$file->extension;
                       $file->saveAs(Freelance::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                       $files[$newFileName] = $oldFileName ;
               } catch (Exception $e) {

               }
           }
           $json = json::encode(ArrayHelper::merge($tempFile,$files));
        }else{
           $json = $tempFile;
        }
       return $json;
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id_user']);
    }

    public function getProfileName(){
        $model = $this->profile;
        return $model ? $model->fname.$model->name.' '.$model->sname:'';
    }

    public function getProductUnit()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_user']);
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
