<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'General Settings';
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Settings</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= Url::to(['default/dashboard']) ?>">Home</a>
            </li>
            <li class="active">
                <strong>General Settings</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Referral System Configuration</h5>
                </div>
                <div class="ibox-content">
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?= Url::to(['settings/index']) ?>" class="form-horizontal">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Referral Bonus (Amount)</label>
                            <div class="col-sm-10">
                                <input type="number" step="0.01" name="referral_bonus" class="form-control" value="<?= Html::encode($referralBonus) ?>" required>
                                <span class="help-block m-b-none">Amount credited to the referrer when a referred user makes their first booking.</span>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
