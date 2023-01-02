<?php

use App\Models\Order;
use Config\Email;

class Mail
{
    private $db;
    private $smtp;
    private $template;
    public function __construct()
    {
        $this->db = db_connect();
        $mail = $this->db->table('smtp')->get()->getFirstRow();
        $config["protocol"] = isset($mail->protocol) ? $mail->protocol : "";
        $config["SMTPHost"] = isset($mail->host) ? $mail->host : "";
        $config["SMTPUser"] = isset($mail->user) ? $mail->user : "";
        $config["SMTPPass"] = isset($mail->password) ? $mail->password : "";
        $config["SMTPPort"] = isset($mail->port) ? $mail->port : "";
        $config["SMTPCrypto"] = isset($mail->crypto) ? $mail->crypto : "";
        $config["mailType"] = isset($mail->type) ? $mail->type : "";
        $config["userAgent"] = isset($mail->useragent) ? $mail->useragent : "";
        $this->smtp = \Config\Services::email();
        $this->smtp->initialize($config);

        // set template instance
        $this->template = $this->db->table('email_template');
    }

    public function sendTesting($email)
    {
        $this->smtp->setFrom("testing@domain.com", "Testing Mail works");
        $this->smtp->setTo($email);
        $this->smtp->setSubject("SUBJECT TESTING");
        $this->smtp->setMessage("MAIL TESTING WORKS");
        return $this->smtp->send();
    }
    public function sendResetlink($email, $link)
    {
        try {
            $template = $this->template->where('type', "RESET_PASSWORD_USER")->get()->getFirstRow();
            if ($template != null) {
                $website = $this->db->table('website')->get()->getFirstRow();
                $this->smtp->setFrom($template->from_email, $template->from_name);
                $this->smtp->setTo($email);
                $this->smtp->setSubject("Reset Password");
                $html = str_replace(["%link%", "%logo%"], [$link, $website->logo], html_entity_decode($template->content));
                $this->smtp->setMessage($html);
                return $this->smtp->send(true);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function sendEmailRegister($link, $email, $name)
    {
        try {
            $template = $this->template->where('type', "CONFIRM_EMAIL_USER")->get()->getFirstRow();
            if ($template != null) {
                $website = $this->db->table('website')->get()->getFirstRow();
                $this->smtp->setFrom($template->from_email, $template->from_name);
                $this->smtp->setTo($email);
                $this->smtp->setSubject("Confirmation Email");
                $html = str_replace(["%link%", "%logo%", "%user%"], [$link, $website->logo, $name], html_entity_decode($template->content));
                $this->smtp->setMessage($html);
                return $this->smtp->send(true);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function sendOrderReceived($orderId)
    {

        try {
            $template = $this->template->where('type', "ORDER_RECEIVED")->get()->getFirstRow();
            if ($template != null) {
                $order_model = new Order();
                $order = $order_model->with('users')->find($orderId);
                if ($order != null) {
                    $website = $this->db->table('website')->get()->getFirstRow();
                    $this->smtp->setFrom($template->from_email, $template->from_name);
                    $this->smtp->setTo($order->user->email);
                    $this->smtp->setSubject("Your order has been received.");
                    $html = str_replace(["%link%", "%logo%", "%user%", "%token%", "%date%", "%total%"], [base_url("account/view?token=" . $order->token), $website->logo, $order->user->name, $order->token, $order->created_at, format_rupiah($order->subtotal)], html_entity_decode($template->content));
                    $this->smtp->setMessage($html);
                    return $this->smtp->send(true);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function sendOrderProcess($orderId)
    {
        try {
            $template = $this->template->where('type', "ORDER_PROCESS")->get()->getFirstRow();
            if ($template != null) {
                $order_model = new Order();
                $order = $order_model->with('users')->find($orderId);
                if ($order != null) {
                    $website = $this->db->table('website')->get()->getFirstRow();
                    $this->smtp->setFrom($template->from_email, $template->from_name);
                    $this->smtp->setTo($order->user->email);
                    $this->smtp->setSubject("Your order has been process.");
                    $html = str_replace(["%link%", "%logo%", "%user%", "%token%", "%date%", "%total%"], [base_url("account/view?token=" . $order->token), $website->logo, $order->user->name, $order->token, $order->created_at, format_rupiah($order->subtotal)], html_entity_decode($template->content));
                    $this->smtp->setMessage($html);
                    return $this->smtp->send(true);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function sendOrderShipped($orderId)
    {

        try {
            $template = $this->template->where('type', "ORDER_SHIPPED")->get()->getFirstRow();
            if ($template != null) {
                $order_model = new Order();
                $order = $order_model->with('users')->find($orderId);
                if ($order != null) {
                    $website = $this->db->table('website')->get()->getFirstRow();
                    $this->smtp->setFrom($template->from_email, $template->from_name);
                    $this->smtp->setTo($order->user->email);

                    $this->smtp->setSubject("Your order has been shipped.");
                    $html = str_replace(["%link%", "%logo%", "%user%", "%token%", "%date%", "%total%", "%tracking%"], [base_url("account/view?token=" . $order->token), $website->logo, $order->user->name, $order->token, $order->created_at, format_rupiah($order->subtotal), $order->shipping_tracking], html_entity_decode($template->content));
                    $this->smtp->setMessage($html);
                    return $this->smtp->send(true);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function sendOrderdone($orderId)
    {

        try {
            $template = $this->template->where('type', "ORDER_DONE")->get()->getFirstRow();
            if ($template != null) {
                $order_model = new Order();
                $order = $order_model->with('users')->find($orderId);
                if ($order != null) {
                    $website = $this->db->table('website')->get()->getFirstRow();
                    $this->smtp->setFrom($template->from_email, $template->from_name);
                    $this->smtp->setTo($order->user->email);
                    $this->smtp->setSubject("Your order has been done.");
                    $html = str_replace(["%link%", "%logo%", "%user%", "%token%", "%date%", "%total%"], [base_url("account/view?token=" . $order->token), $website->logo, $order->user->name, $order->token, $order->created_at, format_rupiah($order->subtotal)], html_entity_decode($template->content));
                    $this->smtp->setMessage($html);
                    return $this->smtp->send(true);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function sendOrderReject($orderId)
    {
        try {
            $template = $this->template->where('type', "ORDER_REJECT")->get()->getFirstRow();
            if ($template != null) {
                $order_model = new Order();
                $order = $order_model->with('users')->find($orderId);
                if ($order != null) {
                    $website = $this->db->table('website')->get()->getFirstRow();
                    $this->smtp->setFrom($template->from_email, $template->from_name);
                    $this->smtp->setTo($order->user->email);
                    $this->smtp->setSubject("Your order has been Cancel.");
                    $html = str_replace(["%link%", "%logo%", "%user%", "%token%", "%date%", "%total%"], [base_url("account/view?token=" . $order->token), $website->logo, $order->user->name, $order->token, $order->created_at, format_rupiah($order->subtotal)], html_entity_decode($template->content));
                    $this->smtp->setMessage($html);
                    return $this->smtp->send(true);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function sendConfirmAdmin($email, $link, $name)
    {
        try {
            $template = $this->template->where('type', "CONFIRM_EMAIL_ADMIN")->get()->getFirstRow();
            if ($template != null) {
                $website = $this->db->table('website')->get()->getFirstRow();
                $this->smtp->setFrom($template->from_email, $template->from_name);
                $this->smtp->setTo($email);
                $this->smtp->setSubject("ADMIN REGISTER CONFIRMATION");
                $html = str_replace(["%link%", "%logo%", "%user%"], [$link, $website->logo, $name], html_entity_decode($template->content));
                $this->smtp->setMessage($html);
                return $this->smtp->send(true);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
