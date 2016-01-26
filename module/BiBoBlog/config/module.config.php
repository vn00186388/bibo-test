<?php
namespace BiBoBlog;
return array(
    'controllers' => array(
        'factories' => array(
            'BiBoBlog\Controller\BiBoBlogController' => 'BiBoBlog\Factory\BiBoBlogControllerFactory',
            'BiBoBlog\Controller\BiBoBlogRestController' => 'BiBoBlog\Factory\BiBoBlogRestControllerFactory',

        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'bi-bo-blog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/blogs[/:action][/:id]/[page/:page]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'BiBoBlog\Controller\BiBoBlogController',
                        'action'     => 'index',
                    ),
                ),
            ),
            'bi-bo-blog-rest' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/blog-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'BiBoBlog\Controller\BiBoBlogRestController',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'bi-bo-blog' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

    ),
    'view_helpers' => array(
        'invokables'=> array(
            'PaginationHelper' => 'BiBoBlog\View\Helper\PaginationHelper'
        )
    ),

    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__.'_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/'.__NAMESPACE__.'/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => __NAMESPACE__.'_driver'
                )
            )
        )
    )
);
