<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_tes".
 *
 * @property int $id_jadwal
 * @property int $id_soal
 * @property int $id_user
 * @property int $jawaban_user
 *
 * @property Jadwal $jadwal
 * @property Soal $soal
 * @property Users $user
 */
class DetailTes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_tes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jadwal', 'id_soal', 'id_user'], 'required'],
            [['id_jadwal', 'id_soal', 'id_user', 'jawaban_user'], 'integer'],
            [['id_jadwal'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwal::className(), 'targetAttribute' => ['id_jadwal' => 'id']],
            [['id_soal'], 'exist', 'skipOnError' => true, 'targetClass' => Soal::className(), 'targetAttribute' => ['id_soal' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jadwal' => 'Id Jadwal',
            'id_soal' => 'Id Soal',
            'id_user' => 'Id User',
            'jawaban_user' => 'Jawaban User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['id' => 'id_jadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoal()
    {
        return $this->hasOne(Soal::className(), ['id' => 'id_soal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
