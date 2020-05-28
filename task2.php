<?php
require_once('Category.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ECommerce Task 2</title>
</head>
<body>

<ul>
    <?php
    $list = Category::categoriesToTree();
    foreach ($list as $category) {
        echo '<pre>';
        print_r($list);
        echo '</pre>';
        ?>
        <li>
            <?php
                echo $category['name'];
            ?>
            <?php
                if($category['subcategories']){
                    sub_category($category['subcategories']);
                }
            ?>
        </li>
        <?php
    }

    ?>
</ul>

<?php
function sub_category($sub_category){
?>
    <ul>
        <?php
        $list = $sub_category['subcategories'];
        foreach ($list as $category) {
            ?>
            <li>
                <?php
                echo $category['name'];
                ?>
                <?php
                if(!empty($category['subcategories'])){
                    echo '$var is set even though it is empty';
                }
                ?>
            </li>
            <?php
        }

        ?>
    </ul>
<?php
}
?>
</body>
</html>