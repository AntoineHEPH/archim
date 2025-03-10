<?php
//traitement toujours au-dessus
if(isset($_POST['login_submit'])){
    extract($_POST, EXTR_OVERWRITE);
    $adm = new AdminDAO($cnx);
    $nom_admin = $adm->getAdmin($login, $password);
    $_SESSION['admin'] = $nom_admin;
    header('location: admin/index_.php?page=accueiladmin.php');
}

?>

<form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
  <div class="mb-3">
    <label for="login" class="form-label">Identifiant</label>
    <input type="text" class="form-control" id="login" name="login">
    <div id="login" class="form-text">Votre identité est bien gardée.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
      <div id="login" class="form-text">eImiTXuWVxfM37uY4JANjQO3PUFV6.J8A7/yXST5Z5q39sVRk3obi, c'est ce à quoi ressemblera votre mot de passe une fois rentré. :)</div>
  </div>
  <button type="submit" class="btn btn-primary" name="login_submit">Connexion</button>
</form>