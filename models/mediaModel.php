<?php

require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/prepare_funcs.php';
/**
 * Model for media table basic crud to advenced search
 *
 */
class MediaModel extends Connection
{
    private $table_name = "media";
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
     * Summary of description
     * @var string media description or content
     */
    public $description;
    /**
     * Summary of images
     * @var string explod images path
     */
    public $images;
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
            $query = prepare_insert_query(
                parent::$connection,
                $this->table_name,
                array(
                    // "id" => $this->id,
                    "title" => $this->title,
                    "description" => $this->description,
                    "images" => $this->images,
                )
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

    public function update()
    {
        try {

            $datas = array(
                "title" => $this->title,
                "description" => $this->description,
            );
            if (isset($this->images)) {
                $datas["images"] = $this->images;
            }
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

// $media = new MediaModel();
// // $media->id = 2;
// // // print_r($media->get_all());
// $media->title = "Something";
// $media->description = "Some desc";
// // $media->images = "Image1, Image2 up. Image3";
// // $media->update();
// $media->extra = [
//     "search_term" => "s",
//     "columns" => [
//         "title",
//         "description"
//     ]
// ];

// print_r($media->search());