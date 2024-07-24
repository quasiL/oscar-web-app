<?php include 'includes/header.php'; ?>
    <h1>Oscar Winners</h1>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Rok</th>
            <th>Ženy</th>
            <th>Muži</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($oscarByYearData[1] as $year => $info) {
                echo "<tr>";
                echo "<td>{$year}</td>";
                echo "<td>" . htmlspecialchars($info['Women']['name']) .
                    " (" . htmlspecialchars($info['Women']['age']) . ")" . "</br>" .
                    htmlspecialchars($info['Women']['movie']) . "</td>";
                echo "<td>" . htmlspecialchars($info['Men']['name']) . " (" . htmlspecialchars($info['Men']['age']) .
                    ")" . "</br>" . htmlspecialchars($info['Men']['movie']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h1>Movies with Roles</h1>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Název filmu</th>
            <th>Rok</th>
            <th>Herečka</th>
            <th>Herec</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($oscarByMovieData[1] as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Movie']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Women']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Men']) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

<?php include 'includes/footer.php'; ?>



