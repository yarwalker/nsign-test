<?php
/**
 * Created by PhpStorm.
 * User: avs
 * Date: 31.03.17
 * Time: 9:37
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {
    public function actionInit() {
        $auth = Yii::$app->authManager;

        // удалим старые роли из БД
        $auth->removeAll();

        // создадим роли админа и менеджера
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';

        // запишем их в БД
        $auth->add($admin);
        $auth->add($manager);

        // разрешение просмотра админки
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        // разрешение просмотра списка пользователей
        $viewUsersPage = $auth->createPermission('viewUsersPage');
        $viewUsersPage->description = 'Просмотр списка пользователей';

        // разрешение редактирования пользователей
        $editUserPermition = $auth->createPermission('editUserPermition');
        $editUserPermition->description = 'Редактирование пользователей';

        // разрешение просмотра заявок
        $viewOrderPage = $auth->createPermission('viewOrderPage');
        $viewOrderPage->description = 'Просмотр списка заявок';

        // разрешение редактирования заявок
        $editOrderPermition = $auth->createPermission('editOrderPermition');
        $editOrderPermition->description = 'Редактирование заявок';

        // запишем разрешения в базу
        $auth->add($viewAdminPage);
        $auth->add($viewUsersPage);
        $auth->add($editUserPermition);
        $auth->add($viewOrderPage);
        $auth->add($editOrderPermition);

        $auth->addChild($manager, $viewAdminPage);
        $auth->addChild($manager, $viewUsersPage);
        $auth->addChild($manager, $editOrderPermition);

        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $editUserPermition);

        // назначем роли
        $auth->assign($admin, 1);
        $auth->assign($manager, 2);
    }
}