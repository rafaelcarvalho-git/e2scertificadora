<section class="d-flex flex-row text-center mx-auto mb-4">       
    <div class="filtros d-flex mx-auto">          
      <input id="data-inicio" type="date" class="form-control"> <p class="mx-auto my-auto">até</p>
  	   <input id="data-fim" type="date" class="form-control">
      <button class="btn btn-primary" onclick="searchData()"><i class="bi bi-search"></i></button>
    </div>  
</section>
<script>
function searchData() {
  var location = window.location.pathname;
  var dataInicio = document.getElementById('data-inicio');
  var dataFim = document.getElementById('data-fim');
  window.location = location+'?start='+dataInicio.value+'&end='+dataFim.value;
}
</script>