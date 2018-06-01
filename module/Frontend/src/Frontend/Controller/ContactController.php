<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Frontend\Form\Contact;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends MasterController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $form = new Contact();
        $contactModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\Contact');

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $params = [];
                $params['contact_fullname'] = $this->params()->fromPost('contact_fullname');
                $params['contact_email']    = $this->params()->fromPost('contact_email');
                $params['contact_phone']    = $this->params()->fromPost('contact_phone');
                $params['contact_content']  = $this->params()->fromPost('contact_content');
                $params['contact_date']     = date('Y-m-d H:i:s');

                $contactModel->savePrimary($params);

                $patterns = [];
                $patterns[0] = '/{fullname}/';
                $patterns[1] = '/{email}/';
                $patterns[2] = '/{phone}/';
                $patterns[3] = '/{content}/';

                $replacements = [];
                $replacements[0] = $params['contact_fullname'];
                $replacements[1] = $params['contact_email'];
                $replacements[2] = $params['contact_phone'];
                $replacements[3] = $params['contact_content'];

                $bodyMail = file_get_contents('data/email-template/contact.php');
                $bodyMail = preg_replace($patterns, $replacements, $bodyMail);

                $sendMail = $this->getServiceLocator()->get('SendMail');

                $websiteGeneralModel = $this->getServiceLocator()->get('Model')->getModel('Application\Model\WebsiteGeneral');
                $websiteGeneral = $websiteGeneralModel->fetchPrimary(1);

                $sendMail->setTo($websiteGeneral['website_general_email']);
                $sendMail->setSubject('Liên hệ');
                $sendMail->setBody($bodyMail);
                $sendMail->send();

                return $this->redirect()->toRoute('home-lien-he-success');
            }
        }

        $crum = '<ul>
                    <li><a href="/">' . $this->translator->translate('home') . '</a></li>
                    <li><a href>' . $this->translator->translate('contact') . '</a></li>
                </ul>';

        $view->setVariables([
            'crum' => $crum,
            'form' => $form,
            'lang'           => $this->lang,
            'template'       => $this->templates,
        ]);

        return $view;
    }

    public function successAction() {
        $view = new ViewModel();

        $crum = '<ul>
                    <li><a href="/">' . $this->translator->translate('home') . '</a></li>
                    <li><a href>' . $this->translator->translate('contact') . '</a></li>
                </ul>';

        $view->setVariables([
            'crum' => $crum,
            'lang'           => $this->lang,
            'template'       => $this->templates,
        ]);

        return $view;
    }

}
