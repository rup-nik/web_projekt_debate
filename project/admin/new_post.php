<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/header.php';
?>

<div class="form-container">
    <h2>New Post</h2>
    <form name="newsForm" action="../scripts/process_new_post.php" method="post" onsubmit="return validateForm()">
        <label for="naslov">Naslov:</label>
        <input type="text" id="naslov" name="naslov" required>
        <br>
        <label for="kratki_sadrzaj">Kratki sadržaj:</label>
        <textarea id="kratki_sadrzaj" name="kratki_sadrzaj" required></textarea>
        <br>
        <label for="tekst">Tekst:</label>
        <textarea id="tekst" name="tekst" required></textarea>
        <br>
        <label for="slika">Slika (URL):</label>
        <input type="url" id="slika" name="slika" required>
        <br>
        <label for="kategorija">Kategorija:</label>
        <select id="kategorija" name="kategorija" required>
            <option value="">Select</option>
            <option value="mundo">Mundo</option>
            <option value="deporte">Deporte</option>
        </select>
        <br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</div>

<script>
function validateForm() {
    var naslov = document.forms["newsForm"]["naslov"].value;
    var kratki_sadrzaj = document.forms["newsForm"]["kratki_sadrzaj"].value;
    var tekst = document.forms["newsForm"]["tekst"].value;
    var slika = document.forms["newsForm"]["slika"].value;
    var kategorija = document.forms["newsForm"]["kategorija"].value;
    var author = document.forms["newsForm"]["author"].value;

    if (naslov.length < 5 || naslov.length > 30) {
        alert("Naslov vijesti mora imati 5 do 30 znakova");
        return false;
    }

    if (kratki_sadrzaj.length < 10 || kratki_sadrzaj.length > 100) {
        alert("Kratki sadržaj vijesti mora imati 10 do 100 znakova");
        return false;
    }

    if (tekst == "") {
        alert("Tekst vijesti nesmije biti prazan");
        return false;
    }

    if (slika == "") {
        alert("Slika (URL) mora biti unesena");
        return false;
    }

    if (kategorija == "") {
        alert("Kategorija mora biti odabrana");
        return false;
    }

    if (author == "") {
        alert("Author mora biti unesen");
        return false;
    }

    return true;
}
</script>

<?php include '../includes/footer.php'; ?>
