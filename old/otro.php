
<?php
include 'afip_index.php';

$movies = new SimpleXMLElement($xmlstr);

echo $movies->movie[0]->plot;

echo $movies->movie->{'great-lines'}->line;

/* For each <character> node, we echo a separate <name>. */
foreach ($movies->movie->characters->character as $character) {
   echo $character->name, ' played by ', $character->actor, PHP_EOL;
}
?>

