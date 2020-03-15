<!--Navbar-->
<nav class="navbar navbar-dark bg-dark lighten-4">

  <!-- Navbar brand -->
  <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
  	<img class="img-thumbnail" src="https://logodix.com/logo/1597047.gif" height="100px" width="100px"/>
  </a>

  <!-- Collapse button -->
  <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarContent"
    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="navbarContent">
	
    <!-- Links -->
    <ul class="navbar-nav mr-auto">
    @if(session()->get('userID'))
          <li class="nav-item active">
            <a class="nav-link" href='home'>Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href='users'>Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myportfolio">Portfolio</a>
          </li>
        	@if(Session::get('role') === "admin")
        		<li class="nav-item">
                <a class="nav-link" href='displayUsers'>Admin Users</a>
              	</li>
            @endif
          <li class="nav-item">      
            <a class="nav-link" href='viewJobs'>Jobs</a>        
          </li>
          <li class="nav-item">
          	<a class="nav-link" href='viewInterestGroups'>Interest Groups</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" href='welcome'>Log Out</a>
          </li>
    @endif
    </ul>
    <!-- Links -->

  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->

<!-- /.Heading -->
<h2>@yield('heading')</h2>
