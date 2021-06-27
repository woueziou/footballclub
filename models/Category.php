<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $label
 * @property string|null $description
 *
 * @property Payment[] $payments
 * @property Usercategory[] $usercategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['category' => 'id']);
    }

    /**
     * Gets query for [[Usercategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsercategories()
    {
        return $this->hasMany(Usercategory::className(), ['CATEGORY' => 'id']);
    }
}
