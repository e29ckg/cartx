<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seller".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 */
class Seller extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seller';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone'], 'required'],
            [['name'], 'unique'],
            [['name', 'address', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อร้าน/ผู้ขาย',
            'address' => 'ที่อยู่',
            'phone' => 'Phone',
        ];
    }
}
