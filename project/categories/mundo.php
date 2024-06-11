<?php
include '../config.php';
include '../includes/header.php';

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
?>

<main>
    <div class="container">
        <section class="category">
            <h2>Mundo</h2>
            <div class="posts">
                <?php
                $sql = "SELECT * FROM posts WHERE category='Mundo' ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='post'>";
                        echo "<img src='" . $row['image_url'] . "' alt=''>";
                        echo "<h3><a href='../post.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
                        echo "<p>Por " . $row['author'] . " - hace " . time_ago($row['created_at']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </section>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
