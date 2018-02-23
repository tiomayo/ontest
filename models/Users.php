<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $level
 * @property int $id_jadwal
 *
 * @property Jadwal $jadwal 
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    const admin = 1;
    const peserta = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'nama', 'level'], 'required'],
            [['level', 'id_jadwal', 'step'], 'integer'],
            [['username', 'password'], 'string', 'max' => 255],
            [['nama'], 'string', 'max' => 100], 
            [['username'], 'unique'],
            [['username'], 'email'],
            [['password'], 'unique'],
            [['id_jadwal'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwal::className(), 'targetAttribute' => ['id_jadwal' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_jadwal' => 'Id Jadwal',
            'username' => 'E-mail',
            'nama' => 'Nama',
            'password' => 'Password',
            'level' => 'Level',
        ];
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getHasiltes() 
    { 
       return $this->hasMany(Hasiltes::className(), ['id_peserta' => 'id']); 
    } 

    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['id' => 'id_jadwal']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey = Yii::$app->security->generateRandomKey();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
