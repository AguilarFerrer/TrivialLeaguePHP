<?php
    include ('./includes/headerlogin.html');

    //This deletes the cookies created by the login.
    setcookie('ID','', time() -3600);
    setcookie('Name','', time() -3600);
    
    //The user will be redirect to the page index.php.
    require ('./includes/redirect.php');
    redirect('index.php'); 
?>

<?php
    include ('./includes/footer.html');
?>
