<!-- Footer -->
            <div class="foot row">

                <div class="four columns">
                   
				   <?php
                   $repair_db='<form action="connection.php" method="post">
	<div class="row form-row">
		<div class="four columns">
			<input type="submit" name="Repair" class="button primary" value="Fix_DB">
		</div>
	</div>
</form>';

				   include_once("connection.php");
                    global $mysqldb;
                   if (!$mysqldb) {
                    echo $repair_db;
                   }?>


				   
				   
                </div>

                
            </div>
            <!-- End footer -->

