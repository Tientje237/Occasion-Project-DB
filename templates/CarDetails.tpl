<!-- CarDetails.tpl -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Details</title>
</head>
<body>
<h1>{$car.brand} {$car.model}</h1>
<ul>
    <li>Prijs: €{$car.price}</li>
    <li>PK: {$car.horsepower}</li>
    <li>Kilometerstand: {$car.mileage} km</li>
    <li>Bouwjaar: {$car.year}</li>
    <li>Kleur: {$car.color}</li>
    <li>Brandstof: {$car.fueltype}</li>
    <li>Interieur: {$car.interior}</li>
    <li>Transmissie: {$car.transmission}</li>
    <li>Aantal zitplaatsen: {$car.seats}</li>
    <li>Specificaties: {$car.specifications}</li>
</ul>

{if isset($_SESSION.user_id)}
    <form method="post" action="index.php?action=favorieten">
        <input type="hidden" name="car_id" value="{$car.ID}">
        <button type="submit">Toevoegen aan favorieten</button>
    </form>
{/if}

</body>
</html>
