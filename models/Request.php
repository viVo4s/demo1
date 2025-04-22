<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int $starus_id
 * @property string $number
 * @property string $text
 *
 * @property Status $starus
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'text'], 'required'],
            [['starus_id'], 'integer'],
            [['text'], 'string'],
            ['user_id', 'default', 'value' => Yii::$app->user->identity->getId()],
            ['starus_id', 'default', 'value' => 1],
            [['number'], 'string', 'max' => 100],
            [['starus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['starus_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'number' => 'Гос номер',
            'text' => 'Описание нарушения',
            'starus_id' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Starus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStarus()
    {
        return $this->hasOne(Status::class, ['id' => 'starus_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
