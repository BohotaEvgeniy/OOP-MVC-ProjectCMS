<?php
/**
 * Created by PhpStorm.
 * User: Evil Genius
 * Date: 06.11.2017
 * Time: 19:24
 */

class Pages extends Database
{
    /*public function __construct()
    {
        parent::__construct();
    }*/

    public function addPage($page)
    {
        if(empty($page)) {
            return false;
        }
        foreach ($page as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO pages ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        return $this->resId();
    }

    public function getPage($path)
    {
        if(empty($path)) {
            return false;
        }
        $query = "SELECT id, name, url, description, visible FROM pages WHERE url = '$path'";
        $this->query($query);
        return $this->result();
    }
    public function getPages()
    {
        $query = "SELECT id, name, url, description,visible FROM pages";
        $this->query($query);
        return $this->results();
    }

    public function updatePages($id, $page)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($page as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE pages SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }
}