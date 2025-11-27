<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Director;

/**
 * DirectorSearch represents the model behind the search form of `app\models\Director`.
 */
class DirectorSearch extends Director
{
    public $fecha; // Añadimos la propiedad 'fecha' a la clase DirectorSearch

    /**
     * {@inheritdoc}
     */
    public function rules()
{
    return [
        [['iddirector'], 'integer'],
        [['nombre', 'apellido', 'fecha_nacimiento'], 'safe'], // Usamos 'fecha_nacimiento' aquí
    ];
}


    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Director::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'iddirector' => $this->iddirector,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'fecha', $this->fecha]); // Asegúrate de que 'fecha' sea accesible

        return $dataProvider;
    }

    /**
     * Getter para la propiedad 'fecha'.
     *
     * @return string
     */
    public function getFecha()
    {
        // Aquí puedes definir la lógica para obtener el valor de 'fecha'.
        // Por ejemplo, si 'fecha' es un campo de la base de datos, podrías retornarlo directamente.
        // Si es un valor calculado, retorna el valor correspondiente.

        // Ejemplo:
        // return $this->fecha_nacimiento; // Si 'fecha' es una propiedad de 'Director' o un campo de base de datos

        return parent::getFecha(); // Si 'fecha' es un campo de 'Director'
    }
}
