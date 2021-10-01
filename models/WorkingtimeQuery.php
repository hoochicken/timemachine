<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Workingtime]].
 *
 * @see Workingtime
 */
class WorkingtimeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Workingtime[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Workingtime|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
