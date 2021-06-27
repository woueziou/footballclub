<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "amountpaid".
 *
 * @property int $id
 * @property float|null $value
 * @property float|null $tax
 * @property string $create_at
 * @property string|null $update_at
 * @property int $PAYMENT
 * @property int $USER
 *
 * @property Payment $pAYMENT
 * @property User $uSER
 */
class Amount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amountpaid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'tax'], 'number'],
            [['create_at', 'PAYMENT', 'USER'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['PAYMENT', 'USER'], 'integer'],
            [['PAYMENT'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::className(), 'targetAttribute' => ['PAYMENT' => 'id']],
            [['USER'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USER' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'tax' => 'Tax',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'PAYMENT' => 'Payment',
            'USER' => 'User',
        ];
    }

    /**
     * Gets query for [[PAYMENT]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPAYMENT()
    {
        return $this->hasOne(Payment::className(), ['id' => 'PAYMENT']);
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

    public function  getAmountDue(){
        // Obtain orders from customers
        $cnUser = \Yii::$app->user->id;
        $amountdues = Amount::findAll(
            ['USER'=>$cnUser,
                'status'=> 0,
            ]
        );
        return $amountdues;
    }

    public function  getAmountDuePayment(){

                $cnUser = \Yii::$app->user->id;

        $data = Amount::find()
            ->select('amountpaid.id, motif.label as mlabel, period.label as plabel, category.label as clabel, amountpaid.value, amountpaid.tax, amountpaid.create_at, amountpaid.status')
            ->innerJoin('payment', 'amountpaid.PAYMENT = payment.id')
            ->innerJoin('period', 'period.id = payment.period')
            ->innerJoin('category', 'category.id = payment.category')
            ->innerJoin('motif', ' payment.motif = motif.id')
            ->where(['amountpaid.USER' => $cnUser,
                'amountpaid.status'=>0,])
            ->asArray()
            ->all();

        return $data;
    }

    public function getTotalAmountTax($TabAmount){

        $total = 0;

        if (count($TabAmount) >0)
        {
            foreach ($TabAmount as $am)
            {
                $total = $total + $am->value + $am->tax ;
            }
        }

        return $total ;

    }

    public function  getAllAmountDue(){
        // Obtain orders from customers
        $amountdues = Amount::findAll(
            [
                'status'=> 0,
            ]
        );
        return $amountdues;
    }

    public function  getAmountPaid(){

        $cnUser = \Yii::$app->user->id;
        $amountdues = Amount::findAll(
            ['USER'=>$cnUser,
                'status'=> 1,
            ]
        );
        return $amountdues;
    }

    public function  getAllAmountPaid(){

        $amountdues = Amount::findAll(
            [
                'status'=> 1,
            ]
        );
        return $amountdues;
    }
}
