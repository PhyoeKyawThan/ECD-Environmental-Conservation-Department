<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/prepare_funcs.php';
class CategoryModel extends Connection
{
    private $table_name = "categories";
    public function get_all()
    {
        try {
            // $select_kws = "id, slug";
            $query = prepare_select_all(
                parent::$connection,
                $this->table_name,
                null,
                $order = "ASC"
            );
            return $query->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("Error while getting category: " . $e);
        }
    }

    /**
     * Summary of convert_array
     * @return void
     */
    public function convert_array():array{
        $datas = $this->get_all();
        $result = array();
        foreach($datas as $data){ // id => 1, slug => "media"
            if(isset($data["id"]) && isset($data["slug"])){
                $result[$data["slug"]] = $data["id"];
            }
        }
        return $result;
    }

}