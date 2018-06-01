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

class ServiceCategoryController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Danh mục dịch vụ';
        $this->module       = 'service-category';
        $this->modelClass   = 'Application\Model\Category';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\Category';
        $this->categoryType = 3; //Danh muc dich vu
        $this->uploadPath   = 'public/pictures/categories';
    }

    public function indexAction()
    {
        $this->init();

        $records = $this->model->getCategories($this->categoryType);

        $this->view->setVariables([
            'records' => $records,
            'status' => $this->status,
            'msgSuccess' => $this->msgSuccess,
        ]);

        $this->view->setTemplate('admin/category/index.phtml');

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

        $this->view->setTemplate('admin/category/form.phtml');

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

        $this->view->setTemplate('admin/category/form.phtml');

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
        $pictureUploadName = $this->uploadImage();
        if ($pictureUploadName != '') {
            $dataSave['category_picture'] = $pictureUploadName;
        }

        $dataSave['category_name_vn']       = $paramPosts['category_name_vn'];
        $dataSave['category_name_en']       = $paramPosts['category_name_en'];
        $dataSave['category_description_vn']= $paramPosts['category_description_vn'];
        $dataSave['category_description_en']= $paramPosts['category_description_en'];
        $dataSave['category_parent']        = $paramPosts['category_parent'];
        $dataSave['category_status']        = $paramPosts['category_status'];
        $dataSave['category_type']          = $this->categoryType;

        $this->model->savePrimary($dataSave, $id);
    }

    public function setFormSelectOptions()
    {
        $list = $this->model->getCategories($this->categoryType);
        $optionsList = array(0 => '--- Gốc ---');
        foreach ($list as $k => $v) {
            $optionsList[$v['category_id']] = str_repeat('__', $v['category_level']) . ' ' . $v['category_name_vn'];
        }

        $this->form->get('category_parent')->setOptions(array('value_options' => $optionsList));
        $this->form->get('category_status')->setOptions(array('value_options' => $this->status));
    }

    public function uploadImage()
    {
        $uploadService  = $this->getServiceLocator()->get('Upload');

        $pictureNewName = '';
        $pictureInfo = $this->params()->fromFiles('category_picture');

        if (!empty($pictureInfo) && $pictureInfo['name'] != '') {

            $uploadService->setPath($this->uploadPath);
            $uploadService->setFile($pictureInfo['name']);
            $uploadService->setPrefix('category_');
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

        unlink($this->uploadPath . '/' . $record['category_picture']);

        $params = array();
        $params['category_picture'] = null;

        $this->model->savePrimary($params, $id);

        echo json_encode(array('return' => 1));

        return $this->response;
    }
}
