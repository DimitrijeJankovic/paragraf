<?php require_once 'app/views/_global/header.php'; ?>
<?php require_once 'app/views/_global/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nosioc osiguranja</th>
                <th scope="col">Telefon</th>
                <th scope="col">Email</th>
                <th scope="col">Datum putovanja</th>
                <th scope="col">Osiguranik</th>
                <th scope="col">Osiguranik Email</th>
                <th scope="col">Osiguranik Datum Rodnjenja</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($DATA['users'] as $user): ?>
                <tr>
                  <th scope="row"><?php echo $user->policy_id; ?></th>
                  <th scope="row"><?php echo $user->insurance_carrier; ?></th>
                  <th scope="row"><?php echo $user->mobile; ?></th>
                  <th scope="row"><?php echo $user->email; ?></th>
                  <th scope="row"><?php echo $user->starting_date; ?> - <?php echo $user->end_date; ?></th>
                  <th scope="row"><?php echo $user->name_of_insured; ?> <?php echo $user->surname_of_insured; ?></th>
                  <th scope="row"><?php echo $user->email_of_insured; ?></th>
                  <th scope="row"><?php echo $user->date_of_birth_of_insured; ?></th>
                </tr>
              <?php endforeach; ?>
              
            </tbody>
          </table>    
    </div>
</div>


<?php if (isset($DATA['massage'])): ?>
    <p class="text-center" id="message"><br><?php echo htmlspecialchars($DATA['massage']); ?></p>
<?php endif; ?>


<?php require_once 'app/views/_global/footer.php'; ?>