<div>
    <iframe allowfullscreen frameborder="0" height="315" src="https://www.youtube.com/embed/oHg5SJYRHA0?autoplay=1&iv_load_policy=3&rel=0" width="420"></iframe>
</div>
<div>
    <button class="btn btn-info" data-toggle="collapse" data-target="#person">Change password</button>
    <?php 
                            if ($placement == "none")
                            {
                                echo "<br><span class='text-success'>".$message."</span>";
                            }
                            ?> 
    <div class="collapse" id="person">
        <div class="panel panel-info">
            <div class="panel-heading">
                Personal data
            </div>
            <div class="panel-body">
                <span>If you want to change password please insert the new one.</span>
                <form action="new_pass.php" method="post">
                    <fieldset >
                        <div class="form-group" id="middle">
                            <input class="form-control" name="password" placeholder="Password" type="password"/>
                            <br>
                            <?php 
                            if ($placement == "first")
                            {
                                echo "<br><span class='text-danger'>".$message."</span>";
                            }
                            ?> 
                            <br>
                            <input class="form-control" name="confirmation" placeholder="Password" type="password"/>
                            <?php 
                            if ($placement == "second")
                            {
                                echo "<br><span class='text-danger'>".$message."</span>";
                            }
                            ?> 
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" type="submit">
                                <span aria-hidden="true" class="glyphicon glyphicon-ok"></span>
                                Change
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<table class= "table table-bordered">
<?php

        
    foreach ($positions as $position)
        {
            print("<tr>");
            print("<td>" . $position["symbol"] . "</td>");
            print("<td>" . $position["share"] . "</td>");
            print("<td>" . $position["price"] . "</td>");
            print("</tr>");
        }

    ?>
</table>
