{extends file='Layout.tpl'}

{block name="contentFavorite"}
    <h1>Favorieten van: {$current_user->getMail()}</h1>
    {if !empty($favorites)}
        {foreach $favorites as $favorite}
            <div>
                {$favorite}
                <form method="post" action="index.php?action=favorieten">
                    <input type="hidden" name="favorite" value="{$favorite}">
                    <button name="removeFavorite" type="submit">Verwijder uit favorieten</button>
                </form>
            </div>
        {/foreach}
    {else}
        <p>Je hebt nog geen favorieten.</p>
    {/if}
{/block}
