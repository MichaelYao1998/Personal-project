<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $created
 * @property string $modified
 * @property string $status
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'created', 'modified'], 'required'],
            [['description', 'status'], 'string'],
            [['price'], 'number'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
        ];
    }
}
