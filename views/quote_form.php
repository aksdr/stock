<form action="quote.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="Symbol" placeholder="IBM" type="text"/>
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
   <?php echo $stock_symbol.":".$price ?>
</div>