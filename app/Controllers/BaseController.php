<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Shipping;
use Payment;
use App\Service\AuthService;
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
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    protected Shipping $shipping;
    protected Payment $payment;
    protected AuthService $authUserService;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        helper(["data","alert","array","form","url_helper","menu_helper"]);
        helper("string");
        helper('inflector');
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        // lib
        $this->shipping = new Shipping();
        $this->payment = new Payment();
        $this->authUserService = new AuthService($_ENV["USER_TOKEN_NAME"]);
        // $this->authUserService->attempt(["email"=>"bonjames020@gmail.com","password"=>"admin"],"admin_path","users");
        // $this->authUserService->logout();
        dd($this->authUserService->getSesssionData());
    }
}
