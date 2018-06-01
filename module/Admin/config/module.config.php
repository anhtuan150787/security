<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Login' => 'Admin\Controller\LoginController',
            'Admin\Controller\Logout' => 'Admin\Controller\LogoutController',
            'Admin\Controller\Menu' => 'Admin\Controller\MenuController',
            'Admin\Controller\Message' => 'Admin\Controller\MessageController',
            'Admin\Controller\Forget' => 'Admin\Controller\ForgetController',
            'Admin\Controller\Acl' => 'Admin\Controller\AclController',
            'Admin\Controller\Account' => 'Admin\Controller\AccountController',
            'Admin\Controller\GroupAccount' => 'Admin\Controller\GroupAccountController',
            'Admin\Controller\WebsiteGeneral' => 'Admin\Controller\WebsiteGeneralController',
            'Admin\Controller\WebsiteEmail' => 'Admin\Controller\WebsiteEmailController',
            'Admin\Controller\Post' => 'Admin\Controller\PostController',
            'Admin\Controller\Page' => 'Admin\Controller\PageController',
            'Admin\Controller\PostCategory' => 'Admin\Controller\PostCategoryController',
            'Admin\Controller\GroupNavigation' => 'Admin\Controller\GroupNavigationController',
            'Admin\Controller\Navigation' => 'Admin\Controller\NavigationController',
            'Admin\Controller\GroupTemplate' => 'Admin\Controller\GroupTemplateController',
            'Admin\Controller\Template' => 'Admin\Controller\TemplateController',
            'Admin\Controller\ProductCategory' => 'Admin\Controller\ProductCategoryController',
            'Admin\Controller\Product' => 'Admin\Controller\ProductController',
            'Admin\Controller\GroupProperty' => 'Admin\Controller\GroupPropertyController',
            'Admin\Controller\Property' => 'Admin\Controller\PropertyController',
            'Admin\Controller\PropertyDetail' => 'Admin\Controller\PropertyDetailController',
            'Admin\Controller\Contact' => 'Admin\Controller\ContactController',
            'Admin\Controller\ServiceCategory' => 'Admin\Controller\ServiceCategoryController',
            'Admin\Controller\Service' => 'Admin\Controller\ServiceController',
        ),
    ),

    'view_helpers' => [
        'invokables' => [
            'formViewElement' => '\Admin\View\Helper\FormElement',
        ],
    ],

    'view_manager' => array(
        'template_map' => array(
            'layout/admin'           => __DIR__ . '/../view/layout/admin.phtml',
            'layout/login'           => __DIR__ . '/../view/layout/login.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
