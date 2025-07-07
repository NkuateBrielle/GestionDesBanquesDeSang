<form method="post" action="/route">
    <input type="hidden" name="_csrf" value="<?= $this->generateCSRFToken() ?>">
    <!-- autres champs -->
</form>