<?php
namespace Application\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Message as MimeMessage;

class SendMail  {

    private $to;
    private $from;
    private $subject;
    private $body;
    private $toSecond;
    private $fromName;
    private $configs;

    public function __construct($sm)
    {

        $websiteGeneralModel = $sm->get('Model')->getModel('Application\Model\WebsiteGeneral');
        $websiteEmailModel = $sm->get('Model')->getModel('Application\Model\WebsiteEmail');
        $websiteEmail = $websiteEmailModel->fetchPrimary(1);
        $websiteGeneral = $websiteGeneralModel->fetchPrimary(1);

        $this->configs = [
            'system' => [
                'name' => $websiteEmail['website_email_system_name'],
                'host' => $websiteEmail['website_email_system_host'],
                'port' => $websiteEmail['website_email_system_port'],
                'connection_class' => 'login',
                'connection_config' => [
                    'username'  => $websiteEmail['website_email_system_username'],
                    'password'  => $websiteEmail['website_email_system_password'],
                    'ssl'       => $websiteEmail['website_email_system_ssl'],
                ],
            ],
            'from' => $websiteGeneral['website_general_email'],
            'from_name' => $websiteGeneral['website_general_title'],
        ];

        $this->setFrom($this->configs['from']);
        $this->setFromName($this->configs['from_name']);
    }

    public function send()
    {
        $html = new MimePart($this->body);
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts(array($html));

        $message = new Message();
        $message->addTo($this->to)
                ->addFrom($this->from, $this->fromName)
                ->setSubject($this->subject)
                ->setBody($body)
                ->setEncoding('UTF-8');

        $transport = new SmtpTransport();
        $options   = new SmtpOptions($this->configs['system']);
        $transport->setOptions($options);
        $transport->send($message);
    }

    public function setTo($to) {
        $this->to = $to;
        return $this;
    }

    public function setToSecond($toSecond) {
        $this->toSecond = $toSecond;
        return $this;
    }

    public function setFrom($from) {
        $this->from = $from;
        return $this;
    }

    public function setFromName($fromName) {
        $this->fromName = $fromName;
        return $this;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

    public function setConfig($configs) {
        $this->configs = $configs;
    }
}