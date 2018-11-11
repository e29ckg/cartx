<?php

namespace app\models;


use Yii;
use app\models\User;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $code
 * @property string $id_user
 * @property int $status
 * @property string $create_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['status'], 'integer'],
            [['create_at'], 'safe'],
            [['code'], 'string', 'max' => 32],
            [['id_user'], 'string', 'max' => 255],
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
            'id_user' => 'Id User',
            'status' => 'Status',
            'create_at' => 'Create At',
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id_user']);
    }

    public function getProfileName(){
        $model = $this->profile;
        return $model ? $model->fullname:'';
    }

    public function getCountAll()
    {        
        return Product::find()->count();           
    }
}
