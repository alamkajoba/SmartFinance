<?php
$pdo = new PDO('sqlite:database/database.sqlite');
$stmt = $pdo->query('SELECT d.description, d.montant, c.nomCategorie FROM depenses d LEFT JOIN categories c ON d.categorie_id = c.id ORDER BY c.nomCategorie, d.date_depense DESC');
echo 'Dépenses par catégorie:' . PHP_EOL;
$currentCategory = '';
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $category = $row['nomCategorie'] ?: 'Sans catégorie';
    if ($category !== $currentCategory) {
        echo PHP_EOL . '=== ' . $category . ' ===' . PHP_EOL;
        $currentCategory = $category;
    }
    echo '  - ' . $row['description'] . ' : ' . $row['montant'] . '€' . PHP_EOL;
}

// Résumé par catégorie
echo PHP_EOL . 'RÉSUMÉ PAR CATÉGORIE:' . PHP_EOL;
$stmt = $pdo->query('SELECT c.nomCategorie, SUM(d.montant) as total FROM depenses d LEFT JOIN categories c ON d.categorie_id = c.id GROUP BY c.nomCategorie ORDER BY total DESC');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $category = $row['nomCategorie'] ?: 'Sans catégorie';
    echo $category . ' : ' . $row['total'] . '€' . PHP_EOL;
}
?>