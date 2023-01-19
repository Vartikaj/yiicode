<?php

namespace common\models;

use Yii;
use yii\base\Model;
use frontend\models\UserForm;
use common\models\Student;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $phone
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            [['phone'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            
        ];
    }

    public function getUserdata()
    {

        return $this->hasMany(UserForm::class, ['userid' => 'id']);

    }
    // public function getAddressinfos()
    // {
    //     return $this->hasMany(Addressinfo::class, ['stdid' => 'id']);
    // }

    // public function getSelectData(){
    //     return $this
    // }
}
