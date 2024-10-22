<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyChanger</title>
</head>
<body>
    <h1>Convertisseur de devises</h1>
    <form action="convert.php" method="POST">
        <label for="from_currency">De :</label>
        <input type="text" id="from_currency" name="from_currency" placeholder="Devise source (ex: USD)" required><br><br>
        
        <label for="to_currency">Vers :</label>
        <input type="text" id="to_currency" name="to_currency" placeholder="Devise cible (ex: EUR)" required><br><br>
        
        <label for="amount">Montant :</label>
        <input type="number" id="amount" name="amount" step="0.01" placeholder="Montant" required><br><br>
        
        <button type="submit">Convertir</button>
    </form>
</body>
</html>
