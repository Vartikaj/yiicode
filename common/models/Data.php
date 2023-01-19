<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string $email
 * @property string $address
 * @property string $educationaldetails
 *
 * @property Student $email0
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'email', 'address', 'educationaldetails'], 'required'],
            [['id'], 'integer'],
            [['email'], 'string', 'max' => 100],
            [['address', 'educationaldetails'], 'string', 'max' => 500],
            [['id'], 'unique'],
            [['email'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['email' => 'email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'address' => 'Address',
            'educationaldetails' => 'Educationaldetails',
        ];
    }

    /**
     * Gets query for [[Email0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmail0()
    {
        return $this->hasOne(Student::class, ['email' => 'email']);
    }
}
