<?php
session_start();
require_once __DIR__ . '/ContentsModel.php';
require_once __DIR__ . '/prepare_funcs.php';
class MediaModel extends ContentsModel
{
    private $category = "media";
    // private $category_id = 
    public function get_all()
    {
        try {
            $query = prepare_raw_query(parent::$connection, "
            SELECT 
            contents.id, 
            contents.title,
            contents.body,
            contents.images,
            contents.uploaded_at,
            contents.status,
            categories.id AS category_id,
            categories.name AS category_name,
            categories.slug AS category_slug
            FROM contents JOIN categories ON contents.category_id = categories.id WHERE categories.id = ? ORDER BY contents.uploaded_at DESC", $_SESSION["categories"]["media"]);
            $query->execute();
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("Error on getting all media contents: $e");
        }

    }
}

$media = new MediaModel();
print_r($media->get_all());
// print_r($_SESSION["categories"]);