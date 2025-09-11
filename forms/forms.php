<?php
class forms {
    public function signup() {
?>
<h1>Sign Up</h1>
<form method="POST" action="signup.php">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
    <div id="nameHelp" class="form-text">We'll never share your name with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <?php $this->submit_button("Sign Up", "signup"); ?>
  <a href="signin.php">Already have an account? Log in</a>
</form>
<?php
    }

    private function submit_button($value, $name) {
        ?>
        <button type="submit" class="btn btn-primary" name="<?php echo $name; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></button>
        <?php
    }

    public function signin() {
        ?>
       <h1>Sign In</h1>
<form method="POST" action="signin.php">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <?php $this->submit_button("Sign In", "signin"); ?>
  <a href="signup.php">Don't have an account? Sign Up</a>
</form>
<?php
    }
}
