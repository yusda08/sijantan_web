<div class="container-fluid">
   <div class="row">
       <div class="col-lg-3">
           <div class="card">
               <div class="card-header">
                   Tampilan
               </div>
               <div class="card-body">

               </div>
               <div class="card-footer">

               </div>
           </div>
       </div>
       <div class="col-lg-9">
           <div class="card ">
               <div class="card-header">
                   Peta
               </div>
               <div class="card-body">
                   <div id="map"></div>
               </div>
           </div>
       </div>
   </div>
</div>
<?= $this->include('backend/javasc'); ?>

<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -2.932641, lng: 115.162938 },
            zoom: 15,
        });
    }
</script>