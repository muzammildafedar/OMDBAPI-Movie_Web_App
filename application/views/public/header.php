<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/mdb.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin.css" />
  
</head>


<body>
  <?php if($this->session->userdata('auth') != '' ){ ?>
    <header>
      <!-- Sidebar -->
      <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
          <div class="list-group list-group-flush mx-3 mt-4">
            <a href="<?php echo base_url();?>?title=bollywood" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
              <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Movies</span>
            </a>

          <a href="<?php echo base_url();?>?title=john wick" class="list-group-item list-group-item-action py-2 ripple"><i
            class="fas fa-lock fa-fw me-3"></i><span>Top pick for you</span></a>
            <a href="<?php echo base_url();?>?title=marvel" class="list-group-item list-group-item-action py-2 ripple"><i
              class="fas fa-chart-line fa-fw me-3"></i><span>Trending</span></a>

      <a  
            data-mdb-toggle="collapse"
            href="#collapseExample"
            role="button"
            aria-expanded="false"
            aria-controls="collapseExample" class="list-group-item list-group-item-action py-2 ripple active">
            <i class="fas fa-angle-down"></i> <span>My lists </span>
          </a>
              <div class="collapse mt-3" id="collapseExample">
                <?php $lists = $this->db->get_where('list', array('email' => $this->session->userdata('auth')))->result();  ?>
                <?php foreach($lists as $value) {  ?>
                <a href="<?php echo base_url();?>?listid=<?php echo $value->id?>" class="list-group-item list-group-item-action py-2"><?php echo $value->name; ?> </a>
              <?php } ?>
              </div>
            </div>
          </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
          <!-- Container wrapper -->
          <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>

          <!-- Brand -->
          <a class="navbar-brand" href="#">
            <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="25" alt="" loading="lazy" />
          </a>
          <!-- Search form -->
          <form class="d-none d-md-flex input-group w-auto my-auto" method="get">
            <input autocomplete="off" type="search" name="title" class="form-control rounded"
            placeholder='Search by title' minlength="4" required style="min-width: 225px" />
            <button class="btn btn-primary"> <i class="fas fa-search"></i> </button>

          </form>

          <!-- Right links -->
          <ul class="navbar-nav ms-auto d-flex flex-row" >
            <!-- Notification dropdown -->
            <li class="nav-item dropdown">
              <button
              type="button"
              class="btn btn-primary"
              data-mdb-toggle="modal"
              data-mdb-target="#exampleModal"
              data-mdb-whatever="@mdo"
              >
              <i class="fas fa-plus"> Create playlist</i>
            </button>


            </li>   


            <!-- Avatar -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="<?php echo base_url()?>logout"
              id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php $get = $this->db->get_where('user', array('email' => $this->session->userdata('auth')))->row();
              echo $get->name; ?> (Logout)
              

            </a>
           
      </li>
    </ul>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</header>
<?php } ?>
<?php if($this->uri->segment(1)  != 'auth') { ?>
  <main style="margin-top: 58px">
    <div class="container pt-4">
    <?php } ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create my playlist</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">

        <div class="modal-body">
          <div class="mb-3">
            <div class="form-outline mb-4">
              <input type="text" id="loginName" name="pname" class="form-control" />
              <label class="form-label"  for="loginName">Choose playlist name</label>
            </div>

          </div>
          <div class="mb-3">
           <div class="form-outline mb-4">
            <textarea class="form-control" name="desc" id="message-text"></textarea>
            <label class="form-label"  for="loginName">Description</label>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label"  for="loginName">Privacy  </label>
          <div class="btn-group">
            <input type="radio" class="btn-check" value="public" name="privacy" id="option1" autocomplete="off" checked />
            <label class="btn btn-secondary" for="option1">Public</label>

            <input type="radio" class="btn-check" value="private" name="privacy" id="option3" autocomplete="off" />
            <label class="btn btn-secondary" for="option3">Private</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>

  </div>
</div>
</div>