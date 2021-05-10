<!--enostaven pogled za prikaz enega oglasa -->
<!-- ta se nahaja v spremenljivki $oglas, ki smo jo pripravili v kontrolerju -->

<div class="panel panel-default">
    <div class="panel-heading"><h2><?php echo $oglas->naslov; ?></h2><span class="label label-primary"><?php echo $oglas->datumObjave; ?></span></div>
    <div class="panel-body"><?php echo $oglas->vsebina; ?></div>



</div> 
