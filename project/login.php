<?php include 'includes/header.php'; ?>

<div class="form-container">
    <h2>Admin Login</h2>
    <form action="scripts/process_login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
