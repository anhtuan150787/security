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

class PostController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Bài viết';
        $this->module       = 'post';
        $this->modelClass   = 'Application\Model\Post';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\Post';
        $this->uploadPath   = 'public/pictures/posts';
        $this->postType     = 1; //Bai viet
    }

    public function indexAction()
    {
        $this->init();

        $page = $this->params()->fromQuery('page', 1);

        $result = $this->model->fetchPage([
            'JOIN' => 'LEFT JOIN category ON post.category_id = category.category_id',
            'WHERE' => 'post_type = ' . $this->postType,
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

                $record = $this->model->fetchPrimary($v);

                unlink($this->uploadPath . '/' . $record['post_picture']);

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
            $dataSave['post_picture'] = $pictureUploadName;
        }

        $dataSave['post_title_vn']      = $paramPosts['post_title_vn'];
        $dataSave['post_quote_vn']      = $paramPosts['post_quote_vn'];
        $dataSave['post_body_vn']       = $paramPosts['post_body_vn'];

        $dataSave['post_title_en']      = $paramPosts['post_title_en'];
        $dataSave['post_quote_en']      = $paramPosts['post_quote_en'];
        $dataSave['post_body_en']       = $paramPosts['post_body_en'];

        $dataSave['post_status']        = $paramPosts['post_status'];

        $dataSave['category_id']        = $paramPosts['category_id'];
        $dataSave['post_type']          = $this->postType;

        $this->model->savePrimary($dataSave, $id);
    }

    public function setFormSelectOptions()
    {
        $postCategoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');
        $postCategories = $postCategoryModel->getCategories(1); //Danh mục bai viet

        $optionsPostCategory = ['' => '--- Chọn Danh mục ---'];
        foreach ($postCategories as $k => $v) {
            $optionsPostCategory[$v['category_id']] = str_repeat('__', $v['category_level']) . ' ' . $v['category_name_vn'];
        }

        $this->form->get('post_status')->setOptions(array('value_options' => $this->status));
        $this->form->get('category_id')->setOptions(array('value_options' => $optionsPostCategory));
    }

    public function uploadImage()
    {
        $uploadService  = $this->getServiceLocator()->get('Upload');

        $pictureNewName = '';
        $pictureInfo = $this->params()->fromFiles('post_picture');

        if (!empty($pictureInfo) && $pictureInfo['name'] != '') {

            $uploadService->setPath($this->uploadPath);
            $uploadService->setFile($pictureInfo['name']);
            $uploadService->setPrefix('post_');
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

        unlink($this->uploadPath . '/' . $record['post_picture']);

        $params = array();
        $params['post_picture'] = null;

        $this->model->savePrimary($params, $id);

        echo json_encode(array('return' => 1));

        return $this->response;
    }
}
