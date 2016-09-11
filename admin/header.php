<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title>Dashboard - Sample Blog with PHP</title>
      <link rel="stylesheet" type="text/css" href="../style-admin.css" >


      <!-- Fancybox jQuery -->
      <script type="text/javascript" src="../fancybox/jquery-1.9.0.min.js"></script>
      <script type="text/javascript" src="../fancybox/jquery.fancybox.js"></script>
      <script type="text/javascript" src="../fancybox/main.js"></script>
      <link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.css" />
      <!-- //Fancybox jQuery -->

        <!-- CKEditor Start -->
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
        <!-- // CKEditor End -->
  
</head>

<body>

  <div id="wraper">

    <div id="header">
       <h1>Admin Panel Dashboard</h1>
    </div>

    <div id="container">
      <div id="sidebar">
          <h2>Page options</h2>
        <div id="menu">
        <ul >
          <li><a class="style1" href="index.php">Home</a>
          <li><a class="style1" href="change-password.php">Change Password</a></li>
          <li><a class="style1" href="change-footer-text.php">Change Footer Text</a></li>
          <li><a class="style1" href="logout.php">Logout</a></li>
        </ul>
        </div>

          <h2>Blog options</h2>
        <div id="menu">
        <ul >
          <li><a class="style1" href="add-post.php">Add post</a>
          <li><a class="style1" href="view-post.php">View post</a></li>
          <li><a class="style1" href="manage-category.php">Manage category</a></li>
          <li><a class="style1" href="manage-tags.php">Mangae Tags</a></li>
        </ul>
        </div>

          <h2>Comment Section</h2>
        <div id="menu">
        <ul >
          <li><a class="style1" href="comment-app.php">View Comments</a>
        </ul>
        </div>

      </div>

      <div id="content">