<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Occasion Favorieten</title>
</head>
<body>
<h1>Favorieten</h1>
{foreach from=$favorites item=car}
    <div>
        <h2>{$car.brand} {$car.model}</h2>
        <p>Prijs: €{$car.price}</p>
        <a href="index.php?action=detailpagina&id={$car.ID}">Bekijk details</a>
        <br><br>
        <form method="post" action="index.php?action=favorieten">
            <input type="hidden" name="car_id" value="{$car.ID}">
            <input type="hidden" name="remove" value="1">
            <button type="submit">Verwijderen uit favorieten</button>
        </form>
    </div>
{/foreach}
</body>
</html>