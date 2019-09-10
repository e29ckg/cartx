<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    $directoryAsset = Url::to('@web/adminlte');
?>
    <?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?=Url::to('@web/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?=Url::to('@web/adminlte/dist/css/AdminLTE.min.css')?>" rel="stylesheet">
        <link rel="stylesheet" href="<?=Url::to('@web/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?=Url::to('@web/adminlte/plugins/pace/pace.css');?>">
        <link rel="stylesheet" href="<?=Url::to('@web/adminlte/bower_components/Ionicons/css/ionicons.min.css');?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=Url::to('@web/adminlte/plugins/DataTables/css/datatables.min.css')?>">
        <link rel="stylesheet" href="<?=Url::to('@web/adminlte/dist/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?=Url::to('@web/adminlte/dist/css/skins/_all-skins.min.css');?>">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	    <?php $this->head() ?>
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    </head>   

    <body class="hold-transition sidebar-mini <?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>
    <?php
		Modal::begin([
  			'id' => 'activity-modal',
   			'header' => '<h4 class="modal-title"></h4>',
               'size' => 'modal-lg',
               'options' => ['tabindex' => ''],
   			// 'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
		]);
		echo "<div id='modalContent'></div>";
		Modal::end();
	?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    <!-- jQuery 3 -->
<script src="<?=Url::to('@web/js/jquery.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=Url::to('@web/js/bootstrap.js')?>"></script>
<script src="<?=Url::to('@web/adminlte/plugins/DataTables/js/datatables.min.js')?>"></script>
<!-- SlimScroll -->
<script src="<?=Url::to('@web/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?=Url::to('@web/adminlte/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=Url::to('@web/adminlte/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=Url::to('@web/adminlte/dist/js/demo.js')?>"></script>


<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

     </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>

