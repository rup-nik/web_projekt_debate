<?php
include 'config.php';
include 'includes/header.php';

function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$post_id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id='$post_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <div class="post-container">
        <h1><?php echo $row['title']; ?></h1>
        <p>Por <?php echo $row['author']; ?> - hace <?php echo time_ago($row['created_at']); ?></p>
        <img src="<?php echo $row['image_url']; ?>" alt="">
        <div><?php echo $row['content']; ?></div>
    </div>
    <?php
} else {
    echo "Post not found";
}

include 'includes/footer.php';
?>
