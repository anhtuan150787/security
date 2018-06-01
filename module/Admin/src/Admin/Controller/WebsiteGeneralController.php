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

class WebsiteGeneralController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Cấu hình chung';
        $this->module       = 'website-general';
        $this->modelClass   = 'Application\Model\WebsiteGeneral';
        $this->formClass    = '\Admin\Form\WebsiteGeneral';
        $this->uploadPath   = 'public/pictures/websites';
    }

    public function indexAction()
    {
        $this->redirect()->toRoute('admin');

        return $this->response;
    }

    public function editAction()
    {
        $this->init();

        $id = 1;
        $record = $this->model->fetchPrimary($id);

        if ($this->getRequest()->isPost()) {

            $paramPosts = $this->params()->fromPost();
            $this->form->setData($paramPosts);

            if ($this->form->isValid()) {
                $dataSave = [];

                $pictureUploadName = $this->uploadImage();
                if ($pictureUploadName != '') {
                    $dataSave['website_general_favicon'] = $pictureUploadName;
                }

                $dataSave['website_general_title'] = $paramPosts['website_general_title'];
                $dataSave['website_general_keyword'] = $paramPosts['website_general_keyword'];
                $dataSave['website_general_description'] = $paramPosts['website_general_description'];
                $dataSave['website_general_email'] = $paramPosts['website_general_email'];

                $this->model->savePrimary($dataSave, $id);

                $this->flashMessenger()->addMessage($this->msg['editSuccess'], 'msgSuccess');
                $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'edit']);

            } else {
                $this->msgError = current(current($this->form->getMessages()));
            }

        }

        $this->form->get('frmSubmit')->setAttributes(array('value' => 'Cập nhật'));
        $this->form->setData($record);

        $this->view->setVariables([
            'id' => $id,
            'record' => $record,
            'form' => $this->form,
            'msgSuccess' => $this->msgSuccess,
            'msgError' => $this->msgError
        ]);

        $this->view->setTemplate('admin/' . $this->module . '/form.phtml');

        return $this->view;
    }

    public function uploadImage()
    {
        $uploadService  = $this->getServiceLocator()->get('Upload');

        $pictureNewName = '';
        $pictureInfo = $this->params()->fromFiles('website_general_favicon');

        if (!empty($pictureInfo) && $pictureInfo['name'] != '') {

            $uploadService->setPath($this->uploadPath);
            $uploadService->setFile($pictureInfo['name']);
            $uploadService->setPrefix('favicon_');
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

        unlink($this->uploadPath . '/' . $record['website_general_favicon']);

        $params = array();
        $params['website_general_favicon'] = null;

        $this->model->savePrimary($params, $id);

        echo json_encode(array('return' => 1));

        return $this->response;
    }
}
