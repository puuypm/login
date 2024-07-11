<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['emailAdmin'])) {
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="card">
        <h1>Ini Admin</h1>
        <a href="logout.php">Logout</a>
        <?= $_SESSION['emailAdmin'] ?>
    </div>

    <div class="container">
        <div class="row"><br>
            <form action="">
                <div class="col-sm-1">Kecamatan</div>
                <div class="col-sm-4">
                    <select name="firstSelect" id="firstSelect" onchange="updateKecamatan()">
                        <option value="">--Pilih Kecamatan--</option>
                        <option value="1">Kecamatan Tanah Abang</option>
                        <option value="2">Kecamatan Senen</option>
                        <option value="3">Kecamatan Gambir</option>
                    </select>
                </div>
        </div>
        <div class="row"><br>
            <div class="col-sm-1">Kelurahan</div>
            <div class="col-sm-4">
                <select name="secondSelect" id="secondSelect">
                    <option value="">--Select Option 2--</option>
                </select>
            </div>
        </div></br>
        <button type="submit">Kirim</button>
        </form>
    </div></br>
    </div>
    <script>
        function updateKecamatan() {
            var firstSelect = document.getElementById("firstSelect");
            var secondSelect = document.getElementById("secondSelect");
            var selectValue = firstSelect.value;

            secondSelect.innerHTML = "";
            var options = [];
            if (selectValue === "1") {
                options = ["a", "b", "c"];
            } else if (selectValue === "2") {
                options = ["d", "e", "f"];
            } else if (selectValue === "3") {
                options = ["g", "h", "i"];
            } else {
                options = ["----"];
            }
            for (var i = 0; i < options.length; i++) {
                var option = document.createElement("option");
                option.value = options[i];
                option.text = options[i];
                secondSelect.appendChild(option);
            }
        }
    </script>
</body>

</html>