<?php

class Parent_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_info($data) {
        return $this->db->insert($this->db->dbprefix('parent'), $data);
    }

    public function get_by_id($id) {
        return $this->db->select('*')
                ->from($this->db->dbprefix('parent'))
                ->where('parent_id', $id)
                ->get()->result();
    }

    public function get_join_child() {
        return $this->db->select('pv_parent.*, pv_child.*, pv_child.name as child_name, pv_parent.name as parent_name')
                ->from($this->db->dbprefix('parent'))
                ->join('pv_child', 'pv_parent.child_id = pv_child.child_id', 'inner')
                ->get()->result();
    }

    public function get_detail_by_id($id){
        return $this->db->select('pv_parent.*, pv_child.*, pv_child.name as child_name, pv_parent.name as parent_name, pv_child.sex as child_sex, pv_parent.sex as parent_sex ,pv_volunteer_info.*')
                ->from($this->db->dbprefix('parent'))
                ->join('pv_child', 'pv_parent.child_id = pv_child.child_id', 'left')
                ->join('pv_volunteer_info', 'pv_parent.parent_id = pv_volunteer_info.parent_id', 'left')
                ->where('pv_parent.parent_id', $id)
                ->get()->result();

    }

    public function update_info($data) {
        $where = "parent_id = {$data['parent_id']}";
        return $this->db->update($this->db->dbprefix('parent'), $data, $where);
    }

    public function get_join_child_where($data) {
        $sql = $this->db->select('p.*, c.*, c.name as child_name, p.name as parent_name, v.*')
            ->from($this->db->dbprefix('parent') . ' p')
            ->join($this->db->dbprefix('child') . ' c', 'c.child_id = p.child_id')
            ->join($this->db->dbprefix('volunteer_info') . ' v', 'v.parent_id = p.parent_id');
        if (isset($data['entrance'])) {
            $entrance = '(';
            foreach ($data['entrance'] as $key => $value) {
                if ($key != 0) {
                    $entrance .= ',';
                }
                $entrance .= "'$value'";
            }
            $entrance .= ')';
            $this->db->where("c.entrance in $entrance");
        }
        if ($data['relationship'] != '') {
            $this->db->where('p.relation', $data['relationship']);
        }
        if (isset($data['ability'])) {
            $this->db->where($this->get_query_where('ability', $data));
        }
        if (isset($data['service'])) {
            $this->db->where($this->get_query_where('service', $data));
        }
        if (isset($data['tutor'])) {
            $this->db->where($this->get_query_where('tutor', $data));
        }
        if (isset($data['lecture'])) {
            $this->db->where($this->get_query_where('lecture', $data));
        }
        $results = $this->db->get()->result();
        // $results = $this->db->get_compiled_select();

        if (isset($data['week']) || isset($data['timerange'])) {
            $secondRes = [];
            foreach ($results as $result) {
                $oriWeek = $result->week;
                $flag = true;
                if (isset($data['week'])) {
                    foreach ($data['week'] as $key => $week) {
                        if ($oriweek[$week-1] == 1) {
                            $seconRes[] = $result;
                            $flag = false;
                            continue;
                        }
                    }
                }

                if ($flag && isset($data['timerange'])) {
                    foreach ($result->timerange as $key => $timerange) {
                        if (in_array($timerange, $data['timerange'])) {
                            $scondeRes[] = $result;
                            contiue;
                        }
                    }
                }
            }
            return $scondeRes;
        } else {
            return $results;
        }
    }

    public function get_relation_name($num, $name = null) {
        switch ($num) {
            case 1: {
                return '孩子';
            }
            case 2: {
                return '父亲';
            }
            case 3: {
                return '母亲';
            }
            case 4: {
                return ($name == '') ? '其他' : $name;
            }
        }
    }

    protected function get_query_where($kind, $data) {
        $query = '(';
        foreach ($data[$kind] as $key => $value) {
            if ($key != 0) {
                $query .= ' OR ';
            }
            $query .= "$value = '1'";
        }
        $query .= ')';
        return $query;
    }
}
