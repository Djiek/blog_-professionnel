<?php
session_start();
require('app/Controllers/PostController.php');
require('app/Controllers/UserController.php');
require('app/Controllers/AdminController.php');
require('app/Controllers/MainController.php');

use blogProfessionnel\App\Controllers\UserController;
use blogProfessionnel\App\Controllers\PostController;
use blogProfessionnel\App\Controllers\MainController;
use blogProfessionnel\App\Controllers\AdminController;

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {
            $controller = new MainController();
            $controller->home();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new PostController();
                $controller->post();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
            //  } elseif ($_GET['action'] == 'admin') {
            // $controller = new AdminController();
            // $controller->admin();
        } elseif ($_GET['action'] == 'listPosts') {
            $controller = new PostController();
            $controller->listPosts();
        } elseif ($_GET['action'] == 'addPostForm') {
            $controller = new AdminController();
            $controller->addPostForm();
        } elseif ($_GET['action'] == 'login') {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                if (isset($_POST['login']) && strlen($_POST['password']) > 0) {
                    if (!empty($_POST['login']) && !empty($_POST['password'])) {
                        $controller = new UserController();
                        $controller->login();
                    } else {
                        // Autre exception
                        $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                        header('Location: index.php?action=connection');
                    }
                }
            } else {
                // Autre exception
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=connection');
            }
        } elseif ($_GET['action'] == 'managementCommentPage') {
            $controller = new AdminController();
            $controller->managementCommentPage();
        } elseif ($_GET['action'] == 'ViewPostComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new AdminController();
                $controller->ViewPostComment();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'deleteComment') {
            $controller = new AdminController();
            $controller->deleteComment();
        } elseif ($_GET['action'] == 'updateSatusComment') {
            $controller = new AdminController();
            $controller->updateStatusComment();
        } elseif ($_GET['action'] == 'connection') {
            $controller = new UserController();
            $controller->connection();
        } elseif ($_GET['action'] == 'logout') {
            $controller = new UserController();
            $controller->logout();
        } elseif ($_GET['action'] == 'inscriptionForm') {
            $controller = new UserController();
            $controller->inscriptionForm();
        } elseif ($_GET['action'] == 'inscription') {
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail']  && !empty($_POST['cPassword']))) {
                $controller = new UserController();
                $controller->inscription($_POST['login'],  $_POST['password'], $_POST['mail']); //$hashPassword
            } elseif (!isset($_SESSION[$_POST['login']])) {
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=inscriptionForm');
            }
        } elseif ($_GET['action'] == 'postContact') {
            $controller = new MainController();
            $controller->postContact();
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content']) && !empty($_POST['title'])) {
                    $controller = new PostController();
                    $controller->addComment($_GET['id'], 1, $_POST['content'], $_POST['title']);
                } else {
                    // Autre exception
                    $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                    header('Location: index.php?action=post&id=' . $_GET['id']);
                }
            } else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addBlogPost') {
            //  if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['content']) && !empty($_POST['title']) && !empty($_POST['chapo'])) {
                $controller = new AdminController();
                $controller->addBlogPost(
                    /**$_GET['id'],**/
                    $_POST['content'],
                    $_POST['title'],
                    $_POST['chapo']
                );
            } else {
                // Autre exception
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=addPostForm');
            }
            // }
            // else {
            //     // Autre exception
            //     throw new Exception('Aucun identifiant de billet envoyé');
            // }
        }
    } else {
        $controller = new MainController();
        $controller->home();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('app/Views/errorView.php');
}

