<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Occasion Auto Details</title>
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

{if isset($car.is_favorite)}
    {if !$car.is_favorite}
        <form method="post" action="index.php?action=favorieten">
            <input type="hidden" name="car_id" value="{$car.ID}">
            <button type="submit">Voeg toe aan favorieten</button>
        </form>
    {else}
        <p>Deze auto staat al in je favorieten.</p>
    {/if}
{/if}

</body>
</html>