<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Regal Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?= base_url('vendors/mdi/css/materialdesignicons.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('vendors/feather/feather.css')?>">
  <link rel="stylesheet" href="<?= base_url('vendors/base/vendor.bundle.base.css')?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url('vendors/flag-icon-css/css/flag-icon.min.css')?>"/>
  <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('vendors/jquery-bar-rating/fontawesome-stars-o.css')?>">
  <link rel="stylesheet" href="<?= base_url('vendors/jquery-bar-rating/fontawesome-stars.css')?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('images/favicon.png')?>" />
<script>
  document.getElementById('myForm').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                // reCAPTCHA is not verified
                alert("Please complete the reCAPTCHA.");
                event.preventDefault();
            }
        });
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>