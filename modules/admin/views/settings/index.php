<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'General Settings';
?>

<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                </div>
                <h2 class="panel-title">General Settings</h2>
            </header>
            <div class="panel-body">
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="" class="form-horizontal form-bordered">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="referral_bonus">Referral Bonus Amount (INR)</label>
                        <div class="col-md-6">
                            <input type="number" step="0.01" class="form-control" id="referral_bonus" name="referral_bonus" value="<?= $referralBonus ?>" required>
                            <span class="help-block">Amount to credit to the referrer's wallet when the referred user makes their first booking.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
