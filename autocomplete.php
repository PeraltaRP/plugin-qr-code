<?php
function autocomplete(){
    ?>
<div class="ui-widget" style="margin-top:50px">
    <label for="tags">Nome do Item: </label>
    <input type="text"  id="tags" name="item">
    <!-- <input id="tags"> -->

    <button onclick="onClick(this)"> Exemplo 2 </button>
</div>

<script>
    var availablePosts = [
<?php
     $dados = consulta_banco_de_dados();
     foreach($dados as $value){
         echo '"'. $value->titulo_exibicao .'",';
     }

?>
    ];

    
</script>



<?
}