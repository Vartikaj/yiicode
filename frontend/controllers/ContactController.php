<?php

namespace frontend\controllers;
// namespace common\controllers;

use yii;
use yii\web\Controller;
use common\models\contact;


class ContactController extends Controller
{
    public function actionCreate(){
        $contact = new ContactForm();
        $formData  = Yii::$app->request->post();
        if ($contact->load($formData)){
            if($post->save()){
                Yii::$app->getSession()->setFlash('message','Post Published Successfully');
                return $this->redirect(['index']);
            }else{
                Yii::$app->getSession()->setFlash('message','Failed to Post.');
            }
        }
        return $this->render('contact',['contact'=>$contact]);
    }

    // public function actionCreate(){
    //     $contact = new ();
    //     if ($contact->load(Yii::$app->request->post()) && $contact->signup()) {
    //         Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
    //         return $this->goHome();
    //     }

    //     return $this->render('contact', ['contact' => $contact,]);
    // }
}