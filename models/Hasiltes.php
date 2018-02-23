<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hasiltes".
 *
 * @property int $id
 * @property int $id_peserta
 * @property int $id_jadwal
 * @property int $id_soal
 * @property string $jawaban_peserta
 *
 * @property Jadwal $jadwal
 * @property Users $peserta
 * @property Soal $soal
 */
class Hasiltes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hasiltes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_peserta', 'id_jadwal', 'id_soal'], 'required'],
            [['id_peserta', 'id_jadwal', 'id_soal'], 'integer'],
            [['jawaban_peserta'], 'string'],
            [['id_jadwal'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwal::className(), 'targetAttribute' => ['id_jadwal' => 'id']],
            [['id_peserta'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_peserta' => 'id']],
            [['id_soal'], 'exist', 'skipOnError' => true, 'targetClass' => Soal::className(), 'targetAttribute' => ['id_soal' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_peserta' => 'Id Peserta',
            'id_jadwal' => 'Id Jadwal',
            'id_soal' => 'Id Soal',
            'jawaban_peserta' => 'Jawaban Peserta',
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
    public function getPeserta()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_peserta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoal()
    {
        return $this->hasOne(Soal::className(), ['id' => 'id_soal']);
    }
}
