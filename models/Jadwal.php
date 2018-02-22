<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jadwal".
 *
 * @property int $id
 * @property string $waktu_tes
 * @property string $waktu_selesai
 * @property string $instruksi
 *
 * @property Users[] $users
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waktu_tes', 'waktu_selesai', 'instruksi'], 'required'],
            [['waktu_tes', 'waktu_selesai'], 'safe'],
            [['waktu_tes', 'waktu_selesai'], 'unique'],
            [['instruksi'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'waktu_tes' => 'Waktu Tes',
            'waktu_selesai' => 'Waktu Selesai',
            'instruksi' => 'Instruksi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id_jadwal' => 'id']);
    }

    public function getDurasi($waktu_tes, $waktu_selesai)
    {
        $diff = abs(strtotime($waktu_tes) - strtotime($waktu_selesai));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ (60));

        return $hours." jam, ".$minutes." menit";
    }

    public function getJumlahPeserta($id)
    {
        return Users::find()->where(['id_jadwal' => $this->id ])->count();
    }

    public function getJumlahSoal($id)
    {
        return Soal::find()->where(['id_jadwal' => $this->id ])->count();
    }
}
