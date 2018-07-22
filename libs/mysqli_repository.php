<?php

if (!function_exists('get_users')) {

    /**
     * @return mixed
     */
    function get_users()
    {
        $rows = [];
        $db = get_db_connection();
        $result = $db->query("select * from users");

        foreach ($result->fetch_assoc() as $data) {
            $rows[] = $data;
        }

        $db->close();
        return $rows;
    }
}
