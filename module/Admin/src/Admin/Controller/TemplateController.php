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

class TemplateController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Giao diện';
        $this->module       = 'template';
        $this->modelClass   = 'Application\Model\Template';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\Template';
        $this->uploadPath   = 'public/pictures/templates';
    }

    public function indexAction()
    {
        $this->init();

        $groupTemplateId = $this->params()->fromQuery('group_template_id', null);
        $groupTemplateModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupTemplate');

        $page = $this->params()->fromQuery('page', 1);

        $result = $this->model->fetchPage([
            'page' => $page,
            'pageItemPerCount' => 20,
            'WHERE' => 'group_template_id = ' . $groupTemplateId,
        ]);

        $this->view->setVariables([
            'records' => $result['data'],
            'paging' => $result['paging'],
            'status' => $this->status,
            'msgSuccess' => $this->msgSuccess,
            'groupTemplateId' => $groupTemplateId,
            'groupTemplate' => $groupTemplateModel->fetchPrimary($groupTemplateId),
        ]);

        return $this->view;
    }

    public function addAction()
    {
        $this->init();

        $groupTemplateModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupTemplate');
        $groupTemplateId = $this->params()->fromQuery('group_template_id', null);
        $request = $this->getRequest();

        if ($request->isPost()) {

            $dataPost = $request->getPost();
            $this->form->setData($dataPost);

            if ($this->form->isValid()) {

                $this->save();

                $this->flashMessenger()->addMessage($this->msg['addSuccess'], 'msgSuccess');
                $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'add'], ['query' => ['group_template_id' => $groupTemplateId]]);

            } else {
                $this->msgError = current(current($this->form->getMessages()));
            }
        }

        $this->setFormSelectOptions();

        $this->view->setVariables([
            'form' => $this->form,
            'msgSuccess' => $this->msgSuccess,
            'msgError' => $this->msgError,
            'groupTemplateId' => $groupTemplateId,
            'groupTemplate' => $groupTemplateModel->fetchPrimary($groupTemplateId),
        ]);

        $this->view->setTemplate('admin/' . $this->module . '/form.phtml');

        return $this->view;
    }

    public function editAction()
    {
        $this->init();

        $groupTemplateModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupTemplate');
        $id = $this->params()->fromQuery('id');
        $record = $this->model->fetchPrimary($id);
        $groupTemplateId = $this->params()->fromQuery('group_template_id', null);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $dataPost = $request->getPost();
            $this->form->setData($dataPost);

            if ($this->form->isValid()) {

                $this->save($id);

                $this->flashMessenger()->addMessage($this->msg['editSuccess'], 'msgSuccess');
                $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'edit'], ['query' => ['id' => $id, 'group_template_id' => $groupTemplateId]]);

            } else {
                $this->msgError = current(current($this->form->getMessages()));
            }
        }

        $this->setFormSelectOptions();

        $this->form->get('frmSubmit')->setAttributes(array('value' => 'Cập nhật'));
        $this->form->setData($record);

        $templatePictures = [];
        if ($record['template_type'] == 3) {
            $templatePictureModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\TemplatePicture');
            $templatePictures = $templatePictureModel->fetchWhere(['WHERE' => 'template_id = ' . $record['template_id']]);
        }

        $this->view->setVariables([
            'record' => $record,
            'form' => $this->form,
            'msgSuccess' => $this->msgSuccess,
            'msgError' => $this->msgError,
            'groupTemplateId' => $groupTemplateId,
            'templatePictures' => $templatePictures,
            'groupTemplate' => $groupTemplateModel->fetchPrimary($groupTemplateId),
        ]);

        $this->view->setTemplate('admin/' . $this->module . '/form.phtml');

        return $this->view;
    }

    public function deleteAction()
    {
        $this->init();
        $groupTemplateId = $this->params()->fromPost('group_template_id', null);

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
        $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'index'], ['query' => ['group_template_id' => $groupTemplateId]]);

        return $this->response();
    }


    public function save($id = null)
    {
        $paramPosts = $this->params()->fromPost();
        $groupTemplateId = $this->params()->fromQuery('group_template_id', null);
        $templatePictureModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\TemplatePicture');

        $dataSave = [];

        if ($id == null) {
            $dataSave['group_template_id'] = $groupTemplateId;
        }

        $pictureUploadName = $this->uploadImage();
        if ($pictureUploadName != '') {
            $dataSave['template_picture'] = $pictureUploadName;
        }

        $dataSave['template_name']      = $paramPosts['template_name'];

        $dataSave['template_title_vn']    = $paramPosts['template_title_vn'];
        $dataSave['template_title_en']    = $paramPosts['template_title_en'];

        $dataSave['template_content_vn']    = $paramPosts['template_content_vn'];
        $dataSave['template_content_en']    = $paramPosts['template_content_en'];
        $dataSave['template_status']    = $paramPosts['template_status'];

        $lastInsertId = $this->model->savePrimary($dataSave, $id);

        $multiPictures = $this->uploadMultiImage();
        if (!empty($multiPictures)) {
            foreach($multiPictures as $picture) {
                $dataMultiPicture = [];
                $dataMultiPicture['template_picture_name'] = $picture;
                $dataMultiPicture['template_id'] = $lastInsertId;
                $templatePictureModel->savePrimary($dataMultiPicture);
            }
        }
    }

    public function setFormSelectOptions()
    {
        $this->form->get('template_status')->setOptions(array('value_options' => $this->status));
    }

    public function uploadImage()
    {
        $uploadService  = $this->getServiceLocator()->get('Upload');

        $pictureNewName = '';
        $pictureInfo = $this->params()->fromFiles('template_picture');

        if (!empty($pictureInfo) && $pictureInfo['name'] != '') {

            $uploadService->setPath($this->uploadPath);
            $uploadService->setFile($pictureInfo['name']);
            $uploadService->setPrefix('template_');
            $uploadService->upload();
            $pictureNewName = $uploadService->getNewFile();
        }

        return $pictureNewName;
    }

    public function uploadMultiImage()
    {
        $uploadService  = $this->getServiceLocator()->get('Upload');

        $picturesUploaded = [];
        $pictures = $this->params()->fromFiles('template_multi_picture');

        if (!empty($pictures)) {
            foreach($pictures as $k => $file) {
                if (!empty($file) && $file['name'] != '') {
                    $uploadService->setPath($this->uploadPath);
                    $uploadService->setFile($file['name']);
                    $uploadService->setPrefix('template_');
                    $uploadService->upload();
                    array_push($picturesUploaded, $uploadService->getNewFile());
                }
            }
        }

        return $picturesUploaded;
    }

    public function deletePictureAction()
    {
        $this->init();

        $id = $this->params()->fromPost('id');

        $record = $this->model->fetchPrimary($id);

        unlink($this->uploadPath . '/' . $record['template_picture']);

        $params = array();
        $params['template_picture'] = null;

        $this->model->savePrimary($params, $id);

        echo json_encode(array('return' => 1));

        return $this->response;
    }

    public function deletePictureMultiAction()
    {
        $this->init();

        $id = $this->params()->fromPost('id');
        $templatePictureModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\TemplatePicture');

        $record = $templatePictureModel->fetchPrimary($id);

        unlink($this->uploadPath . '/' . $record['template_picture_name']);

        $templatePictureModel->deletePrimary($id);

        echo json_encode(array('return' => 1));

        return $this->response;
    }
}
