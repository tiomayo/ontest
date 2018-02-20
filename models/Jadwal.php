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
 * @property DetailTes[] $detailTes
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
    public function getDetailTes()
    {
        return $this->hasMany(DetailTes::className(), ['id_jadwal' => 'id']);
    }
}
