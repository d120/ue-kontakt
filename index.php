<?php

      function perform_send_mail($to, $subject, $body) {
        $headers = "From: ue-noreply@d120.de";
        $headers = $headers . "\r\n" . "CC: ue@fachschaft.informatik.tu-darmstadt.de";
        $headers = $headers . "\r\n" . "Content-Type: text/html; charset=utf-8";
        $headers = $headers . "\r\n" . "Reply-To: ue@fachschaft.informatik.tu-darmstadt.de";
        return mail($to, $subject, $body, $headers);
      }

      function perform_information($email) {
        return perform_send_mail($email, 'TU Darmstadt Informatik: Interesse an der UE', '
<p>
Hallo UE-Interessierte*r,
</p>

<p>
du hast angegeben, dass du dich für die Universitätserfahrung der Informatik an der TU Darmstadt interessierst. Das freut uns :)
</p>

<p>
Weitere Informationen findet du unter https://d120.de/ue. Wenn du weiterhin Interesse an der Teilnahme hast, schreibe uns einfach eine E-Mail an ue@d120.de. Du kannst dich natürlich auch gerne bei Fragen an uns 
wenden. Wenn du dich anmeldest, schreibe uns bitte die folgenden Infos:
<ul>
  <li>deinen Namen,</li>
  <li>dein voraussichtliches Unistartsemester,</li>
  <li>mögliche Wochentage/Zeiträume für einen UE-Termin, soweit bekannt,</li>
  <li>und, wenn du eine Teilnahmebestätigung für die Schule haben möchtest: Name und Anschrift der Schule.</li>
</ul>
</p>

<p>
Liebe Grüße <br>
Die UE-Orga <br>
Stefanie Blümer <br>
Tim Pollandt
</p>');
      }

      function perform_question($email, $sender, $message) {
        return perform_send_mail($email, 'TU Darmstadt, Informatik: Fragen zur UE', "
<p>
Hallo $sender,
</p>
<p>
Wir haben die folgende Anfrage von dir erhalten und werden diese Zeitnah bearbeiten:
</p

<p>
" . htmlspecialchars($message) . "
</p>

<p>
Liebe Grüße <br>
Die UE-Orga <br>
Stefanie Blümer <br>
Tim Pollandt
</p>
");
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_GET['action']) {
        case 'information':
          $success = perform_information($_POST['email']);
          break;
        case 'question':
          $success = perform_question($_POST['email'], $_POST['name'], $_POST['message']);
          break;
        default:
          $success = false;
          break;
        }
      }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex, follow">

  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="jquery.min.js">
  <script src="bootstrap.min.js">

  <title>UE :: Kontakt</title>
</head>
<body>

  <div class="container" style="margin-top: 5ex;">
<?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($success) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Anmeldung erfolgreich.</strong> Wir haben deine Anmeldung erhalten. Du wirst in Kürze eine E-Mail erhalten.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php
        } else {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Hoppla, es ist etwas schief gelaufen.</strong> Bitte versuche es später erneut.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php
        }
      }
?>

    <div class="jumbotron">
      <h1 class="display-4">Informationen zur UE erhalten</h1>
      <p class="lead">Melde dich hier an, um eine E-Mail mit weiteren Informationen zur UE zu erhalten.</p>
      <form class="needs-validation" action="?action=information" method="POST" autocomplete="off">
        <div class="form-group">
          <label for="email">E-Mail-Adresse</label>
          <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn-primary">Informationen Erhalten</button>
      </form>
    </div>

    <div class="jumbotron">
      <h1 class="display-4">Fragen zur UE</h1>
      <p class="lead">Hier kannst du Fragen stellen, die wir zeitnah beantworten werden.</p>
      <form class="needs-validation" action="?action=question" method="POST" autocomplete="off">
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="email">E-Mail-Adresse</label>
              <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Absender</label>
              <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="message">Mitteilung</label>
              <textarea class="form-control" id="message" name="message"></textarea>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Anmelden</button>
          </div>
        </div>
      </form>
    </div>

    <!--
    <div class="jumbotron">
      <h1 class="display-4">Anmeldung zur UE</h1>
      <p class="lead">Hier kannst du dich direkt zur UE anmelden, wir werden dich dann in naher Zukunft kontakieren.</p>
      <form class="needs-validation" action="?action=register" method="POST" autocomplete="off">
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="email">E-Mail-Adresse</label>
              <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Absender</label>
              <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="start_season">Voraussichtliches Startsemester</label>
              <input type="number" class="form-control" id="start_season" name="start_season">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="timeframe">Mögliche Wochentage für einen UE-Termin</label>
              <div class="form-check form-check-inline" id="timeframe">
                <input type="checkbox" class="form-check-input" id="monday" name="monday">
                <label class="form-check-label" for="monday">Monday</label>
              </div>
              <div class="form-check form-check-inline" id="timeframe">
                <input type="checkbox" class="form-check-input" id="tuesday" name="tuesday">
                <label class="form-check-label" for="tuesday">Dienstag</label>
              </div>
              <div class="form-check form-check-inline" id="timeframe">
                <input type="checkbox" class="form-check-input" id="wednesday" name="wednesday">
                <label class="form-check-label" for="wednesday">Mittwoch</label>
              </div>
              <div class="form-check form-check-inline" id="timeframe">
                <input type="checkbox" class="form-check-input" id="thursday" name="thursday">
                <label class="form-check-label" for="thursday">Donnerstag</label>
              </div>
              <div class="form-check form-check-inline" id="timeframe">
                <input type="checkbox" class="form-check-input" id="friday" name="friday">
                <label class="form-check-label" for="friday">Freitag</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="message">Mitteilung</label>
              <textarea class="form-control" id="message" name="message"></textarea>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Anmelden</button>
          </div>
        </div>
      </form>
    </div>
    -->
  </div>
</body>
</html>
