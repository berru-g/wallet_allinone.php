
<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=wallet_allinone;charset=utf8;', 'root', 'root');
if (isset($_POST['envoie'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = htmlspecialchars($_POST['mdp']);
        //$mdp = sha1($_POST['mdp']);
        $insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp) VALUES(?,?)');
        $insertUser->execute(array($pseudo, $mdp));

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($pseudo, $mdp));
        
        if($recupUser->rowCount() > 0){
          $_SESSION['pseudo'] = $pseudo;
          $_SESSION['mdp'] = $mdp;
          $_SESSION['id'] = $recupUser->fetch()['id'];
        }
        header('location: home.php');
    } else{
      echo "Veuillez vous connecter";
    }
}
?>
<div id="message">
<h2>Inscription</h2>
<form id="monFormulaire" action="" method="POST" enctype="multipart/form-data" class="proceed maskable" name="login" autocomplete="off" novalidate="">
                    <div id="passwordSection" class="clearfix">
                        <div class="textInput" id="pseudodiv">
                            <div class="fieldWrapper">
                                <label for="text" class="form-label"></label>
                                <input id="text" name="pseudo" type="text" class="hasHelp  validateEmpty " required="required" aria-required="true" value="" autocomplete="off" placeholder="email">
                            </div>
                        </div>
                        <div class="textInput lastInputField" id="mdpdiv">
                            <div class="fieldWrapper"><label for="password" class="form-label"></label>
                                <input id="password" name="mdp" type="password" class="hasHelp  validateEmpty " required="required" aria-required="true" value="" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <button class="inscription" type="submit" id="envoie" name="envoie" value="Login">Connexion</button>
                    <a href="connexion.php"><button class="inscription">Connexion</button></a>
                </form>
</div>