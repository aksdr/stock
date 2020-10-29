<form action="buy.php" method="post">
    <fieldset>
        <div class="help-block">Insert a symbol of company you want to buy</div>
        
         <div class="form-group">
            
        </div> 
        <div class= "dropdown" style = "
        width: auto;
    display: inline-block;
        ">  
        <input autofocus class="form-control dropdown-toggle hidsym" data-toggle="dropdown" name="symbol" placeholder="IBM" type="text" value="IBM"/>
            
            <span class="caret"></span></button>
            <ul class="dropdown-menu " id="drop">
                <?php
                foreach ($symbols as $sym)
                {
                echo "<li class= 'dropdown-item ' ><a href='#' class='dropselect' value='{$sym}'>{$sym}</a></li>";
                }
               ?>

            </ul>
            
        </div>
        <div class="help-block">Insert a share of company you want to buy</div>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="share" placeholder="1" type="text"/>
            
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-briefcase"></span>
                Buy
            </button>
        </div>
    </fieldset>
</form>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    
        <?php
            if ($selling)
            {
                echo $message ;
            }

                echo '<table class= "table table-bordered">';
    
            if ($positions) 
            {
                echo "<tr>
                <td> Symbol </td>
                <td> Share,% </td>
                <td> Price,$ </td>
                </tr>
                ";

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
</div>
   