<?php
    use yii\bootstrap4\Html;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    //USING THIS LINE WE CALL MENU WHICH ARE COMMON FOR ALL
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        // ANOTHER COMPONENT URL
        // ['label' => 'Dummy' , 'url' => ['/hello/index']],
    ];

    //USING THIS LINE OF CODE WE CAN ADD TO SHOW SOME MENU WHEN USER ARE NOT LOGIN
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }else{
        //USING THIS LINE OF CODE WE CAN ADD TO SHOW SOME MENU WHEN USER ARE LOGIN
        $menuItems = [['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Contact', 'url' => ['/site/datainfo']],
            /**
             * code is sed to create sub menus...
             */
            [
                'label' => 'Student', 
                'url' => ['/student/index'],
                'options' => ['class'=>'dropdown'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',
                'items' => [
                    ['label' => 'Update', 'url' => ['student/update']],
                ]
            ],
            /**
             * =======================
             */
            ['label' => 'Personal Info', 'url' => ['/user']],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);

    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>