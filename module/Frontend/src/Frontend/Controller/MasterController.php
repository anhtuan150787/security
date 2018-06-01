<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class MasterController extends AbstractActionController
{
    protected $lang;
    protected $translator;
    protected $templates;

    public function onDispatch(MvcEvent $e)
    {
        /*
         * Set layout
         */
        $this->layout('layout/frontend');

        $session = new Container('Lang');

        if (!isset($session->data)) {
            $lang = ($_GET['lang']) ? $_GET['lang'] : 'vi_VN';
            $session->data = $lang;
        } else {
            $lang = $session->data;
        }

        if (isset($_GET['lang'])) {
            $lang = ($_GET['lang']) ? $_GET['lang'] : 'vi_VN';
            $session->data = $lang;
        } else {
            if (!isset($session->data)) {
                $lang = 'vi_VN';
                $session->data = $lang;
            } else {
                $lang = $session->data;
            }
        }

        $this->lang = ($lang == 'vi_VN') ? 'vn' : 'en';

        $this->translator = $e->getApplication()->getServiceManager()->get('translator');
        $this->translator->setLocale($lang);

        $navigationModel = $e->getApplication()->getServiceManager()->get('Model')->getModel('Application\Model\Navigation');
        $navigations = $navigationModel->getFrontendNavigations(5);

        /*
        * View layout
        */
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->navigations = $navigations;

        /*
         * WebsiteGeneral
         */
        $websiteGeneralModel = $e->getApplication()->getServiceManager()->get('Model')->getModel('Application\Model\WebsiteGeneral');
        $websiteGeneral = $websiteGeneralModel->fetchPrimary(1);

        /*
         * Logo
         */
        $templateModel =  $e->getApplication()->getServiceManager()->get('Model')->getModel('Application\Model\Template');
        $logo = $templateModel->fetchPrimary(7);

        //Template
        $templates = $templateModel->fetchAll();
        foreach($templates as $template) {
            $templateData[$template['template_id']] = $template;
        }
        $this->templates = $templateData;

        //Service Category
        $categoryModel = $e->getApplication()->getServiceManager()->get('Model')->getModel('Application\Model\Category');
        $serviceCategory = $categoryModel->getCategories(3);

        $c = $e->getTarget();
        $match = $e->getRouteMatch();
        $controllerArr = explode('\\', $match->getParam('controller'));
        $controller = strtolower($controllerArr[2]);
        $module = strtolower($controllerArr[0]);

        $viewModel->controller = $controller;
        $viewModel->websiteGeneral = $websiteGeneral;
        $viewModel->logo = $logo;
        $viewModel->lang = $this->lang;
        $viewModel->template = $this->templates;
        $viewModel->serviceCategory = $serviceCategory;

        return parent::onDispatch($e);
    }

    public function init()
    {

    }
}
