{extends file="layout.tpl"}
{block name=title}Créer votre compte{/block}
{block name=body}
    <div class="login-grid">
        <h1 class="text-center">Sign Up Now!</h1>
        <div class="form-div">
            <form action="index.php" method="post">
                        <form action="login.php" method="post">
            <Label>
                User Name* : 
                <input type="text" name="uname1" id="uname1" >
            </Label><br>
            <label >
                Password* :
                <input type="password" name="psswd1" id = "passwd1" > 
            </label><br>
            <label>
                confirm your password* :
                <input type="password" name="confpsswd" id = "confpasswd" >
            </label>
            <div>
                <input type="submit" value="Send">
            </div>
        </form>
            <div class="account-opt">
            	<a class="opt-acc" id="forgoten" href="#">Mot de passe oublié ?</a>
            	<a class="opt-acc" id="register" href="enregistrer.php">Créer un compte</a>
            </div>
        </div>
    </div>
{/block}


