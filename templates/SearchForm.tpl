{extends file='Layout.tpl'}

{block name="contentSearch"}

    <h1>Zoek Formulier</h1>
    <form action="index.php?action=zoeken" method="post">
        <label for="searchTerm">Zoekterm:</label>
        <input type="text" id="searchTerm" name="searchTerm" value="{$searchTerm|escape}" required>
        <button type="submit">Zoeken</button>
    </form>

    {if $searchTerm}
        <h2>Zoekresultaten voor '{$searchTerm}':</h2>
        {if count($searchResults) > 0}
            <ul>
                {foreach from=$searchResults item=car}
                    <li>{$car->printVehicleInfo()}</li>
                {/foreach}
            </ul>
        {else}
            <p>Geen resultaten gevonden.</p>
        {/if}
    {/if}

{/block}
