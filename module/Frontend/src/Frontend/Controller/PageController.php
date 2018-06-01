<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Zend\I18n\Translator\Translator;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PageController extends MasterController
{
    public function indexAction()
    {
        $view = new ViewModel();

        $data = $this->params()->fromRoute();
        $id = $data['id'];

        $url = $this->getServiceLocator()->get('viewhelpermanager')->get('url');
        $functions = new \Application\View\Helper\Functions();
        $pageModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Post');
        $page = $pageModel->fetchPrimary($id);
        $escaper = new \Zend\Escaper\Escaper('utf-8');

        $crum = '<ul>
                    <li><a href="/">' . $this->translator->translate('home') . '</a></li>
                    <li><a href>' . $escaper->escapeHtml($page['post_title_' . $this->lang]) . '</a></li>
                </ul>';

        $websiteGeneral['website_general_title'] = $escaper->escapeHtml($page['post_title_' . $this->lang]);
        $websiteGeneral['website_general_description'] = strip_tags($page['post_quote_' . $this->lang]);
        $websiteGeneral['website_general_keyword'] = $escaper->escapeHtml($page['post_tag']);
        $websiteGeneral['website_general_url'] = $url('home-page', array('name' => $functions->formatTitle($page['post_title_' . $this->lang]), 'id' => $page['post_id']));

        $this->layout()->setVariable('websiteGeneral', $websiteGeneral);

        $view->setVariables([
            'page' => $page,
            'crum' => $crum,
            'lang' => $this->lang,
            'template' => $this->templates,
        ]);

        return $view;
    }

}
