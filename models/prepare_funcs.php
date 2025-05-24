<?php
require_once __DIR__ . '/helper_funcs.php';

/**
 * Prepare query for inserting operation.
 *
 * @param mysqli                        $connection The MySQLi connection object.
 * @param string                        $table_name The name of the table to insert into.
 * @param array<string,mixed>           $datas      Associative array of column => value pairs.
 * @param string                        $types      String of types for bind_param (e.g., 'ssi').
 * @return mysqli_stmt                              The prepared mysqli statement.
 */
function prepare_insert_query($connection, $table_name, $datas): mysqli_stmt
{
    $columns = implode(", ", array_keys($datas));
    $placeholders = implode(", ", array_fill(0, count($datas), '?'));
    $query_str = "INSERT INTO $table_name($columns) VALUES($placeholders)";
    $query = $connection->prepare($query_str);
    $values = array_values($datas);
    $query->bind_param(get_types($values), ...$values);
    return $query;
}

/**
 * Prepares a parameterized UPDATE query.
 *
 * @param mysqli               $connection The MySQLi connection object.
 * @param string               $table_name The name of the table to update.
 * @param array<string, mixed> $datas      Associative array of column => value pairs. Must include 'id' key.
 * @param string               $types      A string of bind_param types (e.g., 'ssi').
 * @return mysqli_stmt                     The prepared mysqli statement.
 */

function prepare_update_query($connection, $table_name, $datas, $types = "sssi"): mysqli_stmt
{
    $set_parts = [];

    foreach ($datas as $key => $value) {
        if ($key == "id") {
            continue; // skip id
        }
        $set_parts[] = "$key = ?";
    }

    $update_data_str = implode(", ", $set_parts);

    $query_str = "UPDATE $table_name SET $update_data_str WHERE id = ? ";
    $query = $connection->prepare($query_str);
    $values = array_values($datas);
    $query->bind_param(get_types(array_values($datas)), ...$values);

    return $query;
}
/**
 * Prepares a DELETE query by ID.
 *
 * @param mysqli  $connection The MySQLi connection object.
 * @param string  $table_name The name of the table to delete from.
 * @param int     $id         The ID of the row to delete.
 * @return mysqli_stmt        The prepared mysqli statement.
 */
function prepare_delete_query($connection, $table_name, $id): mysqli_stmt
{
    $query_str = "DELETE FROM $table_name WHERE id = ?";
    $query = $connection->prepare($query_str);
    $query->bind_param("i", $id);

    return $query;
}
/**
 * Prepares a SELECT query by ID.
 *
 * @param mysqli  $connection The MySQLi connection object.
 * @param string  $table_name The name of the table to select from.
 * @param int     $id         The ID of the row to select.
 * @return mysqli_stmt        The prepared mysqli statement.
 */
function prepare_select($connection, $table_name, $id): mysqli_stmt
{
    $query_str = "SELECT * FROM $table_name WHERE id = ?";
    $query = $connection->prepare($query_str);
    $query->bind_param("i", $id);

    return $query;
}
/**
 * Prepares a search query with multiple columns using LIKE conditions.
 *
 * @param mysqli        $connection    The MySQLi connection object.
 * @param string        $table_name    The name of the table to search.
 * @param string[]      $columns_arry  Array of column names to search in.
 * @param string        $search_term   The search keyword.
 * @throws \Exception                 Throws exception if prepare fails.
 * @return mysqli_stmt|bool            Prepared statement on success, false on failure.
 */
function prepare_search_query(mysqli $connection, string $table_name, array $columns_arry, string $search_term): mysqli_stmt
{
    // Build WHERE clause like: column1 LIKE ? OR column2 LIKE ? ...
    $where_clauses = array_map(fn($col) => "$col LIKE ?", $columns_arry);
    $where_sql = implode(" OR ", $where_clauses);

    $query_str = "SELECT * FROM $table_name WHERE $where_sql ORDER BY uploaded_at DESC";

    $stmt = $connection->prepare($query_str);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $connection->error);
    }
    // Repeat the search term for each key
    $search_values = array_fill(0, count($columns_arry), "%$search_term%");
    $types = str_repeat('s', count($columns_arry)); // All strings

    $stmt->bind_param($types, ...$search_values);

    return $stmt;
}

/**
 * Executes a SELECT * query on the specified table.
 *
 * @param mysqli $connection The MySQLi connection object.
 * @param string $table_name The name of the table to select from.
 * @return mysqli_result     The result set from the query.
 */
function prepare_select_all($connection, $table_name, $select_kws = null, $order = "DESC"): mysqli_result
{
    $columns = $select_kws ? trim($select_kws) : "*" ;
    $query_str = "SELECT $columns FROM $table_name ORDER BY id $order";
    $query = $connection->query($query_str);
    return $query;
}

function prepare_raw_query($connection, $raw_query_string, $extra_value = null):mysqli_stmt{
    $raw_query_string = trim($raw_query_string, "\n");
    $query = $connection->prepare($raw_query_string);
    if($extra_value){
        // $raw_query_string = str_replace("?", $extra_value, $raw_query_string);
        $query->bind_param("i", $extra_value);
    }
    return $query;
}