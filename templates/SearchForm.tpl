<!-- SearchForm.tpl -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zoeken</title>
</head>
<body>
<h1>Zoeken</h1>
<form method="post" action="index.php?action=zoeken">
    <input type="text" name="searchTerm" placeholder="Zoekterm..." value="{$searchTerm}">
    <button type="submit">Zoeken</button>
</form>

<h2>Resultaten</h2>
{if $searchResults|@count > 0}
    {foreach from=$searchResults item=car}
        <div>
            <h2>{$car.brand} {$car.model}</h2>
            <p>€{$car.price} | {$car.year} | {$car.mileage}km</p>
            <a href="index.php?action=detailpagina&id={$car.ID}">Bekijk details</a>
        </div>
    {/foreach}
{else}
    <p>Geen resultaten gevonden voor "{$searchTerm}".</p>
{/if}
</body>
</html>
