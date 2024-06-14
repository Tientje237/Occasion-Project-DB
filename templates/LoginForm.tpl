<form method="post">
    Email: <input type="email" name="email"><br>
    Wachtwoord: <input type="password" name="password"><br>
    <button type="submit">Inloggen</button>
</form>
{if $success}
    <p>{$success}</p>
{elseif $error}
    <p>{$error}</p>
{/if}

