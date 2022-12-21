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
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        helper(["data","alert","array","form","url_helper","menu_helper","auth_helper","get_shipping_helper"]);
        helper("string");
        helper('inflector');
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        // lib
        $this->shipping = new Shipping();
        $this->payment = new Payment();
        // echo "<pre>";
        // print_r($this->shipping->get_cost(2,4,"jne"));
        // echo "</pre>";
        // return;
    }
}
