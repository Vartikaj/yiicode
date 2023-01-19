<?php

    namespace frontend\controllers;
    // namespace common\controllers;

    use Yii;
    use yii\base\InvalidArgumentException;
    use yii\web\BadRequestHttpException;
    use yii\web\Controller;
    use frontend\models\UserForm;

    class UserController extends Controller{

        public function actionIndex(){
            $useform = new UserForm(); // HERE WE CALLING USERFORM MODEL
            // $id = Yii::$app->user->getId();
            $id = \Yii::$app->user->identity->id;

            // THIS LINE OF CODE IS USED TO FETCH THE RECORDS INFORMATION...
            $userformmodel = UserForm::find()->where(['userid' => $id])->all();
            $userDataUpdated = UserForm::find()->where(['userid' => $id])->one();
            
            //CONDITION RUN WHEN THE USER CLICK ON THE SUBMIT BUTTON
            if($useform->load(Yii::$app->request->post())){
                
                /**
                 * THIS CODE IS USED TO UPDATE THE DATA IF DATA IS EXIST INSIDE THE 
                 * DATABASE
                 */
                if(count($userformmodel) > 0){
                    /** 
                     * THIS LINE OF CODE USE TO ADD FLASH SCREEN WHEN THE 
                     * FORM DATA SUBMITTED....
                    */
                    Yii::$app->session->setFlash('updateform');
                    if($userDataUpdated->load(Yii::$app->request->post()) && $userDataUpdated->update()){
                        return $this->render('user', [
                            'useform' => $useform
                        ]);
                    }
                    return $this->render('user',['userform'=>$userform]);
                }else if($useform->userdata()){
                    /**
                     * 
                     * THIS WILL RUN THE CODE WHEN DATA IS NOT PRESENT IN THE DATABASE
                     */
                    Yii::$app->session->setFlash('contactFormSubmitted');
                    /**
                     * =========
                     */
                    return $this->render('user', [
                        'useform' => $useform
                    ]);

                }else{
                    Yii::$app->session->setFlash('contactFormSubmitted');
                    return $this->render('user', [
                        'useform' => $useform
                    ]);
                }
            }else if($userformmodel){
                Yii::$app->session->setFlash('updateformcontent');
                return $this->render('user', ['useform'=>$useform,'userformmodel' => $userformmodel]);

            }else{
                
                return $this->render('user',['useform'=>$useform]);
            }
            
        }

        public function actionDelete(){
            $id = \Yii::$app->user->identity->id;
            $userDataUpdated = UserForm::find()->where(['userid' => $id])->one();
            Yii::$app->session->setFlash('updateform');
            if($userDataUpdated->load(Yii::$app->request->post()) && $userDataUpdated->delete()){
                return $this->redirect(['index']);
            }
        }

    }
    