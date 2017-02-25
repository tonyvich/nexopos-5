<?php
defined('BASEPATH') or exit('No direct script access allowed');

! is_file(APPPATH . '/libraries/REST_Controller.php') ? die('CodeIgniter RestServer is missing') : null;

include_once(APPPATH . '/libraries/REST_Controller.php'); // Include Rest Controller

include_once(APPPATH . '/modules/nexopos_advanced/inc/traits_loader.php'); // Include from Nexo module dir

class Nexopos_advanced extends REST_Controller
{
    use deliveries,
        categories,
        departments,
        taxes,
        providers,
        units,
        customers,
        customers_groups,
        expenses_categories,
        expenses;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('nexopos');
        $this->load->library('session');
        $this->load->model('Options');
        $this->load->database();

        if (! $this->oauthlibrary->checkScope('core')) {
            $this->__forbidden();
        }
    }

    private function __success()
    {
        $this->response(array(
            'status'        =>    'success'
        ), 200);
    }

    /**
     * Display a error json status
     *
     * @return json status
    **/

    private function __failed()
    {
        $this->response(array(
            'status'        =>    'failed'
        ), 403);
    }

    /**
     * Return Empty
     *
    **/

    private function __empty()
    {
        $this->response(array(
        ), 200);
    }

    /**
     * Not found
     *
     *
    **/

    private function __404()
    {
        $this->response(array(
            'status'        =>    '404'
        ), 404);
    }

    /**
     * Forbidden
    **/

    private function __forbidden()
    {
        $this->response(array(
            'status'        =>    'forbidden'
        ), 403);
    }

    /**
     *  already exists
     *  @param void
     *  @return json
    **/

    private function __alreadyExists()
    {
        $this->response(array(
            'status'        =>    'alreadyExists'
        ), 403);
    }

}
