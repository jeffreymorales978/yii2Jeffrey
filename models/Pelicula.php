<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "pelicula".
 *
 * @property int $idpelicula
 * @property string|null $portada
 * @property string|null $titulo
 * @property string|null $sinopsis
 * @property int|null $año
 * @property string|null $duracion
 *
 * @property Actor[] $actorIdactors
 * @property DirectorHasPelicula[] $directorHasPeliculas
 * @property Director[] $directorIddirectors
 * @property PeliculaHasActor[] $peliculaHasActors
 */
class Pelicula extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelicula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['portada', 'titulo', 'sinopsis', 'año', 'duracion'], 'default', 'value' => null],
            [['año'], 'integer'],
            [['duracion'], 'safe'],
            [['portada', 'sinopsis'], 'string', 'max' => 255],
            [['titulo'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpelicula' => Yii::t('app', 'Idpelicula'),
            'portada' => Yii::t('app', 'Portada'),
            'titulo' => Yii::t('app', 'Titulo'),
            'sinopsis' => Yii::t('app', 'Sinopsis'),
            'año' => Yii::t('app', 'Año'),
            'duracion' => Yii::t('app', 'Duracion'),
        ];
    }

    public function upload(){
        if($this->validate()){
            if($this->isNewRecord){
                if(!$this->save(false)){
                    return false;
                }
            }
            if($this->imageFile instanceof UploadedFile){
                $filename = $this->idpelicula . '.' . $this->año . '_movie_' . date('Ymd_His') . '.' . $this->imageFile->extension;
                $path = Yii::getAlias('@webroot/portadas/') . $filename;
                
                if($this->imageFile->saveAs($path)){
                    if($this->portada && $this->portada !== $filename){
                        $this->deletePortada();
                    }

                    $this->portada = $filename;
                }
            }
            return $this->save(false);

        }
        return false;
    }

    public function deletePortada(){
      $path = Yii::getAlias('@webroot/portadas/') . $this->portada;
      if(file_exists($path)){
        unlink($path);
      }
    }

    /**
     * Gets query for [[ActorIdactors]].
     *
     * @return \yii\db\ActiveQuery|ActorQuery
     */
    public function getActorIdactors()
    {
        return $this->hasMany(Actor::class, ['idactor' => 'actor_idactor'])->viaTable('pelicula_has_actor', ['pelicula_idpelicula' => 'idpelicula']);
    }

    /**
     * Gets query for [[DirectorHasPeliculas]].
     *
     * @return \yii\db\ActiveQuery|DirectorHasPeliculaQuery
     */
    public function getDirectorHasPeliculas()
    {
        return $this->hasMany(DirectorHasPelicula::class, ['pelicula_idpelicula' => 'idpelicula']);
    }

    /**
     * Gets query for [[DirectorIddirectors]].
     *
     * @return \yii\db\ActiveQuery|DirectorQuery
     */
    public function getDirectorIddirectors()
    {
        return $this->hasMany(Director::class, ['iddirector' => 'director_iddirector'])->viaTable('director_has_pelicula', ['pelicula_idpelicula' => 'idpelicula']);
    }

    /**
     * Gets query for [[PeliculaHasActors]].
     *
     * @return \yii\db\ActiveQuery|PeliculaHasActorQuery
     */
    public function getPeliculaHasActors()
    {
        return $this->hasMany(PeliculaHasActor::class, ['pelicula_idpelicula' => 'idpelicula']);
    }

    /**
     * {@inheritdoc}
     * @return PeliculaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeliculaQuery(get_called_class());
    }

}
