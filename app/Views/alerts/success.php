<div id="js-alert-success" class="alert alert-success alert-dismissible fade shadow-sm <?= session()->getFlashdata('success') ? 'show' : 'd-none' ?>" role="alert" style="border-radius: 0.75rem;">
    <i class="fa-solid fa-circle-check me-2"></i>
    <span class="alert-text"><?= session()->getFlashdata('success') ? esc(session()->getFlashdata('success')) : '' ?></span>
    <button type="button" class="btn-close close-alert-btn" data-js-dismiss="alert" aria-label="Close"></button>
</div>