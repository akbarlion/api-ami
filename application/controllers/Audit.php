<?php

// require APPPATH . 'libraries/Authentication.php';
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Audit extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_audit', 'data_audit');
        $this->load->helper('download');
    }

    public function event_post()
    {
        $start_date = $this->post('start_date');
        $end_date = $this->post('end_date');
        $branch_id = $this->post('branch_id');

        $event = $this->data_audit->event_get($start_date, $end_date, $branch_id);
        if ($event) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $event
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function approval_post()
    {
        $approval = $this->data_audit->approval_get(
            $this->post('branch_id'),
            $this->post('departemen_id'),
            $this->post('status_id')
        );
        if ($approval) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $approval
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function detail_id_post()
    {
        $detail = $this->data_audit->detail_get(
            $this->post('branch_id'),
            $this->post('departemen_id'),
            $this->post('id')
        );
        if ($detail) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $detail
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function approve_post()
    {
        $data_where = $this->post('id');
        $result = $this->data_audit->update_data('det_trans', array('status_id' => $this->post('status_id'), 'notes' => $this->post('notes')), array('id' => $data_where));
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $result
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function reject_post()
    {
        $data_where = $this->post('id');
        $data_set = [
            'status_id' => $this->post('status_id'),
            'notes' => $this->post('notes')
        ];
        $result = $this->data_audit->update_data('det_trans', $data_set, array('id' => $data_where));
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $result
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function departemen_get()
    {
        $departemen = $this->data_audit->select_all('departemen_mst');
        if ($departemen) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $departemen
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function status_get()
    {
        $status = $this->data_audit->select_all('status_mst');
        if ($status) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $status
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_NOT_FOUND);
        }
    }


    public function divisi_lab_get()
    {
        $branch = $this->data_audit->select_all('divisi_lab_mst');
        if ($branch) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Menampilkan Data',
                'data' => $branch
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menampilkan Data / Ada Kesalahan'
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function employee_get()
    {
        $employee = $this->data_audit->select_all('employee_mst');
        if ($employee) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil menampilkan data',
                'data' => $employee
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menampilkan data / ada kesalahan',
                'data' => null
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function add_event_post()
    {

        $data_mst = [
            'event_id' => $this->post('event_id'),
            'start_date' => $this->post('start_date'),
            'end_date' => $this->post('end_date'),
            'branch_id' => $this->post('branch_id'),
            'event_name' => $this->post('event_name'),
            'event_category' => $this->post('event_category')
        ];

        $anggota = $this->post('anggota');


        $saved_event = $this->data_audit->insert_event($data_mst, $anggota);
        if ($saved_event == TRUE) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil input data',
                'data' => $saved_event
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal input data / ada kesalahan',
                'data' => null
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function select_auditor_post()
    {
        $event_id = $this->post('event_id');

        $auditor = $this->data_audit->select_where('mst_trans_anggota', array('event_id' => $event_id));
        if ($auditor) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil menampilkan data',
                'data' => $auditor
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menampilkan data / ada kesalahan',
                'data' => null
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function select_auditee_post()
    {
        $branch_auditee = $this->post('branch_id');
        $res = $this->data_audit->select_where('employee_mst', array('branch_id' => $branch_auditee));
        if ($res) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil menampilkan data',
                'data' => $res
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menampilkan data / ada kesalahan',
                'data' => null
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function add_audit_post()
    {
        $data_det = [
            'event_id' => $this->post('event_id'),
            'ass_id' => $this->post('ass_id'),
            'status_id' => $this->post('status_id'),
            'description' => $this->post('description'),
            'audit_date' => $this->post('audit_date'),
            'correction_category' => $this->post('correction_category'),
            'auditee' => $this->post('auditee'),
            'bidang_audit' => $this->post('bidang_audit'),
            'pasal' => $this->post('pasal'),
            'saran' => $this->post('saran'),
            'analisa_penyebab' => $this->post('analisa_penyebab'),
            'koreksi' => $this->post('koreksi'),
            'tindakan_korektif' => $this->post('tindakan_korektif'),
            //
            'tgl_koreksi' => $this->post('tgl_koreksi'),
            'departemen_id' => $this->post('departemen_id'),
            'tgl_deadline' => $this->post('tgl_deadline'),
            'tgl_verifikasi' => $this->post('tgl_verifikasi')
        ];

        $saved_det = $this->data_audit->insert_data('det_trans', $data_det);
        if ($saved_det) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil menambahkan data',
                'data' => $saved_det
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menampilkan data / ada kesalahan',
                'data' => null
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function record_audit_post()
    {
        $data = $this->data_audit->audit_get($this->post('branch_id'), $this->post('departemen_id'));
        if ($data) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil menambahkan data',
                'data' => $data
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menampilkan data / ada kesalahan',
                'data' => null
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function auditee_post()
    {
        $data_auditee = [
            'analisa_penyebab' => $this->post('analisa_penyebab'),
            'koreksi' => $this->post('koreksi'),
            'tindakan_korektif' => $this->post('tindakan_korektif'),
            'tgl_koreksi' => $this->post('tgl_koreksi'),
            'status_id' => $this->post('status_id')
        ];
        $data_where = $this->post('id');
        $saved = $this->data_audit->update_data('det_trans', $data_auditee, array('id' => $data_where));
        if ($saved) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil menambahkan data',
                'data' => $saved
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menampilkan data / ada kesalahan',
                'data' => null
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function auditee_file_post()
    {
        $file = $_FILES['file_name'];
        $path = "uploads/AMI/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path_file = "";
        if (!empty($file['name'])) {
            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = "pdf";
            // $config['']s
            $timestamp = time();
            // $newFileName = str_replace('\\', '/', $file['name']);
            $newFileName = $this->post('file_name');
            $config['file_name'] = $this->post('id');
            $newFileName = $this->post('id');
            $config['file_name'] = $timestamp . '-' . $newFileName;

            $this->upload->initialize($config);
            if ($this->upload->do_upload('file_name')) {
                //Get file upload
                $uploadedData = $this->upload->data();
                // $path_file = './' . $path . $uploadedData['file_name'];
                $path_file = $uploadedData['file_name'];
            }
        }

        $data_where_id_trans = $this->post('id');
        $data_det_trans = [
            'analisa_penyebab' => $this->post('analisa_penyebab'),
            'koreksi' => $this->post('koreksi'),
            'tindakan_korektif' => $this->post('tindakan_korektif'),
            'status_id' => $this->post('status_id')
        ];

        $data_file_trans = [
            'det_id' => $data_where_id_trans,
            'event_id' => $this->post('event_id'),
            'file_name' => $path_file,
            'ref_korektif' => $this->post('ref_korektif'),
            'ref_temuan' => $this->post('ref_temuan')
        ];

        $saved_file = $this->data_audit->update_insert($data_where_id_trans, $data_det_trans, $data_file_trans);
        if ($saved_file == TRUE) {
            $this->response([
                'result' => true,
                'message' => 'Berhasil Menambahkan Data',
                'data' => $saved_file
            ], self::HTTP_OK);
        } else {
            $this->response([
                'result' => false,
                'message' => 'Gagal Menambahkan Data / Ada Kesalahan',
                'data' => null
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function preview_post()
    {
        $param = $this->post();
        $det_id = $param['det_id'];
        $fileName = $param['file_name'];
        if ($fileName) {
            $path = "uploads/AMI/";
            $file_path = $path . $fileName;
        }

        $result = $this->data_audit->select_where('det_trans_file', array('det_id' => $det_id, 'file_name' => $fileName));
        if ($result) {
            header('Content-Type: application/pdf');
            readfile($file_path);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menolak Data',
                'data' => null
            ], self::HTTP_BAD_REQUEST);
        }
    }

    public function download_document_post()
    {
        $param = $this->post();
        $id = $param['id'];
        $file_name = $param['file_name'];
        if ($file_name) {
            $path = "uploads/AMI/";
            $file_path = $path . $file_name;
        }

        $file_info = pathinfo($file_path);
        $file_extension = strtolower($file_info['extension']);

        // Set the Content-Type header based on the file extension
        if ($file_extension == 'pdf') {
            header('Content-Type: application/pdf');
        } else if ($file_extension == 'docx' || $file_extension == 'doc') {
            header('Content-Type: application/msword');
        } else if ($file_extension == 'xlsx' || $file_extension == 'xls') {
            header('Content-Type: application/vnd.ms-excel');
        } else if ($file_extension == 'vsd' || $file_extension == 'vsdx') {
            header('Content-Type: application/vnd.visio');
        } else {
            // Handle other file types or return an error
            header('Content-Type: application/octet-stream');
        }

        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        readfile($file_path);
        force_download($file_name, file_get_contents($file_path));
    }



}