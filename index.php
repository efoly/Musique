<?php 
    $title = 'Musique';
    include 'includes/header.php';
    include 'includes/menu.php';
?>

<h1><?php echo $title; ?></h1>

<main>
    <div>
        <h4>
            <input type="radio" id="check_ins" name="check">
            <label>S'inscrire</label>
        </h4>
        <form method="POST" name="form_inscription" class="container">
            <table class="ins">
                <tr>
                    
                    <td><label>Email :</label></td>
                    <td><input type="text" name="email_ins" placeholder="Tapez votre email" onkeyup="vider_cnx();"></td>
                </tr>
                <tr>
                    <td><label>Password :</label></td>
                    <td><input type="password" name="pass_ins" placeholder="Tapez votre mot de passe" onkeyup="vider_cnx();"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input class="btn btn-primary btn-xs" type="submit" name="btn_ins" value="S'inscrire"></td>
                </tr>
            </table>
        </form>

        <br><br><br>

        <h4>
            <input type="radio" id="check_cnx" name="check">
            <label>S'identifier</label>
        </h4>
        <form action="login.php" method="POST" name="form_connexion" class="container">
            <table class="cnx">
                <tr> 
                    <td><label>Email :</label></td>
                    <td><input type="text" name="email_cnx" placeholder="Tapez votre email" onkeyup="vider_ins();"></td>
                </tr>
                <tr>
                    <td><label>Password :</label></td>
                    <td><input type="password" name="pass_cnx" placeholder="Tapez votre mot de passe" onkeyup="vider_ins();"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input class="btn btn-primary btn-xs" type="submit" name="btn_cnx" value="Se Connecter"></td>
                </tr>
            </table>
        </form>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
