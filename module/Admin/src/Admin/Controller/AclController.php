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

class AclController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Quyền';
        $this->module       = 'acl';
        $this->modelClass   = 'Application\Model\Acl';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\Acl';
    }

    public function indexAction()
    {
        $this->init();

        $records = $this->model->getAcls();

        $this->view->setVariables([
            'records' => $records,
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

    public function save($id = null)
    {
        $paramPosts = $this->params()->fromPost();

        $dataSave = [];
        $dataSave['acl_module']      = $paramPosts['acl_module'];
        $dataSave['acl_controller']  = $paramPosts['acl_controller'];
        $dataSave['acl_action']      = $paramPosts['acl_action'];
        $dataSave['acl_status']      = $paramPosts['acl_status'];
        $dataSave['acl_name']        = $paramPosts['acl_name'];
        $dataSave['acl_parent']      = $paramPosts['acl_parent'];

        $this->model->savePrimary($dataSave, $id);
    }

    public function setFormSelectOptions()
    {
        $aclRoot = $this->model->getAcls();
        $optionsAclRoot = array(0 => '--- Gốc ---');
        foreach ($aclRoot as $k => $v) {
            $optionsAclRoot[$v['acl_id']] = str_repeat('__', $v['acl_level']) . ' ' . $v['acl_name'];
        }

        $this->form->get('acl_parent')->setOptions(array('value_options' => $optionsAclRoot));
        $this->form->get('acl_status')->setOptions(array('value_options' => $this->status));
    }
}
