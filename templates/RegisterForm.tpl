<form method="post">
    Email: <input type="email" name="email"><br>
    Wachtwoord: <input type="password" name="password1"><br>
    Herhaal wachtwoord: <input type="password" name="password2"><br>
    <button type="submit">Registreren</button>
</form>
{if $success}
    <p>{$success}</p>
{elseif $error}
    <p>{$error}</p>
{/if}

