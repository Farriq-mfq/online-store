<?php

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
    public function sendEmailOrder()
    {
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

    public function sendRegisterValidate()
    {
    }

    public function sendPromo()
    {
    }
}