//  function route(){
//      $routes = [
//     ['action' => 'home', 'controller' => 'MainController', 'method' => 'home'],
//     ['action' => 'post', 'controller' => 'PostController', 'method' => 'post'],
//     ['action' => 'listPosts', 'controller' => 'PostController', 'method' => 'listPosts'],
//     ['action' => 'addPostForm', 'controller' => 'UserController', 'method' => 'addPostForm'],
//     ['action' => 'managementCommentPage', 'controller' => 'AdminController', 'method' => 'managementCommentPage'],
//     ['action' => 'ViewPostComment', 'controller' => 'AdminController', 'method' => 'ViewPostComment'],
//     ['action' => 'deleteComment', 'controller' => 'AdminController', 'method' => 'deleteComment'],
//     ['action' => 'updateSatusComment', 'controller' => 'AdminController', 'method' => 'updateSatusComment'],
//     ['action' => 'connection', 'controller' => 'UserController', 'method' => 'connection'],
//     ['action' => 'logout', 'controller' => 'UserController', 'method' => 'logout'],
//     ['action' => 'inscriptionForm', 'controller' => 'UserController', 'method' => 'inscriptionForm'],
//     ['action' => 'inscription', 'controller' => 'UserController', 'method' => 'inscription'],
//     ['action' => 'postContact', 'controller' => 'MainController', 'method' => 'postContact'],
//     ['action' => 'addComment', 'controller' => 'PostController', 'method' => 'addComment'],
//     ['action' => 'addBlogPost', 'controller' => 'AdminController', 'method' => 'addBlogPost'],
// ];
//     foreach ($routes as $route) {
//     if ($route['action'] == $_GET['action']) {
//         $controller = new $route['controller']();
//         $controller->{$route['method']}();
//         break;
//     }
// }
//  }

//     switch ($_GET['action']) {

//         case $_GET['home']:
//         $route->route();
//        return $route;
//         break;

//         case $_GET['post']:
//          if (isset($_GET['id']) && $_GET['id'] > 0) {
//               route();
//             } else {
//                 // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
//                 throw new Exception('Aucun identifiant de billet envoyé');
//             }
//         break;

//         case $_GET['listPosts']:
//         route();
//         break;

//         case $_GET['addPostForm']:
//         route();
//         break;

//         case $_GET['managementCommentPage']:
//         route();
//         break;

//         case $_GET['ViewPostComment']:
//         if (isset($_GET['id']) && $_GET['id'] > 0) {
//                 route();
//             } else {
//                 throw new Exception('Aucun identifiant de billet envoyé');
//             }
        
//         break;
        
//         case $_GET['deleteComment']:
//         route();
//         break;

//         case $_GET['updateSatusComment']:
//         route();
//         break;

//         case $_GET['connection']:
//         route();
//         break;

//         case $_GET['logout']:
//         break;

//         case $_GET['login']:
//             if (!empty($_POST['login']) && !empty($_POST['password'])) {
//                 if (isset($_POST['login']) && strlen($_POST['password']) > 0) {
//                     if (!empty($_POST['login']) && !empty($_POST['password'])) {
//                       route();
//                     } else {
//                         $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
//                         header('Location: index.php?action=connection');
//                     }
//                 }
//             }
//         break;

//         case $_GET['inscriptionForm']:
//         break;

//         case $_GET['inscription']:
//          if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail']  && !empty($_POST['cPassword']))) {
//                 route();
//                 $controller->inscription($_POST['login'],  $_POST['password'], $_POST['mail']); //$hashPassword
//             } elseif (!isset($_SESSION[$_POST['login']])) {
//                 $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
//                 header('Location: index.php?action=inscriptionForm');
//             }
//         break;

//         case $_GET['postContact']:
//         break;

//         case $_GET['addComment']:
//         if (isset($_GET['id']) && $_GET['id'] > 0) {
//                 if (!empty($_POST['content']) && !empty($_POST['title'])) {
//                     route();
//                     $controller->addComment($_GET['id'], 1, $_POST['content'], $_POST['title']);
//                 } else {
//                     // Autre exception
//                     $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
//                     header('Location: index.php?action=inscriptionForm');
//                 }
//         } else {
//                 // Autre exception
//                 throw new Exception('Aucun identifiant de billet envoyé');
//             }

//         break;
//          case $_GET['addBlogPost']:
//             if (!empty($_POST['content']) && !empty($_POST['title']) && !empty($_POST['chapo'])) {
//                route();
//                 $controller->addBlogPost(
//                     /**$_GET['id'],**/
//                     $_POST['content'],
//                     $_POST['title'],
//                     $_POST['chapo']
//                 );
//             } else {
//                 // Autre exception
//                 $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
//                 header('Location: index.php?action=addPostForm');
//             }
//         break;
//     }

    //     default:
    //     $controller = new MainController();
    //     $controller->home();
    // //    catch (Exception $e) 
    // //     $errorMessage = $e->getMessage();
    // //     require('app/Views/errorView.php');
    //     break;
