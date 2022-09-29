<!-- this is php code for conecting to the database -->
<?php
Define('DB_USER','root');
Define('DB_PASSWORD','limoo26509114018LEL');
Define('DB_HOST','localhost');
Define('DB_NAME','dairy_farm');
try
{
 $dbcon= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 mysqli_set_charset($dbcon, 'utf8');
}
 catch(Exception $e)
{
print "The system is busy please try Later";
}
catch(Error $e)
{
print"The System Is Busy Please Try Again Later.";
}
?>