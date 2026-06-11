<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Chat Room
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="vh-100 d-flex flex-column">

    <!-- Header -->
    <div class="bg-primary text-white p-3 shadow d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold">Chat Room</h4>

        <a href="<?= base_url('logout') ?>" class="btn btn-light btn-sm">
            <i class="fa-solid fa-right-from-bracket me-1"></i>
            Logout
        </a>
    </div>

    <!-- Chat Messages -->
    <div class="flex-grow-1 overflow-auto p-3" id="chat-box" style="background:#f4f1f8;">

        <?php foreach ($messages as $msg): ?>

            <div class="d-flex mb-2 <?= $msg->is_mine ? 'justify-content-end' : 'justify-content-start' ?>">

                <div class="px-3 py-2 rounded shadow-sm
                <?= $msg->is_mine ? 'bg-primary text-white' : 'bg-white border' ?>"
                    style="max-width: 60%;">

                    <!-- username -->
                    <div class="small fw-bold mb-1 opacity-75">
                        <?= esc($msg->username) ?>
                    </div>

                    <!-- message -->
                    <div>
                        <?= esc($msg->content) ?>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- Send Message -->
    <div class="border-top bg-light p-3 mx-5">
        <form action="<?= base_url('chat/send') ?>" method="post">
            <?= csrf_field() ?>

            <div class="input-group shadow-sm">

                <button
                    class="btn btn-light border border-2 border-secondary"
                    type="button">
                    <i class="fa-solid fa-paperclip"></i>
                </button>

                <input
                    type="text"
                    name="message"
                    class="form-control border-top border-2 border-bottom border-secondary"
                    placeholder="Napište zprávu..."
                    required>

                <button
                    class="btn btn-primary px-4"
                    type="submit">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>

            </div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>