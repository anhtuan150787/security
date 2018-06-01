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

class ProductController extends MasterController
{
    public function categoryAction()
    {
        $view = new ViewModel();

        $data   = $this->params()->fromRoute();
        $productCategoryId = $data['id'];

        $productCategoryModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductCategoryModel');
        $productModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductModel');
        $escaper = new \Zend\Escaper\Escaper('utf-8');

        $page = $this->params()->fromQuery('page', 1);
        $products = $productModel->fetchPage($page, 9, 'product_category_id = ' . $productCategoryId);

        $productCategory = $productCategoryModel->fetchPrimary($productCategoryId);

        $crum = '<ul class="crumb">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="sep">/</li>
                    <li>' . $escaper->escapeHtml($productCategory['product_category_name']) . '</li>
                </ul>';

        $view->setVariables([
            'products'          => $products,
            'productCategory'   => $productCategory,
            'name'              => $data['name'],
            'id'                => $data['id'],
            'crum'              => $crum,
        ]);

        return $view;
    }

    public function detailAction() {
        $view = new ViewModel();

        $data   = $this->params()->fromRoute();
        $productId = $data['id'];

        $url = $this->getServiceLocator()->get('viewhelpermanager')->get('url');
        $functions = new \Application\View\Helper\Functions();
        $escaper = new \Zend\Escaper\Escaper('utf-8');

        $productModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductModel');
        $productPictureModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductPictureModel');
        $productCategoryModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductCategoryModel');

        $product = $productModel->fetchPrimary($productId);
        $productPictures = $productPictureModel->fetchWhere('product_id = ' . $product['product_id']);
        $productCategory = $productCategoryModel->fetchPrimary($product['product_category_id']);

        $crum = '<ul class="crumb">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="sep">/</li>
                    <li><a href="' . $url('home-product-category', array('name' => $functions->formatTitle($productCategory['product_category_name']), 'id' => $productCategory['product_category_id'])) . '">' . $escaper->escapeHtml($productCategory['product_category_name']) . '</a></li>
                    <li class="sep">/</li>
                    <li>' . $escaper->escapeHtml($product['product_name']) . '</li>
                </ul>';

        $websiteGeneral['website_general_title'] = $escaper->escapeHtml($product['product_name']);
        $websiteGeneral['website_general_description'] = strip_tags($product['product_description']);
        $websiteGeneral['website_general_keyword'] = $escaper->escapeHtml($product['product_tag']);
        $websiteGeneral['website_general_url'] = $url('home-product-detail', array('name' => $functions->formatTitle($product['product_name']), 'id' => $product['product_id']));
        $websiteGeneral['website_general_image'] = 'http://lifedeco.vn/pictures/products/' . $product['product_picture'];

        $this->layout()->setVariable('websiteGeneral', $websiteGeneral);

        $view->setVariables([
            'product' => $product,
            'productPictures' => $productPictures,
            'productCategory' => $productCategory,
            'crum' => $crum,
        ]);

        return $view;
    }

    public function allAction() {
        $view = new ViewModel();

        $productModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductModel');
        $productCategoryModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductCategoryModel');

        $products = $productModel->fetchWhere('product_status = 1');
        $productCategory = $productCategoryModel->fetchWhere('product_category_status = 1 AND product_category_picture != ""');

        $crum = '<ul class="crumb">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="sep">/</li>
                    <li>Dự án</li>
                </ul>';

        $view->setVariables(['products' => $products, 'productCategories' => $productCategory, 'crum' => $crum,]);

        return $view;
    }

    public function categoryAllAction() {
        $view = new ViewModel();

        $data   = $this->params()->fromRoute();
        $productCategoryId = $data['id'];

        $productModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductModel');
        $productCategoryModel = $this->getServiceLocator()->get('FrontendModelGateway')->getModel('ProductCategoryModel');

        $productCategories = $productCategoryModel->fetchWhere('product_category_status = 1 AND product_category_parent = ' . $productCategoryId);
        $strProductCategoryId = '';
        foreach($productCategories as $v) {
            $strProductCategoryId .= ',' . $v['product_category_id'];
        }

        $products = $productModel->fetchWhere('product_status = 1 AND product_category_id IN (' . trim($strProductCategoryId, ',') . ')');
        $productCategory = $productCategoryModel->fetchPrimary($productCategoryId);

        $escaper = new \Zend\Escaper\Escaper('utf-8');
        $crum = '<ul class="crumb">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="sep">/</li>
                    <li>' . $escaper->escapeHtml($productCategory['product_category_name']) . '</li>
                </ul>';

        $view->setVariables(['products' => $products, 'productCategories' => $productCategories, 'crum' => $crum, 'productCategory' => $productCategory]);

        return $view;
    }

}
