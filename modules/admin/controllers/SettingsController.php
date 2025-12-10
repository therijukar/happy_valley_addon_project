<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Settings;

class SettingsController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'admin';
        
        if (Yii::$app->request->isPost) {
            $value = Yii::$app->request->post('referral_bonus');
            $setting = Settings::findOne(['key_name' => 'referral_bonus']);
            if (!$setting) {
                $setting = new Settings();
                $setting->key_name = 'referral_bonus';
            }
            $setting->value = $value;
            if ($setting->save()) {
                Yii::$app->session->setFlash('success', 'Settings updated successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update settings.');
            }
            return $this->refresh();
        }

        $referralBonus = Settings::findOne(['key_name' => 'referral_bonus']);
        $referralBonusValue = $referralBonus ? $referralBonus->value : 0;

        return $this->render('index', [
            'referralBonus' => $referralBonusValue,
        ]);
    }
}
