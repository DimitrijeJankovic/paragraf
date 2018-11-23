<?php require_once 'app/views/_global/header.php'; ?>
<?php require_once 'app/views/_global/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <h3 class="h3">Polise osiguranja</h3>
        <div class="btnn">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addP">Dodaj Polisu</button>
        </div>
        <?php if (isset($DATA['policies'])): ?>
          
          <div class="mid">
            <table class="main table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nosioc osiguranja</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Email</th>
                    <th scope="col">Datum putovanja</th>
                    <th scope="col">Opcije</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($DATA['policies'] as $policie): ?>
                    <tr class="info" onclick="toggle('<?php echo $policie->policie_id; ?>');">
                      <th scope="row"><?php echo $policie->policie_id; ?></th>
                      <th scope="row"><?php echo $policie->carrier_of_policy; ?></th>
                      <th scope="row"><?php echo $policie->car_mobile; ?></th>
                      <th scope="row"><?php echo $policie->car_email; ?></th>
                      <th scope="row"><?php echo $policie->starts; ?> - <?php echo $policie->ends; ?></th>
                      <th scope="row">
                        <a href="<?php echo Configuration::BASE; ?>form/printPolice/<?php echo $policie->policie_id; ?>">
                          <i class="fas fa-print"></i>
                        </a>
                      </th>
                    </tr>
                    <tr>
                      <td class="hideExtra" id="row<?php echo $policie->policie_id; ?>">
                        <div>
                          <td class="hideExtra"> <!-- stay hiden -->
                            <tr id="main<?php echo $policie->policie_id; ?>" class="hideExtra">
                              <td colspan=6>
                                <h5 id="title-users">Osiguranici</h5>
                                <button type="button" class="btn-o btn btn-primary" data-toggle="modal" data-target="#addO">Dodaj Osiguranika</button>
                                <table class="users" id="table<?php echo $policie->policie_id; ?>">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Ime</th>
                                      <th>Email</th>
                                      <th>Datum rodjenja</th>
                                    </tr>
                                  </thead>
                                </table>
                              </td>
                            </tr>
                          </td>
                        </div>  
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>  
            </div>  
        <?php endif; ?>
    </div>
</div>
<?php if (isset($DATA['message'])): ?>
    <h2 class="text-center" id="message"><br><?php echo htmlspecialchars($DATA['message']); ?></h2>
<?php endif; ?>

<!-- Modal addP-->
<div class="modal fade bd-example-modal-lg" id="addP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova Polisa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo Configuration::BASE; ?>form/" class="form-horizontal form" onsubmit="return validateForm();">
          <div class="form-group row">
              <label for="carrier" class="col-sm-2 col-form-label">Nosilac osiguranja:</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="carrier" name="carrier" placeholder="Ime i Prezime" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="tel"class="col-sm-2 col-form-label">Telefon:</label>
              <div class="col-sm-10">
                  <input type="tel" class="form-control" id="tel" name="tel" placeholder="Telefon nosioca osiguranja (+381601479990)" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="email"class="col-sm-2 col-form-label">Email:</label>
              <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="c_email" placeholder="Email nosioca osiguranja" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="from"class="col-sm-2 col-form-label">Od:</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="from" name="from" required>
              </div>
          </div>
          <div class="form-group row date">
              <label for="to"class="col-sm-2 col-form-label">Do:</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="to" name="to" required>
              </div>
          </div>
          <button type="submit" name="submit" id="add" class="btn btn-primary">Sacuvaj</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nazad</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal addO-->
<div class="modal fade bd-example-modal-lg" id="addO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj Osiguranika</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form" name="formUsers" id="formUsers">
          <div id="addBtn" class="container">
            <div class="row">
                <button type="button" id="addUser" class="btn btn-primary col-sm-12"><i class="fas fa-user-plus"></i></button>
            </div>
          </div>
          <br>
          <input type="button" name="addUsers" id="addUsers"  class="btn btn-primary" value="Sacuvaj">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nazad</button>
      </div>
    </div>
  </div>
</div>


<?php require_once 'app/views/_global/footer.php'; ?>