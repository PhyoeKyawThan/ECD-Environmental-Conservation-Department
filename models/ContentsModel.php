<?php

require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/prepare_funcs.php';
/**
 * Model for media table basic crud to advenced search
 *
 */
class ContentsModel extends Connection
{
    private $foreign_table = "categories";
    private $table_name = "contents";
    /**
     * Summary of id
     * @var int media id
     */
    public $id;
    /**
     * Summary of title
     * @var string media title or topic
     */
    public $title;
    /**
     * Summary of body
     * @var string media body or content
     */
    public $body;
    /**
     * Summary of images
     * @var string explod images path
     */
    public $images;
    /**
     * Summary of category
     * @var int category id to separate contents
     */
    public $category_id;
    /**
     * Summary of documents
     * @var string other documents like google docx or something like tis
     */
    public $documents;
    /**
     * Summary of uploaded_at
     * @var DateTime just by default timezone
     */

    /**
     * Summary of status
     * @var string draft or published
     */
    public $status = "draft";
    public $uploaded_at;
    /**
     * Additional search parameters.
     *
     * Format:
     * [
     *   "search_term" => string,
     *   "columns" => string[]
     * ]
     *
     * @var array<string, mixed>
     */
    public $extra;


    /**
     * Adding new media data to database 
     * @return bool insertion success or not
     */
    public function add()
    {
        try {
            $datas = array(
                // "id" => $this->id,
                "title" => $this->title,
                "body" => $this->body,
                // "images" => $this->images,
                "category_id" => $this->category_id,
                "status" => $this->status
            );
            if (isset($this->images)) {
                $datas["images"] = $this->images;
            }
            $query = prepare_insert_query(
                parent::$connection,
                $this->table_name,
                $datas
            );
            return $query->execute();
        } catch (Exception $e) {
            die("Error in adding media: " . $e);
        }
    }

    public function get()
    {
        try {
            $query = prepare_select(
                parent::$connection,
                $this->table_name,
                $this->id,
            );
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc();

            return $result;
        } catch (Exception $e) {
            die("Error occur while fetching media data");
        }
    }

    public function get_all()
    {
        try {
            $query = prepare_select_all(
                parent::$connection,
                $this->table_name,
            );
            $result = $query->fetch_all(MYSQLI_ASSOC);
            return $result;
        } catch (Exception $e) {
            die("Error occur while fetching media data");
        }
    }

    public function search()
    {
        // format ["search_term" => "string", "columns" => ["colum1", colum2"]]
        try {
            $query = prepare_search_query(
                parent::$connection,
                $this->table_name,
                $this->extra["columns"],
                $this->extra["search_term"]
            );
            $query->execute();
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("Error while searching");
        }
    }

    /**
     * Summary of filter_data
     * @param array<string, mixed> $data_array 
     * @return array filtered data which have the value of null to avoid sql error
     */
    private function filter_data($data_array){
        $datas = array();
        foreach($data_array as $key => $value){
            if(isset($value)){
                $datas[$key] = $value;
            }
        }
        return $datas;
    }
    public function update()
    {
        try {

            $datas = array(
                "title" => $this->title,
                "body" => $this->body,
                "status" => $this->status,
                "documents" => $this->documents,
                "images" => $this->images,
                "category_id" => $this->category_id,
            );
            // if(isset($this->category_id)){
            //     $datas["category_id"] = $this->category_id;
            // }
            // if(isset($this->documents)){
            //     $datas["documents"] = $this->documents;
            // }
            // if (isset($this->images)) {
            //     $datas["images"] = $this->images;
            // }
            $datas = $this->filter_data($datas);
            $datas["id"] = $this->id;
            $query = prepare_update_query(
                parent::$connection,
                $this->table_name,
                $datas
            );
            return $query->execute();
        } catch (Exception $e) {
            die("Error in updating media: " . $e);
        }
    }

    public function delete()
    {
        try {
            $query = prepare_delete_query(
                parent::$connection,
                $this->table_name,
                $this->id,
            );

            return $query->execute();
        } catch (Exception $e) {
            die("Error in deleting media: " . $e);
        }
    }
    private function convert_image()
    {

    }
}

// $contents = new ContentsModel();
// $contents->id = 8;
// $contents->title = "News updated";
// $contents->body = "News Body";
// $contents->category_id = 3;
// $contents->update();
// print_r($contents->get_all());