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
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
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
                            'route'    => '/[:controller[/:action[/:id][/:id2]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9a-zA-Z]*',
                                'id2' => '[0-9a-zA-Z]*'
                            ),
                            'defaults' => array(
                                /*'NAMESPACE'=>'Application\Controller',
                                'controller'=>'Test',
                                'action'=>'index',
                                'id'=>*/
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array (
            'UserTableGateway' => function($sm) {
                $adapter = $sm->get("Zend\DB\Adapter");
                $resultSet = new \Zend\Db\ResultSet\ResultSet();
                $resultSet->setArrayObjectPrototype(new \Application\Model\User());
                return new \Zend\Db\TableGateway\TableGateway('user', $adapter, null, $resultSet);
            },
            'UserTableCRUD'=>function ($sm) {
                   $tableGateway = $sm->get ('UserTableGateway');
                   $userManager = new \Application\Model\UserTable($tableGateway);
                   return $userManager;
            },
        
            'AnnonceTableGateway' => function($sm) {
                $adapter = $sm->get("Zend\DB\Adapter");
                $resultSet = new \Zend\Db\ResultSet\ResultSet();
                $resultSet->setArrayObjectPrototype(new \Application\Model\Annonce());
                return new \Zend\Db\TableGateway\TableGateway('annonce', $adapter, null, $resultSet);
            },
            'AnnonceTableCRUD'=>function ($sm) {
                   $tableGateway = $sm->get ('AnnonceTableGateway');
                   $annonceManager = new \Application\Model\AnnonceTable($tableGateway);
                   return $annonceManager;
            },
        
            'CategoryTableGateway' => function($sm) {
                $adapter = $sm->get("Zend\DB\Adapter");
                $resultSet = new \Zend\Db\ResultSet\ResultSet();
                $resultSet->setArrayObjectPrototype(new \Application\Model\Category());
                return new \Zend\Db\TableGateway\TableGateway('category', $adapter, null, $resultSet);
            },
            'CategoryTableCRUD'=>function ($sm) {
                   $tableGateway = $sm->get ('CategoryTableGateway');
                   $categoryManager = new \Application\Model\CategoryTable($tableGateway);
                   return $categoryManager;
            },
        
            'PhotoTableGateway' => function($sm) {
                $adapter = $sm->get("Zend\DB\Adapter");
                $resultSet = new \Zend\Db\ResultSet\ResultSet();
                $resultSet->setArrayObjectPrototype(new \Application\Model\Photo());
                return new \Zend\Db\TableGateway\TableGateway('photo', $adapter, null, $resultSet);
            },
            'PhotoTableCRUD'=>function ($sm) {
                   $tableGateway = $sm->get ('PhotoTableGateway');
                   $photoManager = new \Application\Model\PhotoTable($tableGateway);
                   return $photoManager;
            },
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\User' => 'Application\Controller\UserController',
            'Application\Controller\Annonce' => 'Application\Controller\AnnonceController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
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
