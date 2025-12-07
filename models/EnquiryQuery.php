<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Enquiry]].
 *
 * @see Enquiry
 */
class EnquiryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Enquiry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Enquiry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
