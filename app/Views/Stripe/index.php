<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet">
  </head>
  <body>
    <div class="container mt-5">
      <h2 class="mb-4 text-center">Make a Donation</h2>
      <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
      </div>
      <?php endif; ?>
      <form id="donation_form" method="POST" action="<?= base_url('stripe/payment'); ?>">
        <div class="mb-3">
          <label for="donation_amount" class="form-label">
          Donation Amount (USD)
          </label>
          <!-- step="1" use to prevent decimals value -->
          <input type="number" class="form-control" id="donation_amount"
            name="amount" min="1" step="1" required>
        </div>
        <button type="submit" id="submitDonation" class="btn btn-warning w-100 mb-3">
        Donate with <span id="button_name">Stripe</span>
        </button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"> </script>
  </body>
</html>