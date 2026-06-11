<div id="js-alert-errors" class="alert alert-danger alert-dismissible fade shadow-sm <?= session()->getFlashdata('errors') ? 'show' : 'd-none' ?>" role="alert" style="border-radius: 0.75rem;">
    <i class="fa-solid fa-circle-exclamation me-2"></i>
    <strong>Pozor!</strong>
    <ul class="mb-0 mt-2 px-3 small alert-text-list">
        <?php if (session()->getFlashdata('errors')): ?>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <button type="button" class="btn-close close-alert-btn" data-js-dismiss="alert" aria-label="Close"></button>
</div>

<div id="js-alert-error" class="alert alert-danger alert-dismissible fade shadow-sm <?= session()->getFlashdata('error') ? 'show' : 'd-none' ?>" role="alert" style="border-radius: 0.75rem;">
    <i class="fa-solid fa-circle-exclamation me-2"></i>
    <span class="alert-text"><?= session()->getFlashdata('error') ? esc(session()->getFlashdata('error')) : '' ?></span>
    <button type="button" class="btn-close close-alert-btn" data-js-dismiss="alert" aria-label="Close"></button>
</div>