<?php
require_once("models/Database.php");


$database = new Database();
$getAllBooks= $database;

<rss xmlns:pj="https://schema.prisjakt.nu/ns/1.0" xmlns:g="http://base.google.com/ns/1.0" version="3.0">
  <channel>
    <title>Prisjakt Minimal Example Feed</title>
    <description>This is an example feed with the minimal values required</description>
    <link> https://schema.prisjakt.nu </link>
    <?php
    foreeach ($allproducts as $book){
?>
  
    <item>
      <g:id><?php echo $book -> id;?></g:id>
      <g:title><?php echo $book -> title;?></g:title>
      <g:price><?php echo $book -> price;?></g:price>
      <g:link>http://example.com/link</g:link>
      <g:availability>download</g:availability>
      <g:condition>new</g:condition>
    </item>
    <?php } ?>
  </channel>
</rss>


?>