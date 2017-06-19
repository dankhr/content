<?php

//namespace console\controllers;
namespace app\commands;

use yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $client = $auth->createRole('client');
        
        // запишем их в БД
        $auth->add($admin);
        $auth->add($client);
        
        // Создаем разрешения
        $adminRole = $auth->createPermission('adminRole');
        $adminRole->description = 'Администратор';
        
        $clientRole = $auth->createPermission('clientRole');
        $clientRole->description = 'Клиент';
        
        // Запишем эти разрешения в БД
        $auth->add($adminRole);
        $auth->add($clientRole);
        
        // Теперь добавим наследования.
        $auth->addChild($admin,$adminRole);
        $auth->addChild($client, $clientRole);
        
        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1); 
        
        // Назначаем роль admin пользователю с ID 2
        $auth->assign($admin, 2);
    }
}