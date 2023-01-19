<?php
use yii\bootstrap4\Html;


/** @var yii\web\View $this */

$this->title = 'CURD Operation Form';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">YII2 CURD Operation</h1>

        </div>
    </div>
    <!-- <?php //echo "<pre>".print_r($queryData)."</pre>"; ?> -->

    
    <div class="body-content">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if(($queryData) > 0): ?>
                    <?php foreach($queryData as $query): ?>
                        <tr>
                            <th scope="row"><?php echo $query['id']; ?></th>
                            <td><?php echo $query['name']; ?>
                            <!--USING THIS WE CALL THE VALUE COME FROM THE DATABASE 
                        AND SHOW IT IN THE FRONT PAGE ON YII2--></td>
                            <td><?php echo $query['email']; ?></td>
                            <td><?php echo $query['phone']; ?></td>
                            <td><?php echo $query['address']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td>No Records Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
