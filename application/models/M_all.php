<?php

class M_all extends CI_Model
{
    // ----menggunakan query sql----
    function select_menu_count()
    {
        return $this->db->query("SELECT kode, count(kode) FROM pesanan WHERE status='belum'");
    }
    function select_menu_count_bolean()
    {
        $cek = $this->db->query("SELECT kode, count(kode) FROM pesanan WHERE status='belum'")->num_rows();
        if($cek >= 1)
        {
            return true;
        }
        else {
            return false;
        }
    }
    function select_sum($table, $column)
    {
        return $this->db->query("SELECT SUM(".$column.") AS ".$column." FROM ".$table."");
    }
    function select_sum_where($table, $column, $where)
    {
        return $this->db->query("SELECT SUM(".$column.") AS ".$column." FROM ".$table." WHERE ".$where);
    }
    function select_sum2($table, $column, $column2)
    {
        return $this->db->query("SELECT SUM(".$column."*".$column2.") AS ".$column." FROM ".$table."");
    }
    function select_beetween($table, $where, $dateNow)
    {
        return $this->db->query("select * from ".$table." where ".$where." between '".$dateNow." 00:00:00' and '".$dateNow." 23:59:59'");
    }
    function select_select_beetween($select, $table, $where, $dateNow)
    {
        return $this->db->query('SELECT '.$select.' FROM '.$table.' WHERE '.$where.' between "'.$dateNow.' 00:00:00" and "'.$dateNow.' 23:59:59"');
    }
    function selectsum_select_join_2table_wherebeetween($select, $table, $table2, $on2, $where, $dateNow)
    {
        return $this->db->query("SELECT ".$select." FROM ".$table." LEFT JOIN ".$table2." ON ".$on2." where ".$where." between '".$dateNow." 00:00:00' and '".$dateNow." 23:59:59'");
    }
    function select_leftJoin_groupBy($select, $table, $join, $on, $groupBy)
    {
        return $this->db->query("SELECT ".$select." FROM ".$table." LEFT JOIN ".$join." ON ".$on." GROUP BY ".$groupBy);
    }
    function select_leftJoin2_groupBy($select, $table, $join, $join2, $on, $on2, $groupBy)
    {
        return $this->db->query("SELECT ".$select." FROM ".$table." LEFT JOIN ".$join." ON ".$on." LEFT JOIN ".$join2." ON ".$on2." GROUP BY ".$groupBy);
    }
    // ----/pakaiquery----
    function select_all($table)
    {
        return $this->db->get($table);
    }
    function select_all_order_by($select, $table, $order_by)
    {
       return $this->db->select($select)
        ->from($table)
        ->order_by($order_by)
        ->get();
    }
    function select_all_limit($table, $limit)
    {
        return $this->db->get($table)
        ->limit($limit);
    }
    function select_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    function select_select($select, $table)
    {
        $this->db->select($select);
        return $this->db->get($table);
    }
    function select_select_limit($select, $table, $limit)
    {
        return $this->db->select($select)
        ->from($table)
        ->limit($limit)
        ->get();
    }
    function select_select_like($select, $table, $like1, $like2, $like3)
    {
        return $this->db->select($select)
        ->from($table)
        ->like($like1, $like2, $like3)
        ->get();
    }
    function select_select_limit_orderBy($select, $table, $limit, $orderby)
    {
        return $this->db->select($select)
        ->from($table)
        ->limit($limit)
        ->order_by($orderby)
        ->get();
    }
    function select_select_orderBy($select, $table, $orderby)
    {
        return $this->db->select($select)
        ->from($table)
        ->order_by($orderby)
        ->get();
    }
    function select_select_limit_groupBy_orderBy($select, $table, $limit, $groupBy, $orderby)
    {
        return $this->db->select($select)
        ->from($table)
        ->limit($limit)
        ->group_by($groupBy)
        ->order_by($orderby)
        ->get();
    }
    function select_groupBy($select, $table, $groupBy)
    {
        return $this->db->select($select)
        ->from($table)
        ->group_by($groupBy)
        ->get();
    }
    function select_groupBy_where($select, $table, $groupBy, $where)
    {
        return $this->db->select($select)
        ->from($table)
        ->group_by($groupBy)
        ->where($where)
        ->get();
    }
    function select_leftJoin_groupBy_where($select, $table, $join, $on, $groupBy, $where)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->group_by($groupBy)
        ->where($where)
        ->get();
    }
    function select_leftJoin_orderBy($select, $table, $join, $on, $orderby)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->order_by($orderby)
        ->get();
    }
    function select_leftJoin_where_groupby_orderBy($select, $table, $join, $on, $where, $groupby, $orderby)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->where($where)
        ->group_by($groupby)
        ->order_by($orderby)
        ->get();
    }
    function select_leftJoin2_where_groupBy($select, $table, $join, $on, $join2, $on2, $groupBy, $where)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->join($join2,$on2, 'left')
        ->where($where)
        ->group_by($groupBy)
        ->get();
    }
    function select_leftJoin2_where_groupBy_orderBy($select, $table, $join, $on, $join2, $on2, $groupBy, $where, $order_by)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->join($join2,$on2, 'left')
        ->where($where)
        ->group_by($groupBy)
        ->order_by($order_by)
        ->get();
    }
    function select_leftJoin_where($select, $table, $join, $on, $where)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->where($where)
        ->get();
    }
    function select_leftJoin2_where($select, $table, $join, $on, $join2, $on2, $where)
    {
        return $this->db->select($select)
        ->from($table)
        ->join($join,$on, 'left')
        ->join($join2,$on2, 'left')
        ->where($where)
        ->get();
    }
    function select_select_where($select, $table, $where)
    {
        return $this->db->select($select)
        ->from($table)
        ->where($where)
        ->get();
    }
    function select_select_where_limit($select, $table, $where, $limit)
    {
        return $this->db->select($select)
        ->from($table)
        ->where($where)
        ->limit($limit)
        ->get();
    }
    function select_select_where_orderBy($select, $table, $where, $order_by)
    {
        return $this->db->select($select)
        ->from($table)
        ->where($where)
        ->order_by($order_by)
        ->get();
    }
    function select_select_where_join_2table_type($select, $table1, $table2, $on, $where, $type)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->where($where)
        ->get();
    }
    function select_select_join_2table_type_orderBy($select, $table1, $table2, $on, $type, $orderBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->order_by($orderBy)
        ->get();
    }
    function select_select_where_join_2table_type_orderBy($select, $table1, $table2, $on, $where, $type, $orderBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->where($where)
        ->order_by($orderBy)
        ->get();
    }
    function select_select_where_join_2table_type_limit_orderBy($select, $table1, $table2, $on, $where, $type, $limit, $orderby)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->where($where)
        ->limit($limit)
        ->order_by($orderby)
        ->get();
    }
    function select_select_join_2table_type($select, $table1, $table2, $on, $type)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->get();
    }
    function select_select_join_2table_type_like($select, $table1, $table2, $on, $type, $like)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->like($like)
        ->get();
    }
    function select_select_join_2table_type_limit_orderBy($select, $table1, $table2, $on, $type, $limit, $orderby)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->limit($limit)
        ->order_by($orderby)
        ->get();
    }
    function select_select_join_2table_type_limit_groupBy_orderBy($select, $table1, $table2, $on, $type, $limit, $groupBy, $orderby)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->limit($limit)
        ->group_by($groupBy)
        ->order_by($orderby)
        ->get();
    }
    function select_select_join_2table_type_where_limit_groupBy_orderBy($select, $table1, $table2, $on, $type, $where, $limit, $groupBy, $orderby)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->where($where)
        ->limit($limit)
        ->group_by($groupBy)
        ->order_by($orderby)
        ->get();
    }
    function select_select_sum_join_2table_type($select, $selectSum, $table1, $table2, $on, $type, $groupBy)
    {
        return $this->db->select($select)
        ->select_sum($selectSum)
        ->from($table1)
        ->join($table2, $on, $type)
        ->group_by($groupBy)
        ->get();
    }
    function select_select_join_2table_type_groupBy($select, $table1, $table2, $on, $type, $groupBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->group_by($groupBy)
        ->get();
    }
    function select_select_join_2table_where_type_groupBy($select, $table1, $table2, $on, $type, $where, $groupBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on, $type)
        ->where($where)
        ->group_by($groupBy)
        ->get();
    }
    function select_select_where_join_3table_type($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $where)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->where($where)
        ->get();
    }
    function select_select_where_join_3table_type_groupBy($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $where, $groupBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->where($where)
        ->group_by($groupBy)
        ->get();
    }
    function select_select_where_join_3table_type_orderBy($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $where, $orderBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->where($where)
        ->order_by($orderBy)
        ->get();
    }
    function select_select_sum_join_3table_type($select, $selectSum, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $groupBy)
    {
        return $this->db->select($select)
        ->select_sum($selectSum)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->group_by($groupBy)
        ->get();
    }
    function select_select_join_3table_type($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->get();
    }
    function select_select_join_4table_type($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $table4, $on4, $type4)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->join($table4, $on4, $type4)
        ->get();
    }
    function select_select_where_join_4table_type($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $table4, $on4, $type4, $where)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->join($table4, $on4, $type4)
        ->where($where)
        ->get();
    }
    function select_select_where_join_4table_type_groupBy($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $table4, $on4, $type4, $where, $groupBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->join($table4, $on4, $type4)
        ->where($where)
        ->group_by($groupBy)
        ->get();
    }
    function select_select_where_join_5table_type_groupBy($select, $table1, $table2, $on2, $type2, $table3, $on3, $type3, $table4, $on4, $type4, $table5, $on5, $type5, $where, $groupBy)
    {
        return $this->db->select($select)
        ->from($table1)
        ->join($table2, $on2, $type2)
        ->join($table3, $on3, $type3)
        ->join($table4, $on4, $type4)
        ->join($table5, $on5, $type5)
        ->where($where)
        ->group_by($groupBy)
        ->get();
    }
    function insert_data($table, $data)
    {
        $insert_query = $this->db->insert_string($table, $data);
        $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        $this->db->query($insert_query);
        //$this->db->insert($table, $data);
    }
    function delete_data($table, $where)
    {
        $this->db->delete($table, $where);
    }
    function update_data($table, $set, $where)
    {
        $this->db->from($table)
        ->where($where)
        ->set($set)
        ->update();
    }
    public function insertBatch($table, $data)
    {
        $this->db->insert_batch($table, $data); 
    }
	public function updateBatch($table, $set, $where)
	{
		$this->db->update_batch($table ,$set, $where); 
	}

    public function fun_produk_search($select, $table1, $table2, $on, $where, $orderBy)
    {
        return $this->db->query("SELECT ".$select." FROM ".$table1." LEFT JOIN ".$table2." ON ".$on." WHERE ".$where." GROUP BY produk.id ORDER BY ".$orderBy);

    }
    public function get_star()
    {
        $produk = $this->select_all('produk')->result();

        foreach ($produk as $a) {
            $where = array('id_produk' => $a->id, );
            $nama = $a->id;
            $data[$nama] = $this->M_admin->select_select_where('AVG(star) as star', 'comment', $where)->row_array();
        }
        return $data;
    }

    public function select_select_where_month_and_year($select, $table, $where)
    {
        return $this->db->query('SELECT '.$select.' FROM '.$table.' WHERE '.$where);
    }
    public function select_query($query)
    {
        return $this->db->query($query);
    }
}