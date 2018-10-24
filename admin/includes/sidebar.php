<div class="col-md-2 sidenav hidden-xs">
  <div id="sidebar">
    <ul class="list-group">
      <li class="list-group-item"><a href="index.php" class="list-group-item active">
        DASHBORD
      </a></li>
  <li class="list-group-item"><a href="products.php" class="list-group-item"> Add Recipes</a></li>
  <li class="list-group-item">  <a href="achieve.php" class="list-group-item"> Archived</a></li>
  <li class="list-group-item"><a href="categories.php" class="list-group-item">Categories</a></li>
  <li class="list-group-item">
    <?php if(has_permission('admin')): ?>
    <a href="users.php" class="list-group-item"> Users</a>
  <?php endif; ?>
  </li>
</ul>
</div>
</div>
<br>
