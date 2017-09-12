<table class="table table-hover" id="paginacao-ajax">
  <thead>
    <tr>
      <th >#</th>
	  <th style="display:none">id</th>
      <th>Nome</th>
      <th>Contato</th>
      <th>Telefone</th>
	  <th>Endereço</th>
	  <th>Cidade</th>
	  
    </tr>
  </thead>
  <tbody>

	 <?php
		$query = "SELECT * FROM unidade ORDER BY id DESC";       
		$records_per_page=7;
		$newquery = $crud_unidade->paging($query,$records_per_page);
		$crud_unidade->dataview($newquery);
	 ?>
  </tbody>
</table>

----- footer


$(document).ready(function () {
$('.page-link').click(function (e) {
   e.preventDefault();

   var url = $(this).data('href');
   var page = $(this).data('data-href');

   $.ajax({
         type:"get",
         url: url,
         data: {
            currentPage: page
         },  
         success: function (response) {

           var html = $('<h1/>', {html : response}).find('#paginacao-ajax');
           $('#paginacao-ajax').html( html )    


         }
   });
})

</script>
