<h1>Aanbod</h1>
{foreach from=$cars item=car}
    <div>
        <h2>{$car.brand} {$car.model}</h2>
        <p>€{$car.price} | {$car.year} | {$car.mileage}km</p>
        <a href="index.php?action=detailpagina&id={$car.ID}">Bekijk details</a>
    </div>
{/foreach}
