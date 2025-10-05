<?php

namespace App\Controllers;

use App\Models\Navbar;
use IonAuth\Libraries\IonAuth;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
     protected $session;

    /**
     * @return void
     */

    protected $navModel;
    protected $ionAuth;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->session = service('session');

        $this->navModel = new Navbar();
        $this->ionAuth = new IonAuth();

        $user_nav = $this->navModel->where('visible', 0)->findAll();
        $admin_nav = $this->navModel->where('visible', 1)->findAll();

        $renderer = Services::renderer();
        $renderer->setVar('user_nav', $user_nav);
        $renderer->setVar('admin_nav', $admin_nav);
        $renderer->setVar('ionAuth', $this->ionAuth);
    }
}
