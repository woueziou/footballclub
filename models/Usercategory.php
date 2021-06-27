<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usercategory".
 *
 * @property int $id
 * @property int $USER
 * @property int $CATEGORY
 *
 * @property User $uSER
 * @property Category $cATEGORY
 */
class Usercategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usercategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER', 'CATEGORY'], 'required'],
            [['USER', 'CATEGORY'], 'integer'],
            [['USER'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USER' => 'id']],
            [['CATEGORY'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CATEGORY' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'USER' => 'User',
            'CATEGORY' => 'Category',
        ];
    }

    /**
     * Gets query for [[USER]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(User::className(), ['id' => 'USER']);
    }

    /**
     * Gets query for [[CATEGORY]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORY()
    {
        return $this->hasOne(Category::className(), ['id' => 'CATEGORY']);
    }
}
