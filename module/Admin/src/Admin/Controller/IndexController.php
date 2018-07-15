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

class IndexController extends MainController
{
    public function indexAction()
    {
        $postModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Post');
        $contactModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Contact');
        $categoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');

        $countNews = $postModel->countWhere([
            'WHERE' => 'post_type = 1'
        ]);

        $countService = $postModel->countWhere([
            'WHERE' => 'post_type = 3'
        ]);

        $countPage = $postModel->countWhere([
            'WHERE' => 'post_type = 2'
        ]);

        $countContact = $contactModel->countAll();

        $postCategory = $categoryModel->countWhere([
            'WHERE' => 'category_type = 1'
        ]);

        $serviceCategory = $categoryModel->countWhere([
            'WHERE' => 'category_type = 3'
        ]);

        return new ViewModel([
            'news' => $countNews,
            'service' => $countService,
            'page' => $countPage,
            'contact' => $countContact,
            'newsCategory' => $postCategory,
            'serviceCategory' => $serviceCategory,
        ]);
    }
}
