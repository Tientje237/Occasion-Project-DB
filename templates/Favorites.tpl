<h1>Favorieten</h1>
{foreach from=$favorites item=car}
    <div>
        <h2>{$car.brand} {$car.model}</h2>
        <p>Prijs: €{$car.price}</p>
        <a href="index.php?action=detailpagina&id={$car.id}">Bekijk details</a>
    </div>
{/foreach}
