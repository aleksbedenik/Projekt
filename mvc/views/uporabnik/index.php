<p>Seznam vseh uporabnikov</p>
<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Ime</th>
        <th>Priimek</th>
        <th>Naslov</th>
        <th>Pošta</th>
        <th>Telefon</th>
        <th>Spol</th>
        <th>Starost</th>
        <th>Admin</th>
        <th>Urejanje</th>
    </tr>
    </thead>
    <tbody>

    <!-- tukaj se sprehodimo čez array oglasov in izpisujemo vrstico posameznega oglasa-->

    <?php foreach($uporabniki as $uporabnik) { ?>
        <tr>
            <td><?php echo $uporabnik->id; ?></td>
            <td><?php echo $uporabnik->username; ?></td>
            <td><?php echo $uporabnik->email; ?></td>
            <td><?php echo $uporabnik->ime; ?></td>
            <td><?php echo $uporabnik->priimek; ?></td>
            <td><?php echo $uporabnik->naslov; ?></td>
            <td><?php echo $uporabnik->posta; ?></td>
            <td><?php echo $uporabnik->telefon; ?></td>
            <td><?php echo $uporabnik->spol; ?></td>
            <td><?php echo $uporabnik->starost; ?></td>
            <td><?php echo $uporabnik->admin; ?></td>
            <td>
                <a href='?controller=uporabnik&action=uredi&id=<?php echo $uporabnik->id; ?>'>Uredi</a>
            </td>
        </tr>
    <?php } ?>




    </tbody>
</table>