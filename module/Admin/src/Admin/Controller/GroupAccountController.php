<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GroupAccountController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Nhóm quản trị';
        $this->module       = 'group-account';
        $this->modelClass   = 'Application\Model\GroupAccount';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\GroupAccount';
    }

    public function indexAction()
    {
        $this->init();

        $page = $this->params()->fromQuery('page', 1);

        $result = $this->model->fetchPage([
            'page' => $page,
            'pageItemPerCount' => 20,
        ]);

        $this->view->setVariables([
            'records' => $result['data'],
            'paging' => $result['paging'],
            'status' => $this->status,
            'msgSuccess' => $this->msgSuccess,
        ]);

        return $this->view;
    }

    public function addAction()
    {
        $this->init();

        $request = $this->getRequest();

        if ($request->isPost()) {

            $dataPost = $request->getPost();
            $this->form->setData($dataPost);

            if ($this->form->isValid()) {

                $this->save();

                $this->flashMessenger()->addMessage($this->msg['addSuccess'], 'msgSuccess');
                $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'add']);

            } else {
                $this->msgError = current(current($this->form->getMessages()));
            }
        }

        $this->setFormSelectOptions();

        $this->view->setVariables([
            'form' => $this->form,
            'msgSuccess' => $this->msgSuccess,
            'msgError' => $this->msgError
        ]);

        $this->view->setTemplate('admin/' . $this->module . '/form.phtml');

        return $this->view;
    }

    public function editAction()
    {
        $this->init();

        $id = $this->params()->fromQuery('id');
        $record = $this->model->fetchPrimary($id);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $dataPost = $request->getPost();
            $this->form->setData($dataPost);

            if ($this->form->isValid()) {

                $this->save($id);

                $this->flashMessenger()->addMessage($this->msg['editSuccess'], 'msgSuccess');
                $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'edit'], ['query' => ['id' => $id]]);

            } else {
                $this->msgError = current(current($this->form->getMessages()));
            }
        }

        $this->setFormSelectOptions();

        $this->form->get('frmSubmit')->setAttributes(array('value' => 'Cập nhật'));
        $this->form->setData($record);

        $this->view->setVariables([
            'record' => $record,
            'form' => $this->form,
            'msgSuccess' => $this->msgSuccess,
            'msgError' => $this->msgError
        ]);

        $this->view->setTemplate('admin/' . $this->module . '/form.phtml');

        return $this->view;
    }

    public function deleteAction()
    {
        $this->init();

        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost('check_item');
        } else {
            $id[] = $this->params()->fromQuery('id');
        }

        if (is_array($id)) {
            foreach($id as $k => $v) {
                $this->model->deletePrimary($v);
            }
        }

        $this->flashMessenger()->addMessage($this->msg['delSuccess'], 'msgSuccess');
        $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'index']);

        return $this->response();
    }

    public function aclAction()
    {
        $this->init();

        $menuModel  = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Menu');
        $groupMenuModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupMenu');

        $aclModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Acl');
        $groupAclModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupAcl');

        $id = $this->params()->fromQuery('id');

        if ($this->getRequest()->isPost()) {
            $menus = $this->params()->fromPost('menu');
            $acls = $this->params()->fromPost('acl');

            $groupMenuModel->saveWhere(['group_menu_status' => 0], ['group_account_id' => $id]);
            foreach($menus as $k => $v) {

                $checkExist = $groupMenuModel->fetchWhere([
                    'JOIN' => 'LEFT JOIN menu ON menu.menu_id = group_menu.menu_id',
                    'WHERE' => 'group_account_id = ' . $id . ' AND group_menu.menu_id = ' . $k,
                ]);

                if (count($checkExist) > 0) {
                    $groupMenuModel->saveWhere(['group_menu_status' => $v], ['group_account_id' => $id, 'menu_id' => $k]);
                } else {
                    $groupMenuModel->savePrimary(['group_account_id' => $id, 'menu_id' => $k, 'group_menu_status' => $v]);
                }
            }

            $groupAclModel->saveWhere(['group_acl_status' => 0], ['group_account_id' => $id]);
            foreach($acls as $k => $v) {

                $checkExist = $groupAclModel->fetchWhere([
                    'JOIN' => 'LEFT JOIN acl ON acl.acl_id = group_acl.acl_id',
                    'WHERE' => 'group_account_id = ' . $id . ' AND group_acl.acl_id = ' . $k,
                ]);

                if (count($checkExist) > 0) {
                    $groupAclModel->saveWhere(['group_acl_status' => $v], ['group_account_id' => $id, 'acl_id' => $k]);
                } else {
                    $groupAclModel->savePrimary(['group_account_id' => $id, 'acl_id' => $k, 'group_acl_status' => $v]);
                }
            }

            $this->flashMessenger()->addMessage($this->msg['editSuccess'], 'msgSuccess');
            $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'acl'], ['query' => ['id' => $id]]);
        }

        $groupMenuResults = $groupMenuModel->getGroupMenu($id);
        $groupMenus = [];
        foreach($groupMenuResults as $v) {
            $groupMenus[$v['menu_id']] = $v;
        }

        $menus = $menuModel->getMenus();

        $groupAclResults = $groupAclModel->fetchWhere([
            'WHERE' => 'group_account_id = ' . $id . ' AND group_acl_status = 1',
        ]);

        $groupAcls = [];
        foreach($groupAclResults as $v) {
            $groupAcls[$v['acl_id']] = $v;
        }

        $acls = $aclModel->getAcls();

        $groupInfo = $this->model->fetchPrimary($id);

        $this->view->setVariables([
            'groupMenus'    => $groupMenus,
            'menus'         => $menus,
            'groupAcls'     => $groupAcls,
            'acls'          => $acls,
            'groupInfo'     => $groupInfo,
            'module'        => $this->module,
            'status'        => $this->status,
            'form'          => $this->form,
            'msgSuccess'    => $this->msgSuccess,
            'msgError'      => $this->msgError
        ]);

        $this->form->get('frmSubmit')->setAttributes(array('value' => 'Cập nhật'));

        return $this->view;
    }

    public function save($id = null)
    {
        $paramPosts = $this->params()->fromPost();

        $dataSave = [];
        $dataSave['group_account_name']      = $paramPosts['group_account_name'];
        $dataSave['group_account_status']    = $paramPosts['group_account_status'];

        $this->model->savePrimary($dataSave, $id);
    }

    public function setFormSelectOptions()
    {
        $this->form->get('group_account_status')->setOptions(array('value_options' => $this->status));
    }
}
