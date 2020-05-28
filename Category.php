<?php
/**
 * Created by PhpStorm.
 * User: bazlur
 * Date: 5/28/20
 * Time: 7:43 PM
 */

require_once('Dbconnection.php');

class Category
{
    public static function categories_count()
    {
        $mysqli = new mysqli("localhost", "root", "root", "ecommerce");

        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "SELECT category.*, COUNT(categoryId) AS item_count FROM category LEFT JOIN Item_category_relations ON category.Id = Item_category_relations.categoryId GROUP BY category.id ORDER BY item_count DESC";
        $categories_array = array();

        if ($result = $mysqli->query($query)) {


            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
                $categories_array[] = $row;

            }

            /* free result set */
            $result->free();
        }

        /* close connection */
        $mysqli->close();

        return $categories_array;

    }

    public static function categoriesToTree()
    {

        $mysqli = new mysqli("localhost", "root", "root", "ecommerce");

        /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "SELECT category.Id as id, category.Name as name, catetory_relations.ParentcategoryId as parent from category LEFT JOIN catetory_relations on category.Id = catetory_relations.categoryId";
        $categories_array = array();

        if ($result = $mysqli->query($query)) {

            while ($row = $result->fetch_assoc()) {
                $categories_array[] = $row;

            }

            $result->free();
        }

        $mysqli->close();


        $categories = $categories_array;

        $map = array(
            0 => array('subcategories' => array())
        );

        foreach ($categories as &$category) {
            //echo $category['id'].'-----';
            $category['subcategories'] = array();
            $map[$category['id']] = &$category;
        }


        foreach ($categories as &$category) {
            $map[$category['parent']]['subcategories'][] = &$category;
        }

        return $categories;

    }

}