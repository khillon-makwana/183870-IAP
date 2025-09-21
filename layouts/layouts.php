<?php
class layouts {
    public function header($conf) {
        ?>
        <!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="<?php echo $conf['site_name']; ?> - A modern blogging platform.">
      <title><?php echo $conf['site_name']; ?></title>
      
      <link href="<?php echo $conf['site_url']; ?>/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
      <style>
         .navbar-custom {
            background: linear-gradient(90deg, #20c997, #6f42c1);
         }
         .banner {
            background: linear-gradient(135deg, #6f42c1, #20c997);
            color: white;
            padding: 4rem 2rem;
            border-radius: .75rem;
            text-align: center;
            margin-bottom: 2rem;
         }
         .card-custom {
            border-radius: .75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
         }
         .card-custom:hover {
            transform: translateY(-5px);
         }
         footer {
            background: #6f42c1;
            color: #f8f9fa;
            padding: 1rem;
            text-align: center;
            border-radius: .5rem;
            margin-top: 2rem;
         }
      </style>
   </head>
   <body class="bg-light">
      <main>
         <div class="container py-4">
        <?php
    }

    public function nav($conf) {
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm mb-4">
            <div class="container-fluid">
               <a class="navbar-brand fw-bold" href="#"><?php echo $conf['site_name']; ?></a> 
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation"> 
                  <span class="navbar-toggler-icon"></span> 
               </button> 
               <div class="collapse navbar-collapse" id="navbarsExample05">
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                     <li class="nav-item"> 
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>" href="./">Home</a> 
                     </li>
                     <li class="nav-item"> 
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'signup.php') echo 'active'; ?>" href="signup.php">Sign Up</a> 
                     </li>
                     <li class="nav-item"> 
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'signin.php') echo 'active'; ?>" href="signin.php">Sign In</a> 
                     </li>
                     <li class="nav-item"> 
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'list_users.php') echo 'active'; ?>" href="list_users.php">View Users</a> 
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
        <?php
    }

    public function banner($conf) {
        ?>
        <div class="banner">
            <h1 class="display-4 fw-bold">Welcome to <?php echo $conf['site_name']; ?></h1>
            <p class="lead">A modern blogging platform where ideas, stories, and insights come alive.</p> 
        </div>
        <?php
    }

    public function content($conf) {
        ?>
        <div class="row g-4">
           <div class="col-md-6">
              <div class="card card-custom p-4">
                 <h2 class="fw-semibold">About</h2>
                 <p>
                 Readers can explore articles across different categories, leave comments, and engage in discussions.
                 Admins manage posts, approve content, and keep the community safe.
                 Whether you’re a casual blogger or a passionate storyteller, <?php echo $conf['site_name']; ?> is your space to be heard.
                 </p> 
              </div>
           </div>
           <div class="col-md-6">
              <div class="card card-custom p-4">
                 <h2 class="fw-semibold">Get Started</h2>
                 <p>
                 Create an account to start writing, connect with readers, and showcase your thoughts to the world. Already have one? Sign in and continue your journey. 
                 </p>
              </div>
           </div>
        </div>
        <?php
    }

    public function form_content($conf, $ObjForm, $ObjFncs) {
        ?>
        <div class="row g-4">
           <div class="col-md-6">
              <div class="card card-custom text-white p-4" style="background: linear-gradient(135deg, #6f42c1, #20c997);">
                 <?php 
                 if(basename($_SERVER['PHP_SELF']) == 'signup.php') {
                     $ObjForm->signup($conf, $ObjFncs); 
                 } elseif(basename($_SERVER['PHP_SELF']) == 'signin.php') {
                     $ObjForm->signin($conf, $ObjFncs); 
                 } 
                 ?>
              </div>
           </div>
           <div class="col-md-6">
              <div class="card card-custom p-4">
                 <h2 class="fw-semibold">About</h2>
                 <p>
                 Readers can explore articles across different categories, leave comments, and engage in discussions.
                 Admins manage posts, approve content, and keep the community safe.
                 Whether you’re a casual blogger or a passionate storyteller, <?php echo $conf['site_name']; ?> is your space to be heard.
                 </p>
              </div>
           </div>
        </div>
        <?php
    }

    public function footer($conf) {
        ?>
        <footer>
            <p class="mb-0">&copy; <?php echo date("Y"); ?> <?php print $conf['site_name']; ?> - All Rights Reserved</p>
        </footer>
         </div>
      </main>
      <script src="<?php echo $conf['site_url']; ?>/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   </body>
</html>
        <?php
    }
}
