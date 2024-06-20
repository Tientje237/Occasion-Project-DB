{extends file='Layout.tpl'}

{block name="contentLogin"}

    <h1>Login Formulier</h1>
    <form action="index.php?action=login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password1" required>
        </div>

        {if $error}
            <div class="error">{$error}</div>
        {/if}

        {if $success}
            <div class="succes">{$success}</div>
        {/if}

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

{/block}
