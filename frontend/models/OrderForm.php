<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class OrderForm extends Model
{
    public $customer_fio;
    public $customer_phone;
    public $good;
    public $comments;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_fio', 'customer_phone', 'good'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_fio' => 'Имя клиента',
            'customer_phone' => 'Телефон',
            'good' => 'Товар',
            'comments' => 'Комментарий',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
