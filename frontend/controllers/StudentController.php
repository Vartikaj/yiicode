<?php

namespace frontend\controllers;
// namespace common\controllers;

use yii;
use yii\web\Controller;
use common\models\Student;
use frontend\models\UserForm;
use yii\web\NotFoundHttpException;
use common\models\marks;
use yii\Data\Sort;

class StudentController extends Controller
{
    public function actionIndex(){

        $posts = Student::find()->orderBy(['id'=>SORT_ASC])->all(); //(model-name::functionName->attributeName)
        /**
         * USING JOIN QUERY TO FETCH DATA
         */

        // $posts = Student::find()
        //         ->select('student.*,marks.*')
        //         ->leftJoin('student','student.email = marks.email')
        //         ->where(['student.email' => 'test3@gmail.com'])
        //         ->all();

        /**
         * 
         * Simple using WITH : list of relations that this query should be performed with. 
         */
        $id = \Yii::$app->user->identity->id;
        $queryData = Student::find()->select('student.*,userdata.*')
        ->leftJoin('userdata', 'userdata.userid = student.id')
        ->where('userdata.userid ='.$id)->with('userdata')
         ->createCommand()
         ->queryAll();
         /**
          * ================
          */

          /**
           * ORDER BY CLAUSE
           */
        //   $queryData = \common\models\Student::find()->select('student.*,userdata.*')
        // ->leftJoin('userdata', 'userdata.userid = student.id')
        // ->where('userdata.userid = student.id')->orderBy(['student.id' => SORT_DESC])
        //  ->createCommand()
        //  ->queryAll();
        //  echo "<pre>";
        // print_r( $queryData);die;
        return $this->render('index', ['queryData' => $queryData]);
    }

    public function actionUpdate(){
        $student = new Student();
        $userform = new UserForm();
        // $addressinfo = new Addressinfo();
        $id = \Yii::$app->user->identity->id;

        $model = $this->findModel($id);
        $usermodel = $this->findUser($id);

        if($this->request->isPost){//to check the form method is post or not...
            if($model->load($this->request->post()) && $model->save()){
                if($usermodel->load($this->request->post()) && $usermodel->save()){
                    return $this->redirect(['index', 'id' => $model->id,'userid'=>$usermodel->userid]);
                }
                
            }
        }

        $updatedata = Student::find()->select('student.*,userdata.*')
        ->leftJoin('userdata', 'userdata.userid = student.id')
        ->where('userdata.userid = '.$id)->with('userdata')
         ->createCommand()
         ->queryAll();

         return $this->render('update',['student' => $student, 'userform' => $userform, 'updatedata' => $updatedata]);

    }

    // public function findData(){
    //     $data = 
    //     return $data;
    // }
    
    //FOR STUDENT TABLE
    public function findModel($id){
        if(($model = (Student::findone(['id' => $id]))) != null){
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //FOR USERFORM TABLE
    public function findUser($id){
        if(($usermodel = UserForm::findone(['userid' => $id])) != null){
            return $usermodel;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}