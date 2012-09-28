
<div class="navbar">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="brand" href="/">CI TASKER</a>
        <ul class="nav">
          <li <?php if(strpos($this->uri->uri_string(), 'users') > 0) : print 'class="active"'; endif; ?> >
            <a href="/user">Users</a>
          </li>
          <li <?php if($this->uri->uri_string() == 'tasks') : print 'class="active"'; endif; ?> >
            <a href="/tasks">Tasks</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
