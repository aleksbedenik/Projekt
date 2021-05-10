<p>Seznam vseh oglasov</p>
<!-- pogled za pregeld vseh oglasov-->
<!-- na vrhu damu uporabniku gumb, s katerim proži akcijo dodaj, da lahko dodaja nove uporabnike -->
<a href="?controller=oglasi&action=dodaj" class="btn btn-primary">Dodaj <i class="fas fa-plus"></i></a>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Naslov</th>
        <th>Vsebina</th>
        <th>Datum Objave</th>
      </tr>
    </thead>
    <tbody>
 
 <!-- tukaj se sprehodimo čez array oglasov in izpisujemo vrstico posameznega oglasa-->

<?php foreach($oglasi as $oglas) { ?>
  <tr>
  <td><?php echo $oglas->naslov; ?></td>
  
  <td>
    <!-- pri vsakem oglasu dodamo povezavo na akcijo prikaži, z idjem oglasa. Uporabnik lahko tako proži novo akcijo s pritiskom na gumb.-->
    <a href='?controller=oglasi&action=prikazi&id=<?php echo $oglas->id; ?>'>Poglej vsebino</a>
	</td>
	<td><?php echo $oglas->datumObjave; ?></td>
 </tr>
<?php } ?>

    
       
      
    </tbody>
  </table>