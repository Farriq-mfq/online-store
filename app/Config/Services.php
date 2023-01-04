<?php

namespace Config;

use App\Models\Admin as AdminModel;
use App\Models\User;
use App\Service\AuthService;
use CodeIgniter\Config\BaseService;
use Payment;
use Shipping;
use UniqueVisitor;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function shippingservice($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance("shippingservice");
        }

        return new Shipping($_ENV['API_RAJA_ONGKIR']);
    }
    public static function paymentservice($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance("paymentservice");
        }

        return new Payment($_ENV['SERVER_KEY_MIDTRANS']);
    }
    public static function authserviceUser($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance("authserviceUser");
        }

        return new AuthService($_ENV["USER_TOKEN_NAME"], User::class);
    }
    public static function authserviceAdmin($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance("authserviceAdmin");
        }

        return new AuthService($_ENV["ADMIN_TOKEN_NAME"], AdminModel::class);
    }

    public static function uniqueVisitorService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance("uniqueVisitorService");
        }

        return new UniqueVisitor();
    }
}
