<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Settings;

class SettingsController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $bonus = Yii::$app->request->post('referral_bonus');
            $setting = Settings::findOne(['key_name' => 'referral_bonus']);
            if (!$setting) {
                $setting = new Settings();
                $setting->key_name = 'referral_bonus';
            }
            $setting->value = (string)$bonus;
            if ($setting->save()) {
                Yii::$app->session->setFlash('success', 'Settings saved successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to save settings.');
            }
        }

        $referralBonus = Settings::getReferralBonus();

        return $this->render('index', [
            'referralBonus' => $referralBonus,
        ]);
    }
}
