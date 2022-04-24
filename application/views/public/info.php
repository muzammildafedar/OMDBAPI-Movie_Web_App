<?php 

if(!$this->input->get('id')){
  redirect(base_url());

}
if(!$this->session->userdata('auth')){
  redirect('auth');

}


$getMvInfo = $this->MoviesApi->searchByid($this->input->get('id'));
// print_r($getMvInfo);


?>


<div class="container col-12" >
  <div class="row">
      <div class="card" >
        <img class="card-img-top" src="<?php echo $getMvInfo->Poster; ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?php echo $getMvInfo->Title; ?> ( <?php echo $getMvInfo->Year; ?> )</h5>
          <p class="card-text"><?php echo $getMvInfo->Plot; ?> </p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Writer: <?php echo $getMvInfo->Writer; ?></li>
          <li class="list-group-item">Actors: <?php echo $getMvInfo->Actors; ?></li>
          <li class="list-group-item">Language: <?php echo $getMvInfo->Language; ?></li>
           <li class="list-group-item">Awards: <?php echo $getMvInfo->Awards; ?></li>
          <li class="list-group-item">Actors: <?php echo $getMvInfo->Language; ?></li>

        </ul>
       
      </div>
      
    
  </div>
  
</div>
