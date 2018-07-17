<?php

if (!function_exists('get_users')) {

    /**
     * @return mixed
     */
    function get_users()
    {
        $rows = [];
        $db = get_db_connection();
        $result = $db->prepare("select * from users");
        $result->execute();

        foreach ($result->fetchAll() as $data) {
            $rows[] = $data;
        }

        return $rows;
    }
}
