<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Administrator]].
 *
 * @see Administrator
 */
class AdministratorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Administrator[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Administrator|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
