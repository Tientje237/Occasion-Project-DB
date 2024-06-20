{extends file='Layout.tpl'}

{block name="contentShowCase"}
    <h1>Alle aanbod:</h1>
    {if !empty($allCars)}
        {foreach $allCars as $car}
            <div>
                {$car->printVehicleInfo()}
                <form method="post" action="index.php?action=favorieten">
                    <input type="hidden" name="car_id" value="{$car->getId()}">
                    <input type="hidden" name="addFavorite" value="{$car->printVehicleInfo()}">
                    <button type="submit">
                        {if $car->isFavorite()}Verwijder uit favorieten{else}Voeg toe aan favorieten{/if}
                    </button>
                </form>
            </div>
        {/foreach}
    {else}
        <p>Er zijn momenteel geen auto's beschikbaar.</p>
    {/if}
{/block}
