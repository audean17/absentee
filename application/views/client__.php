  <?php

$error = $this->client->getError();
if ($error) 
{
 echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}
 
  $result = $this->client->call("Master.fruits", array("count" => 4, "type" => "red"));
 
 if ($this->client->fault) 
{
   echo "<h2>Fault</h2><pre>";
   print_r($result);
   echo "</pre>";
   }
  else {
    $error = $this->client->getError();
   if ($error) {
    echo "<h2>Error</h2><pre>" . $error . "</pre>";
       }
  else {
    echo "<h2>Fruits</h2><pre>";
    echo $result;
    echo "</pre>";
   }
}