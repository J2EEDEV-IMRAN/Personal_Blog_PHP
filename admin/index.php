<?  ob_start();session_start(); ?> <!-- eiline e php tag suru hower age ekta spaceo thaktheparbene evong arekta error  theke rokha patehole ob_start() age likhtehobe -->
      <?php
      if($_SESSION['name']!='admin')
      {
        header('location: login.php');
      }
      ?>
       <? include 'header.php' ?>

        <h2>Admin Panel </h2>
        <div style="color:#fff;text-align:center;padding-top:70px; font-size:28px;">
        Welcome to the dashboard of sample blog with <br/>
        PHP
      </div>
      <? include 'footer.php'?>
