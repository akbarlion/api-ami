<?php

class M_audit extends CI_Model
{
    // M_All
    public function select_all($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function select_where($table, $where)
    {
        return $this->db->get_where($table, $where)->result_array();
    }

    public function update_data($table, $set, $where)
    {
        $this->db->from($table)->where($where)->set($set)->update();
        return $this->db->affected_rows();
    }

    // Murni
    public function event_get($start_date, $end_date, $branch_id)
    {
        // $this->db->select('GROUP_CONCAT(DISTINCT dl.anggota) AS mapping_anggota, cab.branch_name, emp.branch_id AS cabang_auditee, d.*');
        // $this->db->from('mst_trans d');
        // $this->db->join('mst_trans_anggota dl', 'dl.event_id = d.event_id', 'left');
        // $this->db->join('divisi_lab_mst cab', 'cab.id = d.branch_id', 'left');
        // $this->db->join('employee_mst emp', 'emp.branch_id = cab.id', 'left');
        // $this->db->where();
        // $this->db->group_by('d.event_id');

        $this->db->select('GROUP_CONCAT(DISTINCT dl.anggota) AS mapping_anggota, cab.branch_name, emp.branch_id AS cabang_auditee, d.*');
        $this->db->from('mst_trans d');
        $this->db->join('mst_trans_anggota dl', 'dl.event_id = d.event_id', 'left');
        $this->db->join('divisi_lab_mst cab', 'cab.id = d.branch_id', 'left');
        $this->db->join('employee_mst emp', 'emp.branch_id = cab.id', 'left');
        $this->db->where(
            '(
        (d.start_date IS NULL AND d.end_date IS NULL)
        OR
        ("' . $start_date . '" BETWEEN d.start_date AND d.end_date)
        OR
        ("' . $end_date . '" BETWEEN d.start_date AND d.end_date)
    )'
        );
        $this->db->group_by('d.event_id');

        $conditions = array();

        // if ($start_date) {
        //     $conditions['d.start_date '] = $start_date;
        // }

        // if ($end_date) {
        //     $conditions['d.end_date >='] = $end_date;
        // }


        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        if ($branch_id) {
            // $conditions['d.branch_id'] = $branch_id;
            $this->db->where_in('d.branch_id', $branch_id);
        }

        return $this->db->get()->result_array();
    }

    public function audit_get($branch_id, $departemen_id)
    {
        $this->db->select('mst_anggota.anggota AS asesor,
         mst.branch_id,
         MAX(file.file_name) AS filename,
         MAX(file.id) AS id_file,
         det.*');
        $this->db->from('det_trans as det');
        $this->db->join('mst_trans_anggota as mst_anggota', 'mst_anggota.id = det.ass_id', 'left');
        $this->db->join('mst_trans as mst', 'mst.event_id = det.event_id', 'left');
        $this->db->join('det_trans_file as file', 'det.id = file.det_id', 'left');
        $this->db->group_by('det.id');
        // $this->db->where('det.is_pending = 0');

        $conditions = array();
        if ($branch_id) {
            $conditions['mst.branch_id'] = $branch_id;
        }

        if ($departemen_id) {
            $conditions['det.departemen_id'] = $departemen_id;
        }


        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        return $this->db->get()->result_array();
    }

    public function approval_get($branch_id, $departemen_id, $status_id)
    {
        $this->db->select('
        mst.branch_id,
        MAX(file.file_name) AS filename,
        dep.division_name,
        divlab.branch_name AS cabang,
        det.*,
    ');
        $this->db->from('mst_trans mst');
        $this->db->join('det_trans det', 'det.event_id = mst.event_id', 'left');
        $this->db->join('det_trans_file file', 'file.det_id = det.id', 'left');
        $this->db->join('departemen_mst dep', 'dep.id = det.departemen_id', 'left');
        $this->db->join('divisi_lab_mst divlab', 'divlab.id = mst.branch_id', 'left');
        $this->db->group_by('det.id');

        $conditions = array();

        if ($branch_id) {
            $conditions['mst.branch_id'] = $branch_id;
        }

        if ($departemen_id) {
            $this->db->where_in('det.departemen_id', $departemen_id);
        }

        if ($status_id) {
            $conditions['det.status_id'] = $status_id;
        }


        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        return $this->db->get()->result_array();

    }

    // public function detail_get($branch_id, $departemen_id, $id)
    // {
    //     $this->db->select('
    //     mst.branch_id,
    //     MAX(file.file_name) AS filename,
    //     dep.division_name,
    //     divlab.branch_name AS cabang,
    //     det.*,
    // ');
    //     $this->db->from('mst_trans mst');
    //     $this->db->join('det_trans det', 'det.event_id = mst.event_id', 'left');
    //     $this->db->join('det_trans_file file', 'file.det_id = det.id', 'left');
    //     $this->db->join('departemen_mst dep', 'dep.id = det.departemen_id', 'left');
    //     $this->db->join('divisi_lab_mst divlab', 'divlab.id = mst.branch_id', 'left');

    //     $conditions = array();

    //     if ($branch_id) {
    //         $conditions['mst.branch_id'] = $branch_id;
    //     }

    //     if ($departemen_id) {
    //         $conditions['det.departemen_id'] = $departemen_id;
    //     }

    //     if ($id) {
    //         $conditions['det.id'] = $id;
    //     }


    //     if (!empty($conditions)) {
    //         $this->db->where($conditions);
    //     }

    //     return $this->db->get()->result_array();

    // }

    public function pengajuan_get()
    {
        $this->db->select('
        mst.branch_id,
        MAX(file.file_name) AS filename,
        dep.division_name,
        divlab.branch_name AS cabang,
        det.*,
    ');
        $this->db->from('mst_trans mst');
        $this->db->join('det_trans det', 'det.event_id = mst.event_id', 'left');
        $this->db->join('det_trans_file file', 'file.det_id = det.id', 'left');
        $this->db->join('departemen_mst dep', 'dep.id = det.departemen_id', 'left');
        $this->db->join('divisi_lab_mst divlab', 'divlab.id = mst.branch_id', 'left');
        $this->db->group_by('det.id');

        $conditions = array();

    }

    // public function insert_data($table, $data)
    // {
    //     $insert_query = $this->db->insert_string($table, $data);
    //     $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
    //     $this->db->query($insert_query);
    //     //$this->db->insert($table, $data);
    // }

    public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function insert_event($data_mst, $mapping_auditor)
    {
        $this->db->trans_begin();
        $this->db->insert('mst_trans', $data_mst);

        for ($x = 0; $x < sizeof($mapping_auditor); $x++) {
            $data_auditor[$x]['event_id'] = $data_mst['event_id'];
            $data_auditor[$x]['anggota'] = $mapping_auditor[$x];
        }
        $this->db->insert_batch('mst_trans_anggota', $data_auditor);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $this->db->trans_status();
    }

    // public function update_data($table, $set, $where)
    // {
    //     $this->db->from($table)
    //         ->where($where)
    //         ->set($set)
    //         ->update();

    //     return $this->db->affected_rows();
    // }

    public function update_insert($data_where, $data_update, $data_insert)
    {
        $this->db->trans_begin();

        $this->db->from('det_trans')->where(array('id' => $data_where))->set($data_update)->update();

        $this->db->insert('det_trans_file', $data_insert);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $this->db->trans_status();
    }

}