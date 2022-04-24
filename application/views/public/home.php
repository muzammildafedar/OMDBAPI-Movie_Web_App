<?php $gettList = $this
    ->db
    ->get_where('list', array(
    'email' => $this
        ->session
        ->userdata('auth')
))
    ->result(); ?>

<?php

if ($this
    ->input
    ->get('listid'))
{
    $getParticularListInfo = $this
        ->db
        ->get_where('list', array(
        'id' => $this
            ->input
            ->get('listid')
    ))
        ->row();
    $filteredData = $this
        ->Basic
        ->getByListid($this
        ->input
        ->get('listid'));
    // print_r($getParticularListInfo);
    

    
}

// print_r($getParticularListInfo);

?>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose playlist</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="btn-group ">
          <input type="hidden" id="imdbid">

          <select class="select" id="playlistid">
            <option value="" checked disabled>Choose playlist</option>

            <?php foreach ($gettList as $val)
{ ?>

              <option value="<?php echo $val->id ?>"><?php echo $val->name; ?></option>
            <?php
} ?>
            
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-secondary" onclick="save();">Save</button>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function setValue(value){
    document.getElementById('imdbid').value = value; 
  }
  function save(){
    var playlistid = document.getElementById('playlistid').value; 
    var imdbid = document.getElementById('imdbid').value; 
    console.log(playlistid);
    console.log(imdbid); 
    window.open('<?php echo base_url(); ?>save-movie?imdbid='+imdbid+'&&listid='+playlistid, '_self');


  }

</script>




<?php if ($this
    ->input
    ->get('listid'))
{ ?>
  <div class="col-xl-12 col-md-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between p-md-1">
          <div class="d-flex flex-row">
            <div class="align-self-center col-xl-4 col-md-4 mb-4">
              <i class="fa-regular fa-photo-film-music"></i>
            </div>
            <div>
              <h4>Playlist name: <?php echo $getParticularListInfo->name; ?></h4>
              <p class="mb-0">Description: <?php echo $getParticularListInfo->descr; ?></p>
            </div>

          </div>
          <div class="align-self-center col-xl-4 col-md-4 mb-4">
            <h5 class="h5 mb-0">Created by: <?php echo $getParticularListInfo->email; ?></h5>
            <h6 class="h5 mb-0">Privacy: <?php echo $getParticularListInfo->privacy; ?></h6>
          </div>
          <div class="align-self-center col-xl-4 col-md-4 mb-4">
            <h6 class="h6 mb-0">URL to share</h6>
            <input type="text" id="myInput" value="<?php echo base_url(); ?>?listid=<?php echo $this
        ->input
        ->get('listid'); ?>" name="">
            <button onclick="myFunction()">Copy</button> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function myFunction() {
      /* Get the text field */
      var copyText = document.getElementById("myInput");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    } 
  </script>


  <div class="container" >
    <div class="row">
      <?php
    if ($getParticularListInfo->privacy == 'public' || $this
        ->session
        ->userdata('auth'))
    {

        foreach ($filteredData as $insideValues)
        {
            // print_r($insideValues->imdbid);
            $data = $this
                ->MoviesApi
                ->searchByid($insideValues->imdbid);
           
             $this->db->select('*');
                $this->db->from('saved as s');
                $this->db->join('list as l', 'l.id = s.listid');
                $this->db->where('l.email',$this->session->userdata('auth'));
                $this->db->where('s.imdbid', $insideValues->imdbid);
               $checkIsEmptyQuery =  $this->db->get();
                  $checkIsEmpty = $checkIsEmptyQuery->row();
                // print_r($checkIsEmpty)

?>

          <div class="col-md-4 col-sm-4">

            <div class="card"
            >
            <img src="<?php echo $data->Poster; ?>" class="card-img-top" alt="No poster available" height="250" width="0" />
            <div class="card-body">
              <h5 class="card-title"><?php echo $data->Title; ?>    </h5>
              <p class="card-text">Year: <?php echo $data->Year; ?> </p>


              <?php if (empty($checkIsEmpty))
            { ?>
               <a href="#!" class="btn btn-primary" data-mdb-toggle="modal"
               data-mdb-target="#exampleModal2"
               onclick="setValue('<?php echo $data->imdbID; ?>');"
               data-mdb-whatever="@getbootstrap"
               ><i class="fas fa-plus"  > Save</i></a>

             <?php
            }
            else
            { ?>
              <a href="#!" class="btn btn-primary" data-mdb-toggle="modal"
              ><i class="fa fa-check" aria-hidden="true"> Saved</i></a>

            <?php
            } ?>

            <a href="<?php echo base_url();?>info?id=<?php echo $data->imdbID; ?>" class="btn btn-primary">More info <i class="fas fa-chevron-circle-right"></i></a>

          </div>
        </div>  
      </div>



      <?php
        }
    }

}
elseif ($this
    ->input
    ->get('title'))
{ ?>
  <div class="container" >
    <div class="row">
 <?php
    $getBytitle = $this
        ->MoviesApi
        ->searchBytitle($this
        ->input
        ->get('title'));

    if($getBytitle->Response == 'False'){
      echo $getBytitle->Error;

    }

    foreach ($getBytitle as $insideValues)
    {
        if (is_array($insideValues) || is_object($insideValues))
        {

            // print_r($insideValues);
            foreach ($insideValues as $val)
            {

                
                    $this->db->select('*');
                $this->db->from('saved as s');
                $this->db->join('list as l', 'l.id = s.listid');
                $this->db->where('l.email',$this->session->userdata('auth'));
                $this->db->where('s.imdbid', $val->imdbID);
               $checkIsEmptyQuery =  $this->db->get();
                  $checkIsEmpty = $checkIsEmptyQuery->row();

?>

  

  <div class="col-md-4 col-sm-4">

    <div class="card"
    >
    <img src="<?php echo $val->Poster; ?>" class="card-img-top" alt="No poster available" height="250" width="0" />
    <div class="card-body">
      <h5 class="card-title"><?php echo $val->Title; ?>    </h5>
      <p class="card-text">Year: <?php echo $val->Year; ?> </p>


      <?php if (empty($checkIsEmpty))
                { ?>
       <a href="#!" class="btn btn-primary" data-mdb-toggle="modal"
       data-mdb-target="#exampleModal2"
       onclick="setValue('<?php echo $val->imdbID; ?>');"
       data-mdb-whatever="@getbootstrap"
       ><i class="fas fa-plus"  > Save</i></a>

     <?php
                }
                else
                { ?>
      <a href="#!" class="btn btn-primary" data-mdb-toggle="modal"
      ><i class="fa fa-check" aria-hidden="true"> Saved</i></a>

    <?php
                }

?>

    <a href="<?php echo base_url();?>info?id=<?php echo $val->imdbID; ?>" class="btn btn-primary">More info <i class="fas fa-chevron-circle-right"></i></a>

  </div>
</div>  
</div>




<?php
            }
        }

    }
}

