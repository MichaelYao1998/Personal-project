<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $customer_id
 * @property double $total_price
 * @property string $created
 * @property string $modified
 * @property string $status
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'total_price', 'created', 'modified'], 'required'],
            [['customer_id'], 'integer'],
            [['total_price'], 'number'],
            [['created', 'modified'], 'safe'],
            [['status'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'total_price' => 'Total Price',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
        ];
    }
}
