<link rel="stylesheet" href="/css/error.css" />

<main class="container error">
  <div class="error__content">
    <h1 class="error__message">
      <?php echo htmlspecialchars($message ?? 'Opps!'); ?>
    </h1>
    <div class="error__separator"></div>
    <p class="error__details">
      <?php echo htmlspecialchars( $details ?? 'An unexpected error occurred.',
      ); ?>
    </p>
  </div>
</main>