else
{ ?>  


  <div class="container" >
    <div class="row">
      <?php
    // print_r($data);
    foreach ($data as $mainValue)
    {
        // print_r($mainValue);
        foreach ($mainValue as $subValue)
        {
            if (is_array($subValue) || is_object($subValue))
            {
                foreach ($subValue as $insideValues)
                {
                    
                         $this->db->select('*');
                $this->db->from('saved as s');
                $this->db->join('list as l', 'l.id = s.listid');
                $this->db->where('l.email',$this->session->userdata('auth'));
                $this->db->where('s.imdbid', $insideValues->imdbID);
               $checkIsEmptyQuery =  $this->db->get();
                  $checkIsEmpty = $checkIsEmptyQuery->row();


?>

            <div class="col-md-4 col-sm-4">

              <div class="card"
              >
              <img src="<?php echo $insideValues->Poster; ?>" class="card-img-top" alt="No poster available" height="250" width="0" />
              <div class="card-body">
                <h5 class="card-title"><?php echo $insideValues->Title; ?>    </h5>
                <p class="card-text">Year: <?php echo $insideValues->Year; ?> </p>

                <?php if (empty($checkIsEmpty))
                    { ?>
                 <a href="#!" class="btn btn-primary" data-mdb-toggle="modal"
                 data-mdb-target="#exampleModal2"
                 onclick="setValue('<?php echo $insideValues->imdbID; ?>');"
                 data-mdb-whatever="@getbootstrap"
                 ><i class="fas fa-plus"  > Save</i></a>

               <?php
                    }
                    else
                    { ?>
                <a href="#!" class="btn btn-primary" data-mdb-toggle="modal"
                ><i class="fa fa-check" aria-hidden="true"> Saved</i></a>

              <?php
                    } ?>
              <a href="<?php echo base_url();?>info?id=<?php echo $insideValues->imdbID; ?>" class="btn btn-primary">More info <i class="fas fa-chevron-circle-right"></i></a>

            </div>
          </div>  
        </div>


      <?php
                }
            }

        }

    }
}

?>

</div>
</div>
