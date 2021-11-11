
<?php
include_once "headerafter.php"; 
echo ('
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#glassAnimals">
    Glass Animals Info
  </button>  
</div>

<div class="modal fade" id="glassAnimals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Glass Animals</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Glass Animals are an English indie rock band from Oxford consisting of members Dave Bayley (lead vocals, guitar), Drew MacFarlane (guitar, keys, backing vocals), Edmund Irwin-Singer (bass, keys, backing vocals), and Joe Seaward (drums).
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Track Artist</button>
      </div>
    </div>
  </div>
  ');
?>