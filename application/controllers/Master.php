<?php

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');
date_default_timezone_set("UTC");

require APPPATH . 'libraries/Authentication.php';
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

// use chriskacerguis\RestServer\Format;
use chriskacerguis\RestServer\RestController;
use Reservation\Libraries\Authentication;

/**
 * all done with a dynamic code
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 */
class Master extends RestController
{
    protected $data;
    //protected $db;

    protected $user_login_validation = [
        [
            'field' => 'username',
            'rules' => 'required',
            'errors' => [
                'required' => 'Username is required',
            ],
        ],
        [
            'field' => 'password',
            'rules' => 'required',
            'errors' => [
                'required' => 'Password is required',
            ],
        ]
    ];

    protected $user_register_validation = [
        [
            'field' => 'name',
            'rules' => 'required',
            'errors' => [
                'required' => 'Name is required',
            ],
        ],
        [
            'field' => 'email',
            'rules' => 'required',
            'errors' => [
                'required' => 'Email is required',
            ],
        ],
        [
            'field' => 'phone',
            'rules' => 'required',
            'errors' => [
                'required' => 'Phone is required',
            ],
        ],
        [
            'field' => 'username',
            'rules' => 'required',
            'errors' => [
                'required' => 'Username is required',
            ],
        ],
        [
            'field' => 'password',
            'rules' => 'required',
            'errors' => [
                'required' => 'Password is required',
            ],
        ],[
            'field' => 'roles',
            'rules' => 'required',
            'errors' => [
                'required' => 'Roles is required',
            ],
        ]
    ];

    function __construct()
    {
        parent::__construct();
        $this->def_db = $this->load->database('default', true);
    }

    //USER ALL
    public function user_all_get()
    {
        $get_profile = $this->def_db->select('id, name')->where('roles', 'customer')->get('users');

            if ($get_profile->num_rows() > 0) {
                $this->response([
                    'data' => $get_profile->result(),
                    'message' => 'success',
                    'status' => $this::HTTP_OK
                ], $this::HTTP_OK);
            } else {
                $this->response([
                    'data' => array(),
                    'message' => 'Not Found',
                    'status' => $this::HTTP_NOT_FOUND
                ], $this::HTTP_NOT_FOUND);
            }
    }

    //USER LOGIN
    public function user_login_post()
    {
        $this->load->library('form_validation');

        $data = $this->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($this->user_login_validation);

        if ($this->form_validation->run()) {
            $get_profile = $this->def_db->select('*')->where('username', $this->post('username'))->where('password', md5($this->post('password')))->get('users');

            if ($get_profile->num_rows() > 0) {
                $this->response([
                    'data' => $get_profile->row(),
                    'message' => 'success',
                    'status' => $this::HTTP_OK
                ], $this::HTTP_OK);
            } else {
                $this->response([
                    'data' => array(),
                    'message' => 'Not Found',
                    'status' => $this::HTTP_NOT_FOUND
                ], $this::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'data' => array(),
                'message' => $this->form_validation->error_array(),
                'status' => $this::HTTP_NOT_FOUND
            ], $this::HTTP_NOT_FOUND);
        }
    }

    //USER REGISTER
    public function user_register_post()
    {
        $this->load->library('form_validation');

        $data = $this->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($this->user_register_validation);

        if ($this->form_validation->run()) {
            $this->def_db->insert('users', [
                'name' => $this->post('name'),
                'email' => $this->post('email'),
                'phone' => $this->post('phone'),
                'username' => $this->post('username'),
                'password' => md5($this->post('password')),
                'roles' => $this->post('roles')
            ]);

            if ($this->def_db->affected_rows() > 0) {
                $this->response([
                    'data' => array(),
                    'message' => 'success',
                    'status' => $this::HTTP_OK
                ], $this::HTTP_OK);
            } else {
                $this->response([
                    'data' => array(),
                    'message' => 'Failed',
                    'status' => $this::HTTP_INTERNAL_ERROR
                ], $this::HTTP_INTERNAL_ERROR);
            }
        } else {
            $this->response([
                'data' => array(),
                'message' => $this->form_validation->error_array(),
                'status' => $this::HTTP_NOT_FOUND
            ], $this::HTTP_NOT_FOUND);
        }
    }
}
