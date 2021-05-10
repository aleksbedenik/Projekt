<!--enostaven pogled za informiranje o uspešnosti dodajanja oglasa -->
<!-- ta se nahaja v spremenljivki $oglas, ki smo jo pripravili v kontrolerju, uporabniku pa damo še povezavo na izpis celotnega oglasa (preko akcije prikazi) -->

<p>Oglas je bil uspešno shranjen!</p>
<p>Viden je <a href="?controller=oglasi&action=prikazi&id=<?php echo $oglas->id; ?>">tukaj</a></p>