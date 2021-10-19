<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Incoming]].
 *
 * @see Incoming
 */
class IncomingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Incoming[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Incoming|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
