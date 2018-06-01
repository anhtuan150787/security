<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Frontend\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'captcha' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/captcha-reload',
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Captcha',
                        'action'     => 'index',
                    ],
                ],
            ],


            'home-product-category' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-pc-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'category',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'category',
                    ],
                ),
            ],
            'home-product-detail' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-pd-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'detail',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'detail',
                    ],
                ),
            ],
            'product-all' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/du-an',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'all',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'all',
                    ],
                ),
            ],
            'product-category-all' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-pca-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'category-all',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'category-all',
                    ],
                ),
            ],
            'product-sale' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/san-pham-sale',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'sale',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Product',
                        'action' => 'sale',
                    ],
                ),
            ],

            'home-news-category' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-nc-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Post',
                        'action' => 'category',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Post',
                        'action' => 'category',
                    ],
                ),
            ],
            'home-news-detail' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-n-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Post',
                        'action' => 'detail',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Post',
                        'action' => 'detail',
                    ],
                ),
            ],
            'home-page' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-p-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Page',
                        'action' => 'index',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Page',
                        'action' => 'index',
                    ],
                ),
            ],
            'home-order' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/dat-hang[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'index',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'index',
                    ],
                ),
            ],
            'home-order-delete' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/xoa-don-hang-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'delete-item',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'delete-item',
                    ],
                ),
            ],
            'home-order-update' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cap-nhat-don-hang',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'update',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'update',
                    ],
                ),
            ],
            'home-order-confirm' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/xac-nhan-don-hang',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'confirm',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'confirm',
                    ],
                ),
            ],
            'home-order-success' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/dat-hang-thanh-cong',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'success',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Order',
                        'action' => 'success',
                    ],
                ),
            ],
            'home-lien-he' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/lien-he',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Contact',
                        'action' => 'index',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Contact',
                        'action' => 'index',
                    ],
                ),
            ],
            'home-lien-he-success' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/lien-he-success',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Contact',
                        'action' => 'success',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Contact',
                        'action' => 'success',
                    ],
                ),
            ],
            'home-email-customer' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/email-customer',
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Index',
                        'action' => 'email-customer',
                    ],
                ),
            ],

            'home-service-category' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-sc-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Service',
                        'action' => 'category',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Service',
                        'action' => 'category',
                    ],
                ),
            ],
            'home-service-detail' => [
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:name]-s-[:id]',
                    'constraints' => [
                        'controller' => 'Frontend\Controller\Service',
                        'action' => 'detail',
                        'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Frontend\Controller',
                        'controller' => 'Frontend\Controller\Service',
                        'action' => 'detail',
                    ],
                ),
            ],

        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Frontend\Controller\Index' => 'Frontend\Controller\IndexController',
            'Frontend\Controller\Product' => 'Frontend\Controller\ProductController',
            'Frontend\Controller\Post' => 'Frontend\Controller\PostController',
            'Frontend\Controller\Page' => 'Frontend\Controller\PageController',
            'Frontend\Controller\Order' => 'Frontend\Controller\OrderController',
            'Frontend\Controller\Contact' => 'Frontend\Controller\ContactController',
            'Frontend\Controller\Captcha' => 'Frontend\Controller\CaptchaController',
            'Frontend\Controller\Service' => 'Frontend\Controller\ServiceController',
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'layout/frontend' => __DIR__ . '/../view/layout/frontend.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ),
        ),
    ),
);