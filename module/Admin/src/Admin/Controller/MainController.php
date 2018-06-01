<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class MainController extends AbstractActionController
{
    protected $module;

    protected $moduleName;
    protected $modelClass;
    protected $model;

    protected $view;

    protected $form;
    protected $formClass;

    protected $msg;
    protected $msgSuccess;
    protected $msgError;

    public function onDispatch(MvcEvent $e)
    {
        $auth = new AuthenticationService();

        if (!$auth->hasIdentity()) {
            $this->redirect()->toRoute('admin/default', array('controller' => 'login', 'action' => 'index'));
        } else {
            $this->user = $auth->getIdentity();
        }

        $this->checkPermission();

        $this->layout('layout/admin');

        $groupMenuModel = $e->getApplication()->getServiceManager()->get('Model')->getModel('Application\Model\GroupMenu');
        $menu = $groupMenuModel->getGroupMenu($this->user->group_account_id);

        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->user = $this->user;
        $viewModel->menu = $menu;

        return parent::onDispatch($e);
    }

    public function init()
    {
        $this->msg = [
            'addSuccess' => 'Thêm mới thành công',
            'editSuccess' => 'Cập nhật thành công',
            'delSuccess' => 'Xóa thành công',
        ];

        if ($this->flashMessenger()->hasMessages('msgSuccess')) {
            $messages = $this->flashMessenger()->getMessages('msgSuccess');
            $this->msgSuccess = $messages[0];
        }

        if ($this->flashMessenger()->hasMessages('msgError')) {
            $messages = $this->flashMessenger()->getMessages('msgError');
            $this->msgError = $messages[0];
        }

        if ($this->modelClass) {
            $this->model = $this->getServiceLocator()->get('Model')->getModel($this->modelClass);
        }

        if ($this->formClass) {
            $this->form = new $this->formClass();
            $this->form->init($this->getServiceLocator());
        }

        $this->view = new ViewModel();

        $this->view->setVariables([
            'module' => $this->module,
            'moduleName' => $this->moduleName
        ]);
    }

    public function checkPermission()
    {
        $auth = new AuthenticationService();
        $acl = new Acl();
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        if ($auth->hasIdentity()) {
            $controllerArr = explode('\\', $this->params()->fromRoute('controller'));
            $controller = strtolower($controllerArr[2]);
            $module = strtolower($controllerArr[0]);
            $action = $this->params()->fromRoute('action');
            $user = $auth->getIdentity();

            $groupUserModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupAccount');
            $groupAclModel  = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupAcl');


            $groups = $groupUserModel->fetchAll();
            $dataGroups = [];
            foreach ($groups as $v) {
                $dataGroups[] = $v;
            }
            $groups = $dataGroups;


            foreach ($groups as $group) {
                $acl->addRole(new Role($group['group_account_id']));
            }

            //Add Resouces
            $resources = $groupAclModel->fetchWhere([
                'JOIN' => 'LEFT JOIN acl ON acl.acl_id = group_acl.acl_id',
                'WHERE' => 'group_account_id = ' . $user->group_account_id . ' AND acl.acl_module = "admin" AND group_acl_status = 1',
                'GROUP' => 'acl.acl_controller',
            ]);

            $dataResources = [];
            foreach ($resources as $v) {
                $dataResources[] = $v;
            }
            $resources = $dataResources;

            foreach ($resources as $resource) {
                $acl->addResource(new Resource($resource['acl_controller']));
            }

            //Add Permission Allow
            $permissionAllows = $groupAclModel->fetchWhere([
                'JOIN' => 'LEFT JOIN acl ON acl.acl_id = group_acl.acl_id',
                'WHERE' => 'group_account_id = ' . $user->group_account_id . ' AND acl.acl_module = "admin" AND group_acl_status = 1',
            ]);

            $dataPermissionAllows = [];
            foreach ($permissionAllows as $v) {
                $dataPermissionAllows[] = $v;
            }
            $permissionAllows = $dataPermissionAllows;

            foreach ($permissionAllows as $permission) {
                $acl->allow($permission['group_account_id'], $permission['acl_controller'], $permission['acl_action']);
            }

            $allow = false;
            if ($acl->hasResource($controller)) {
                if ($acl->isAllowed($user->group_account_id, $controller, $action)) {
                    $allow = true;
                }
            }

            if (!$allow) {
                $this->redirect()->toRoute('admin/default', ['controller' => 'index', 'action' => 'index']);
                return;
            }
        }
    }
}
