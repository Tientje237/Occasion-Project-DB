{extends file='Layout.tpl'}

{block name="contentRegister"}

    <h1>Register formulier</h1>
    <form action="index.php?action=register" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password1" name="password1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Password</label>
            <input type="password" class="form-control" id="password2" name="password2">
        </div>

        {if $error}
            <div class="error">{$error}</div>
        {/if}

        {if $success}
            <div class="success">{$success}</div>
        {/if}

        <button type="submit" class="btn btn-primary">Register</button>
    </form>


{/block}
