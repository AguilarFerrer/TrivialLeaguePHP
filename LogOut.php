<?php
    include ('./includes/headerlogin.html');
    require ('./includes/redirect.php');

    setcookie('ID','', time() -3600);
    setcookie('Name','', time() -3600);
    
    redirect('index.php'); 
?>

<?php
    include ('./includes/footer.html');
?>
