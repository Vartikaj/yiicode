<?php

/**
 * Html provides a set of static methods for generating commonly used HTML tags
 */
use yii\helpers\Html;

$this->title = 'Personal information';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>