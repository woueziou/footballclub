<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int|null $motif
 * @property int|null $period
 * @property int|null $user
 * @property int|null $category
 * @property int|null $status
 * @property number|null $amountvalue
 *
 * @property Amountpaid[] $amountpas
 * @property Category $category0
 * @property Motif $motif0
 * @property Period $period0
 * @property User $user0
 */
class UserPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motif', 'period', 'user', 'category', 'status'], 'integer'],
            [['amountvalue'], 'number'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
            [['motif'], 'exist', 'skipOnError' => true, 'targetClass' => Motif::className(), 'targetAttribute' => ['motif' => 'id']],
            [['period'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'motif' => 'Motif',
            'period' => 'Period',
            'user' => 'User',
            'category' => 'Category',
            'status' => 'Status',
            'amountvalue' => 'Amount value',
        ];
    }

    /**
     * Gets query for [[Amountpas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAmountpas()
    {
        return $this->hasMany(Amountpaid::className(), ['PAYMENT' => 'id']);
    }

    /**
     * Gets query for [[Category0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * Gets query for [[Motif0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotif0()
    {
        return $this->hasOne(Motif::className(), ['id' => 'motif']);
    }

    /**
     * Gets query for [[Period0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod0()
    {
        return $this->hasOne(Period::className(), ['id' => 'period']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}
