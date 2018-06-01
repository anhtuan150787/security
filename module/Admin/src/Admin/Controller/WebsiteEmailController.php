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

class WebsiteEmailController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Cấu hình gửi Email';
        $this->module       = 'website-email';
        $this->modelClass   = 'Application\Model\WebsiteEmail';
        $this->formClass    = '\Admin\Form\WebsiteEmail';
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

                $dataSave['website_email_system_name']      = $paramPosts['website_email_system_name'];
                $dataSave['website_email_system_host']      = $paramPosts['website_email_system_host'];
                $dataSave['website_email_system_port']      = $paramPosts['website_email_system_port'];
                $dataSave['website_email_system_username']  = $paramPosts['website_email_system_username'];
                $dataSave['website_email_system_password']  = $paramPosts['website_email_system_password'];
                $dataSave['website_email_system_ssl']       = $paramPosts['website_email_system_ssl'];

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
}
