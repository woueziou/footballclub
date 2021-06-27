<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $othername
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $username
 * @property string|null $password
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property int $status
 * @property int|null $ROLE
 * @property int|null $CATEGORY
 *
 * @property Payment[] $payments
 * @property Role $rOLE
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ROLE','CATEGORY'], 'integer'],
            [['code', 'phone'], 'string', 'max' => 45],
            [['name', 'othername', 'email', 'address'], 'string', 'max' => 145],
            [['username'], 'string', 'max' => 55],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_DELETED],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['ROLE'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['ROLE' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'othername' => 'Othername',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'status' => 'User Status',
            'ROLE' => 'User Role',
            'CATEGORY' => 'User Category',
        ];
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[ROLE]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getROLE()
    {
        return $this->hasOne(Role::className(), ['id' => 'ROLE']);
    }

    public function getUserRole()
    {
        $uRole = User::findOne('user.ROLE')
            ->where(['id'=>Yii::$app->user->id,])
            ;

        return $role = $uRole->ROLE;


    }

    public function  getPaymentsFromUser($id)
    {
        if (!($id == null))
        {
            $auser = User::findOne($id);
            $payments = $auser->payments;
        }
        else
        {
            $payments = \Yii::$app->user->identity->getId()-> payments;
        }

        return $payments ;
    }

    public function CountInactiveUsers()
    {
        $count = User::find()
            ->where(['status' => User::STATUS_DELETED,])
            ->count();

        return $count;
    }

    public function GetInactiveUsers()
    {
        $iusers = User::findAll([
            'status' => User::STATUS_DELETED,
        ]);

        return $iusers;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }



}
