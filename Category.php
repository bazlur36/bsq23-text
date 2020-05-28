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


            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
                $categories_array[] = $row;

            }

            /* free result set */
            $result->free();
        }

        /* close connection */
        $mysqli->close();

        #return $categories_array;


        /*$categories = array(
            array('id' => 1,  'parent' => 0, 'name' => 'Category A'),
            array('id' => 2,  'parent' => 0, 'name' => 'Category B'),
            array('id' => 3,  'parent' => 0, 'name' => 'Category C'),
            array('id' => 4,  'parent' => 0, 'name' => 'Category D'),
            array('id' => 5,  'parent' => 0, 'name' => 'Category E'),
            array('id' => 6,  'parent' => 2, 'name' => 'Subcategory F'),
            array('id' => 7,  'parent' => 2, 'name' => 'Subcategory G'),
            array('id' => 8,  'parent' => 3, 'name' => 'Subcategory H'),
            array('id' => 9,  'parent' => 4, 'name' => 'Subcategory I'),
            array('id' => 10, 'parent' => 9, 'name' => 'Subcategory J'),
        );*/

        /*echo "<pre>";
        print_r($categories);
        echo "</pre>";
        die();*/

        $categories = $categories_array;

        /*echo "<pre>";
        print_r($categories);
        echo "</pre>";
        die();*/
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

     /*   echo "<pre>";
       print_r($categories);
       echo "</pre>";
       die();

        echo '<pre>';
        print_r($map[0]['subcategories']);
        echo '</pre>';
        die();*/
        return $categories;

    }

}