<table class= "table table-bordered">
<?php

        foreach ($historys as $history)
        {
            print("<tr>");
            print("<td> At " . $history["Date"] . "</td>");
            print("<td> You' v " . $history["operation"] . " </td>");
            print("<td>" . $history["share"] . " percents of</td>");
            print("<td>" . $history["symbol"] . " stocks</td>");
            print("</tr>");
        }

    ?>
</table>