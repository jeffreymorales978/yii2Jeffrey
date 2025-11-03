<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "director".
 *
 * @property int $iddirector
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string|null $fecha
 *
 * @property PeliculaHasDirector[] $peliculaHasDirectors
 */
class Director extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'director';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'fecha'], 'default', 'value' => null],
            [['nombre', 'apellido', 'fecha'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddirector' => Yii::t('app', 'Iddirector'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * Gets query for [[PeliculaHasDirectors]].
     *
     * @return \yii\db\ActiveQuery|PeliculaHasDirectorQuery
     */
    public function getPeliculaHasDirectors()
    {
        return $this->hasMany(PeliculaHasDirector::class, ['fk_iddirector' => 'iddirector']);
    }

    /**
     * {@inheritdoc}
     * @return DirectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DirectorQuery(get_called_class());
    }

}
