<?php
namespace BiBoUser;
return array(
    'controllers' => array(
        'factories' => array(
            'BiBoUser\Controller\BiBoUserController' => 'BiBoUser\Factory\BiBoUserControllerFactory',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'bi-bo-user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/users[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'BiBoUser\Controller\BiBoUserController',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'bi-bo-user' => __DIR__ . '/../view',
        ),
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
