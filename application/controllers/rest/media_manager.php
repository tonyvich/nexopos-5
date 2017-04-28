<?php
defined('BASEPATH') or exit('No direct script access allowed');

! is_file(APPPATH . '/libraries/REST_Controller.php') ? die('CodeIgniter RestServer is missing') : null;

include_once(APPPATH . '/libraries/REST_Controller.php'); // Include Rest Controller

include_once(APPPATH . '/modules/media-manager/inc/traits_loader.php'); // Include media_manager traits

class media_manager extends REST_Controller
{
    use medias;

    public function __construct()
    {
        parent::__construct();
          
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
