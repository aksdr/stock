<form action="sell.php" method="post">
    <fieldset>
        <div class="help-block">Insert a symbol of company you want to sell</div>
        <!-- need to add here a select instead of input!!! -->
        <!-- <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="Symbol" placeholder="IBM" type="text"/>
        </div> -->
        <div class= "dropdown" style = "
        width: auto;
    display: inline-block;
        ">
            <button  class="btn btn1 btn-info dropdown-toggle form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Symbol
            <span class="caret"></span></button>
            <ul class="dropdown-menu " id="drop">
                <?php
                foreach ($symbols as $sym)
                {
                echo "<li class= 'dropdown-item ' ><a href='#'>{$sym}</a></li>";
                }
               ?>

            </ul>
        </div>
        <div class="help-block">Insert a share of company you want to sell</div>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="share" placeholder="1" type="text"/>
            
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-briefcase"></span>
                Sell
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
   