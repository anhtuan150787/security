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

class NavigationController extends MainController
{
    public function __construct()
    {
        $this->moduleName   = 'Liên kết';
        $this->module       = 'navigation';
        $this->modelClass   = 'Application\Model\Navigation';
        $this->status       = ['1' => 'Kích hoạt', '0' => 'Tạm dừng'];
        $this->formClass    = '\Admin\Form\Navigation';
        $this->navigationTypes = [
            1 => 'Nội dung trang',
            2 => 'Bài viết',
            3 => 'Danh mục bài viết',
            4 => 'Liên kết ngoài',
            5 => 'Danh mục dịch vụ',
            6 => 'Dịch vụ',
//            5 => 'Danh mục dự án',
//            6 => 'Dự án',
        ];
    }

    public function indexAction()
    {
        $this->init();

        $groupNavigationId  = $this->params()->fromQuery('group_navigation_id');
        $id       = $this->params()->fromQuery('id', null);

        //Group navigation
        $groupNavigationModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\GroupNavigation');
        $groupNavigation = $groupNavigationModel->fetchPrimary($groupNavigationId);

        //Navigation parent
        $navigationParent = $this->model->getNavigations($groupNavigationId);

        //Post category
        $postCategoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');
        $postCategory = $postCategoryModel->getCategories(1);

        //Page
        $postModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Post');
        $page = $postModel->fetchWhere(['WHERE' => 'post_type = 2']);

        $data = [];
        foreach($page as $k => $v) {
            $data[$k] = $v;
        }
        $page = $data;

        //Post
        $post = $postModel->fetchWhere(['WHERE' => 'post_type = 1']);
        $data = [];
        foreach($post as $k => $v) {
            $data[$k] = $v;
        }
        $post = $data;


        //Service
        $service = $postModel->fetchWhere(['WHERE' => 'post_type = 3']);
        $data = [];
        foreach($service as $k => $v) {
            $data[$k] = $v;
        }
        $service = $data;

        //Service category
        $serviceCategoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Category');
        $serviceCategory = $serviceCategoryModel->getCategories(3);


        //Product category
//        $productCategoryModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\ProductCategory');
//        $productCategory = $productCategoryModel->getProductCategories();

        //Product
//        $productModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Product');
//        $product = $productModel->fetchAll();

        if ($id != null) {
            $record = $this->model->fetchPrimary($id);
        }

        $this->view->setVariables([
            'record' => $record,
            'postCategory' => $postCategory,
            'page' => $page,
            'post' => $post,
            'navigationParent' => $navigationParent,
            'navigation' => $navigationParent,
            'navigationTypes' => $this->navigationTypes,
            'id' => $id,
            'groupNavigation' => $groupNavigation,
            'status' => $this->status,
            'msgSuccess' => $this->msgSuccess,
            'msgError' => $this->msgError,
            'service' => $service,
            'serviceCategory' => $serviceCategory,
//            'productCategory'  => $productCategory,
//            'product' => $product,
        ]);


        return $this->view;
    }

    public function addAction()
    {
        $this->init();

        $this->save();

        $paramPosts = $this->params()->fromPost();

        $this->flashMessenger()->addMessage($this->msg['addSuccess'], 'msgSuccess');
        $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'index'], ['query' => ['group_navigation_id' => $paramPosts['group_navigation_id']]]);

        return $this->response();
    }

    public function editAction()
    {
        $this->init();

        $paramPosts = $this->params()->fromPost();

        $this->save($paramPosts['id']);

        $this->flashMessenger()->addMessage($this->msg['editSuccess'], 'msgSuccess');
        $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'index'], ['query' => ['group_navigation_id' => $paramPosts['group_navigation_id']]]);

        return $this->viewModel();
    }

    public function save($id = null)
    {
        $url = $this->getServiceLocator()->get('viewhelpermanager')->get('url');
        $functions = new \Application\View\Helper\Functions();
        $paramPosts = $this->params()->fromPost();

        $dataSave = [];
        $dataSave['navigation_name_vn']        = $paramPosts['navigation_name_vn'];
        $dataSave['navigation_name_en']        = $paramPosts['navigation_name_en'];
        $dataSave['navigation_url_id']      = $paramPosts['navigation_url_id'];

        $routeName = '';
        switch($paramPosts['navigation_type']) {
            case 1:
               $routeName = 'home-page';
                break;

            case 2:
                $routeName = 'home-news-detail';
                break;

            case 3:
                $routeName = 'home-news-category';
                break;

            case 5:
                $routeName = 'home-service-category';
                break;

            case 6:
                $routeName = 'home-service-detail';
                break;

            default;
                break;
        }

        if ($routeName != '') {
            $navigationName = $url($routeName, array('name' => $functions->formatTitle($paramPosts['navigation_url_name']), 'id' => $paramPosts['navigation_url_id']));
        } else {
            $navigationName = $paramPosts['navigation_url_name'];
        }

        $dataSave['navigation_url_name']    = $navigationName;
        $dataSave['navigation_position']    = $paramPosts['navigation_position'];
        $dataSave['navigation_parent']      = $paramPosts['navigation_parent'];
        $dataSave['navigation_type']        = $paramPosts['navigation_type'];
        $dataSave['group_navigation_id']    = $paramPosts['group_navigation_id'];
        $dataSave['navigation_status']      = $paramPosts['navigation_status'];;

        $this->model->savePrimary($dataSave, $id);
    }


    public function deleteAction()
    {
        $this->init();

        $groupNavigationId = $this->params()->fromQuery('group_navigation_id');

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
        $this->redirect()->toRoute('admin/default', ['controller' => $this->module, 'action' => 'index'], ['query' => ['group_navigation_id' => $groupNavigationId]]);

        return $this->response();
    }
}
