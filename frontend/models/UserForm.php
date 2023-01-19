<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\UserForm;
use common\models\Student;

class UserForm extends \yii\db\ActiveRecord{
    // $name;
    // $email;
    // $address;

    //FROM HERE WE ARE ABLE TO ADD THE TABLEIN WHICH WE INSERT THE FORM RECORDS
    public static function tableName(){
        return 'userdata';
    }

    public function rules(){
        return[
            [['userid','name','email','address'],'required'],

            // ['email', 'trim'],
            // ['email', 'required'],
            // ['email', 'email'],
            // ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['address'],'string', 'max' => 255],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['userid' => 'id']]
        ];
    }

    public function getStudent()
    {

        return $this->hasMany(Student::class, ['id' => 'userid']);

    }

    // USING THIS FUNCTION WE SAVE DATA INTO THE DATABASE
    public function userdata()
    {
        // if (!$this->validate()) {
        //     return null;
        // }
        
        $useform = new UserForm();
        $useform->userid = \Yii::$app->user->identity->id;
        $useform->name = $this->name;
        $useform->email = $this->email;
        $useform->address = $this->address;

        return $useform->save();
    }

    
}