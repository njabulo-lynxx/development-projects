<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Escape</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <table>

        <?php 
        
         for($rows = 1; $rows <= 8; $rows++) {
            echo "<tr>";
            for($columns = 1; $columns <= 8; $columns++) {
                if(($rows + $columns) % 2 == 0) {            //If the number is even, style the cell black
                    echo "<td class = 'black'></td>";
                } else {                                     //Else, style the cell white
                    echo "<td></td>";
                } 
            }
            echo "</tr>";  
         }
            
        ?>

    </table>

</body>
</html>