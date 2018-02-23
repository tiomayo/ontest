<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soal".
 *
 * @property int $id
 * @property int $id_jadwal
 * @property string $soal
 * @property string $pilihan_A
 * @property string $pilihan_B
 * @property string $pilihan_C
 * @property string $pilihan_D
 * @property string $kunci_jawaban
 *
 * @property Jadwal $jadwal
 */
class Soal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soal';
    }

    public function checkSoal ($attribute,$params)
    {
        $record = Soal::find()->where(['id_jadwal'=>$this->id_jadwal])->andWhere(['soal'=>$this->soal])->one();

        if($record) {
            $this->addError($attribute, 'Soal sudah dipakai');
        }

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jadwal', 'soal', 'pilihan_A', 'pilihan_B', 'pilihan_C', 'pilihan_D', 'kunci_jawaban'], 'required'],
            [['id_jadwal'], 'integer'],
            [['pilihan_A', 'pilihan_B', 'pilihan_C', 'pilihan_D', 'kunci_jawaban'], 'string'],
            [['soal'], 'string', 'max' => 300],
            [['soal'], 'checkSoal', 'on' => 'create', 'message'=> ''],
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
            'soal' => 'Soal',
            'pilihan_A' => 'Pilihan  A',
            'pilihan_B' => 'Pilihan  B',
            'pilihan_C' => 'Pilihan  C',
            'pilihan_D' => 'Pilihan  D',
            'kunci_jawaban' => 'Kunci Jawaban',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['id' => 'id_jadwal']);
    }
}
