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
use Zend\View\Model\ViewModel;

class PostController extends MasterController
{
    public function categoryAction()
    {
        $view = new ViewModel();

        $data   = $this->params()->fromRoute();
        $postCategoryId = $data['id'];

        $postCategoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');
        $postModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Post');
        $escaper = new \Zend\Escaper\Escaper('utf-8');

        $page = $this->params()->fromQuery('page', 1);

        $result = $postModel->fetchPage([
            'JOIN' => 'LEFT JOIN category ON post.category_id = category.category_id',
            'WHERE' => 'post_type = 1 AND post.category_id =' . $postCategoryId,
            'page' => $page,
            'pageItemPerCount' => 20,
        ]);

        $postCategory = $postCategoryModel->fetchPrimary($postCategoryId);

        $crum = '<ul>
                    <li><a href="/">' . $this->translator->translate('home') . '</a></li>
                    <li><a href>' . $escaper->escapeHtml($postCategory['category_name_' . $this->lang]) . '</a></li>
                </ul>';

        $view->setVariables([
            'posts'          => $result['data'],
            'paging'         => $result['paging'],
            'postCategory'   => $postCategory,
            'name'           => $data['name'],
            'id'             => $data['id'],
            'crum'           => $crum,
            'lang'           => $this->lang,
            'template'       => $this->templates,
        ]);

        return $view;
    }

    public function detailAction()
    {
        $view = new ViewModel();

        $data = $this->params()->fromRoute();
        $id = $data['id'];

        $url = $this->getServiceLocator()->get('viewhelpermanager')->get('url');
        $functions = new \Application\View\Helper\Functions();
        $postCategoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');
        $postModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Post');

        $post = $postModel->fetchPrimary($id);
        $postCategory = $postCategoryModel->fetchPrimary($post['category_id']);
        $postOther = $postModel->fetchWhere(['WHERE' => 'post_status = 1 AND category_id=' . $post['category_id'] . ' AND post_type = 1 AND post_id <>' . $post['post_id']]);
        $escaper = new \Zend\Escaper\Escaper('utf-8');

        $crum = '<ul>
                    <li><a href="/">' . $this->translator->translate('home') . '</a></li>
                    <li><a href="' . $url('home-news-category', array('name' => $functions->formatTitle($postCategory['category_name_' . $this->lang]), 'id' => $postCategory['category_id'])) . '">' . $escaper->escapeHtml($postCategory['category_name_' . $this->lang]) . '</a></li>
                    <li><a href>' . $escaper->escapeHtml($post['post_title_' .$this->lang])  . '</a></li>
                </ul>';

        $websiteGeneral['website_general_title'] = $escaper->escapeHtml($post['post_title_' .$this->lang]);
        $websiteGeneral['website_general_description'] = strip_tags($post['post_quote_' . $this->lang]);
        $websiteGeneral['website_general_keyword'] = $escaper->escapeHtml($post['post_tag']);
        $websiteGeneral['website_general_url'] = $url('home-news-detail', array('name' => $functions->formatTitle($post['post_title_' . $this->lang]), 'id' => $post['post_id']));
        $websiteGeneral['website_general_image'] = '/pictures/posts/' . $post['post_picture'];

        $this->layout()->setVariable('websiteGeneral', $websiteGeneral);

        $view->setVariables([
            'post' => $post,
            'crum' => $crum,
            'postCategory' => $postCategory,
            'postOther' => $postOther,
            'lang'           => $this->lang,
            'template'       => $this->templates,
        ]);

        return $view;
    }

}
