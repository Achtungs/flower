<?php

namespace app\models;

use app\models\User;

class RegForm extends User
{
public $password_repeat;
public $agree;
public function rules()
{
    return [
        [['name', 'surname', 'password', 'password_repeat', 'agree', 'login'], 'required'],
        [['name'], 'match', 'pattern'=>'/^[А-ЯЁа-яё\s\-]{1,}$/u', 'message'=>'Используйте минимум 1 русскую букву, пробел или тире'],
        [['surname'], 'match', 'pattern'=>'/^[А-ЯЁа-яё\s\-]{1,}$/u', 'message'=>'Используйте минимум 1 русскую букву, пробел или тире'],
        [['patronymic'], 'match', 'pattern'=>'/^[А-ЯЁа-яё\s\-]{1,}$/u', 'message'=>'Используйте минимум 1 русскую букву, пробел или тире'],
        [['login'], 'match', 'pattern'=>'/^[A-Za-z0-9\-]{6,}$/u', 'message'=>'Используйте минимум 6 латинских букв, цифры или тире'],
        [['email'], 'email'],
        [['email'], 'unique'],
        [['password'], 'match', 'pattern'=>'/^[A-Za-z0-9]{5,}/', 'message'=>'Используйте минимум 5 латинских букв и цифр'],
        [['password_repeat'], 'compare', 'compareAttribute'=>'password'],
        [['agree'], 'compare', 'compareValue'=>true, 'message'=>''],
        [['agree'], 'boolean'],
        [['name', 'surname', 'email', 'password', 'password_repeat', 'patronymic', 'login'], 'string', 'max' => 255],
    ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
    {
return [
    'id_user' => 'ID',
    'name' => 'Имя',
    'surname' => 'Фамилия',
    'patronymic' => 'Отчество',
    'login' => 'Логин',
    'email' => 'Email',
    'password' => 'Пароль',
    'password_repeat' => 'Повторите пароль',
    'agree' => 'Подтвердите согласие на обработку персональных данных',
       ];
    }
}