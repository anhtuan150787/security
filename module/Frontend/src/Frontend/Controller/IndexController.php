<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Frontend\Form\Contact;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends MasterController
{
    public function indexAction()
    {
        $view = new ViewModel();

        //Slide banner
        $templateModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Template');
        $bannerSlide = $templateModel->fetchWhere([
            'WHERE' => 'group_template_id = 6 AND template_status = 1',
        ]);

        //About Us
        $postModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Post');
        $aboutUs = $postModel->fetchPrimary(2);

        //Why choose us
        $whyChoose = $templateModel->fetchWhere([
            'WHERE' => 'group_template_id = 7 AND template_status = 1',
        ]);

        //Service Category
        $categoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');
        $serviceCategory = $categoryModel->getCategories(3);

        //Y kien
        $comment = $templateModel->fetchWhere([
            'WHERE' => 'group_template_id = 8 AND template_status = 1',
        ]);

        //News
        $news = $postModel->fetchWhere([
            'WHERE' => 'category_id = 4 AND post_status = 1',
            'LIMIT' => '4',
        ]);

        $view->setVariables([
            'bannerSlide' => $bannerSlide,
            'lang' => $this->lang,
            'aboutUs' => $aboutUs,
            'template' => $this->templates,
            'whyChoose' => $whyChoose,
            'serviceCategory' => $serviceCategory,
            'comment' => $comment,
            'news' => $news,
        ]);
        return $view;
    }

}
