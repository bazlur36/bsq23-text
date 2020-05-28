<?php
require_once('Category.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ECommerce Task 1</title>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Total Items</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $list  = Category::categories_count();
    foreach($list as $category)  {
        ?>
        <tr>
            <td><?php echo $category['Name']; ?></td>
            <td><?php echo $category['item_count']; ?></td>
        </tr>
        <?php
    }

    ?>
    </tbody>
</table>
</body>
</html>