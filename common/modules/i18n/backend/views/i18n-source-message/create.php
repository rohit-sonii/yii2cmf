<?php
/* @var $this yii\web\View */
/* @var $model common\modules\i18n\models\I18nSourceMessage */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'I18n Source Message',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'I18n Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-source-message-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
