<form action="sell.php" method="post">
    <fieldset>
        <div class="help-block">Insert a symbol of company you want to sell</div>
        
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="Symbol" placeholder="IBM" type="text"/>
        </div>
        <div class="help-block">Insert a share of company you want to sell</div>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="share" placeholder="1" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-hourglass"></span>
                Get price
            </button>
        </div>
    </fieldset>
</form>
<div>
    
    <?php
        if ($selling)
        {
            echo "You sold {$share} percents of {$Symbol}<b/r>" ;
        }

            echo '<table class= "table table-bordered">';
   
        if ($positions) 
        {
        foreach ($positions as $position)
            {
                print("<tr>");
                print("<td>" . $position["symbol"] . "</td>");
                print("<td>" . $position["share"] . "</td>");
                print("<td>" . $position["price"] . "</td>");
                print("</tr>");
            }
        }
        

    ?> 
            </table>
    </div>