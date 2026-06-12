<?php

require_once("vendor/autoload.php");
require_once("models/Database.php");
require_once("models/FreightRule.php");



$database = new Database();



$csv = League\Csv\Reader::createFromPath(__DIR__ . '/frakt.csv', 'r');
$csv->setHeaderOffset(0);
$records = $csv->getRecords();
$database = new Database();


echo "<h1>Fraktregler</h1>";
echo "<ul>";
foreach ($records as $record) {
  $database->updateFreightRule(
    $record['zon_kod'],
    $record['zon_namn'],
    $record['basavgift_sek'],
    $record['vikt_multiplikator_sek_per_kg'],
    $record['fri_frakt_grans_sek']

  );

  foreach ($records as $record) {

    if (empty($record['zon_kod'])) {
      continue;
    }

    $rule = new FreightRule();
    $rule->zone_code = $record['zon_kod'];
    $rule->zone_name = $record['zon_namn'] ?? '';
    $rule->base_fee = $record['basavgift_sek'] ?? 0;
    $rule->weight_modifier = $record['vikt_multiplikator_sek_per_kg'] ?? 0;
    $rule->free_shipping_threshold = $record['fri_frakt_grans_sek'] ?? null;

    // check duplicate
    $check = $database->pdo->prepare("
        SELECT id FROM freight_rules WHERE zone_code = :zone_code
    ");
    $check->execute(['zone_code' => $rule->zone_code]);

    if ($check->fetch()) {
      continue;
    }

    $database->insertFreightRule($rule);
  }


}
echo "lyckades"

  ?>