<?php
/**
 * Created by PhpStorm.
 * User: tri.le
 * Date: 4/1/2015
 * Time: 2:52 PM
 */

namespace Admin\View\Helper;


use Zend\View\Helper\AbstractHelper;

class FormElement extends AbstractHelper
{
    public function __invoke($formElement, $type = null, $params = null)
    {
        switch($type) {
            case 'picture':
                return $this->view->partial('admin/partial/form_element/picture', ['formElement' => $formElement, 'params' => $params]);
                break;

            case 'textarea':
                return $this->view->partial('admin/partial/form_element/textarea', ['formElement' => $formElement, 'params' => $params]);
                break;

            default:
                return $this->view->partial('admin/partial/form_element/element', ['formElement' => $formElement, 'params' => $params]);
                break;
        }

    }
}