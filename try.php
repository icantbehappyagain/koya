<!-- categorie de page des produits -->

<?php
$link = mysqli_connect('localhost', 'root', '', 'ecommerce') or die('error');

// Create Product Category
function createProductCategory($categoryName) {
    global $link;
    $categoryName = mysqli_real_escape_string($link, $categoryName);

    $query = "INSERT INTO `product_categories` (`name`) VALUES ('$categoryName')";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo "Product category created successfully.";
    } else {
        echo "Error creating product category: " . mysqli_error($link);
    }
}
?>


















<!-- user profile -->
<?php
$link = mysqli_connect('localhost', 'root', '', 'ecommerce') or die('error');

// Display User Profile
function displayUserProfile($userId) {
    global $link;
    $userId = mysqli_real_escape_string($link, $userId);

    $query = "SELECT * FROM `user` WHERE `id` = $userId";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        echo "Full Name: " . $user['fullname'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Is Admin: " . ($user['is_admin'] ? 'Yes' : 'No') . "<br>";
    } else {
        echo "User not found.";
    }
}

// Update User Profile
function updateUserProfile($userId, $fullname, $email) {
    global $link;
    $userId = mysqli_real_escape_string($link, $userId);
    $fullname = mysqli_real_escape_string($link, $fullname);
    $email = mysqli_real_escape_string($link, $email);

    $query = "UPDATE `user` SET `fullname` = '$fullname', `email` = '$email' WHERE `id` = $userId";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo "User profile updated successfully.";
    } else {
        echo "Error updating user profile: " . mysqli_error($link);
    }
}

// Delete User Profile
function deleteUserProfile($userId) {
    global $link;
    $userId = mysqli_real_escape_string($link, $userId);

    $query = "DELETE FROM `user` WHERE `id` = $userId";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo "User profile deleted successfully.";
    } else {
        echo "Error deleting user profile: " . mysqli_error($link);
    }
}

// Example Usage
$userId = 1;

// Display User Profile
echo "User Profile:<br>";
displayUserProfile($userId);
echo "<br>";

// Update User Profile
$newFullname = "John Doe";
$newEmail = "john@example.com";
echo "Updating User Profile:<br>";
updateUserProfile($userId, $newFullname, $newEmail);
echo "<br>";

// Display Updated User Profile
echo "Updated User Profile:<br>";
displayUserProfile($userId);
echo "<br>";

// Delete User Profile
echo "Deleting User Profile:<br>";
deleteUserProfile($userId);
?>












<!-- search bar -->
<?php
$link = mysqli_connect('localhost', 'root', '', 'ecommerce') or die('error');

// Search and Filter Products
function searchAndFilterProducts($searchQuery, $categoryFilter, $tagFilter) {
    global $link;
    $searchQuery = mysqli_real_escape_string($link, $searchQuery);
    $categoryFilter = mysqli_real_escape_string($link, $categoryFilter);
    $tagFilter = mysqli_real_escape_string($link, $tagFilter);

    $query = "SELECT * FROM `product` WHERE 
        (`name` LIKE '%$searchQuery%' OR `description` LIKE '%$searchQuery%')";

    if (!empty($categoryFilter)) {
        $query .= " AND `category` = '$categoryFilter'";
    }

    if (!empty($tagFilter)) {
        $query .= " AND `tags` LIKE '%$tagFilter%'";
    }

    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_assoc($result)) {
            echo "Product Name: " . $product['name'] . "<br>";
            echo "Price: $" . $product['price'] . "<br>";
            echo "Description: " . $product['description'] . "<br>";
            echo "Rating: " . $product['rating'] . "<br>";
            echo "<br>";
        }
    } else {
        echo "No products found.";
    }
}

// Example Usage
$searchQuery = "phone";
$categoryFilter = "Electronics";
$tagFilter = "Gadgets";

// Search and Filter Products
searchAndFilterProducts($searchQuery, $categoryFilter, $tagFilter);
?>











<!-- hestory order for user -->

<?php
$link = mysqli_connect('localhost', 'root', '', 'ecommerce') or die('error');

// Get User Order History
function getUserOrderHistory($userId) {
    global $link;
    $userId = mysqli_real_escape_string($link, $userId);

    $query = "SELECT o.id, o.datep, p.name AS product_name, o_p.quantity, p.price
              FROM `orders` AS o
              JOIN `order_has_product` AS o_p ON o.id = o_p.id_order
              JOIN `product` AS p ON o_p.id_product = p.id
              WHERE o.id_user = $userId
              ORDER BY o.datep DESC";

    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h2>Order History for User ID $userId:</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Order ID: " . $row['id'] . "<br>";
            echo "Order Date: " . $row['datep'] . "<br>";
            echo "Product Name: " . $row['product_name'] . "<br>";
            echo "Quantity: " . $row['quantity'] . "<br>";
            echo "Price: $" . $row['price'] . "<br>";
            echo "<br>";
        }
    } else {
        echo "No order history found for this user.";
    }
}

// Example Usage
$userId = 1;

// Get User Order History
getUserOrderHistory($userId);
?>
