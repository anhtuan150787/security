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

class AccountController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Tài khoản quản trị';
        $this->module       = 'account';
        $this->modelClass   = 'Application\Model\Account';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\Account';
        $this->uploadPath   = 'public/pictures/users';
    }

    public function indexAction()
    {
        $this->init();

        $page = $this->params()->fromQuery('page', 1);

        $result = $this->model->fetchPage([
            'JOIN' => 'LEFT JOIN group_account ON account.group_account_id = group_account.group_account_id',
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

            $this->form->getInputFilter()->get('account_username')->setRequired(false);
            $this->form->getInputFilter()->get('account_password')->setRequired(false);

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

                $record = $this->model->fetchPrimary($v);

                unlink($this->uploadPath . '/' . $record['account_picture']);

                $this->model->deletePrimary($v);
            }
        }

        $this->flashMessenger()->addMessage($this->msg['delSuccess'], 'msgSuccess');
        $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'index']);

        return $this->response();
    }

    public function save($id = null)
    {
        $encrypt        = $this->getServiceLocator()->get('Encrypt');
        $paramPosts     = $this->params()->fromPost();

        $dataSave = [];

        $pictureUploadName = $this->uploadImage();
        if ($pictureUploadName != '') {
            $dataSave['account_picture'] = $pictureUploadName;
        }

        if ($paramPosts['account_password'] != '') {
            $saltHash = $encrypt->HashSalt($paramPosts['account_password']);
            $newPasswordHash = $encrypt->HashPass($paramPosts['account_password'], $saltHash);
            $dataSave['account_password'] = $newPasswordHash;
            $dataSave['account_password_salt'] = $saltHash;
        }

        if ($id == null) {
            $dataSave['account_username'] = $paramPosts['account_username'];
        }

        $dataSave['account_name']       = $paramPosts['account_name'];
        $dataSave['account_phone']      = $paramPosts['account_phone'];
        $dataSave['account_email']      = $paramPosts['account_email'];
        $dataSave['account_status']     = $paramPosts['account_status'];
        $dataSave['group_account_id']   = $paramPosts['group_account_id'];

        $this->model->savePrimary($dataSave, $id);
    }

    public function setFormSelectOptions()
    {
        $groupUserModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupAccount');

        $optionsGroupAdmin = array('' => '--- Chọn Nhóm ---');
        foreach ($groupUserModel->fetchAll() as $k => $v) {
            $optionsGroupAdmin[$v['group_account_id']] = $v['group_account_name'];
        }

        $this->form->get('group_account_id')->setOptions(array('value_options' => $optionsGroupAdmin));
        $this->form->get('account_status')->setOptions(array('value_options' => $this->status));
    }

    public function uploadImage()
    {
        $uploadService  = $this->getServiceLocator()->get('Upload');

        $pictureNewName = '';
        $pictureInfo = $this->params()->fromFiles('account_picture');

        if (!empty($pictureInfo) && $pictureInfo['name'] != '') {

            $uploadService->setPath($this->uploadPath);
            $uploadService->setFile($pictureInfo['name']);
            $uploadService->setPrefix('users_');
            $uploadService->upload();
            $pictureNewName = $uploadService->getNewFile();
        }

        return $pictureNewName;
    }

    public function deletePictureAction()
    {
        $this->init();

        $id = $this->params()->fromPost('id');

        $record = $this->model->fetchPrimary($id);

        unlink($this->uploadPath . '/' . $record['account_picture']);

        $params = array();
        $params['account_picture'] = null;

        $this->model->savePrimary($params, $id);

        echo json_encode(array('return' => 1));

        return $this->response;
    }
}
