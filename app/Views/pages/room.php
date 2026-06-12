<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('alerts/alerts') ?>

<div class="vh-100 d-flex flex-column">

    <div class="bg-primary text-white p-3 shadow d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold">Chat Room</h4>

        <a href="<?= base_url('logout') ?>" class="btn btn-light btn-sm">
            <i class="fa-solid fa-right-from-bracket me-1"></i>
            Logout
        </a>
    </div>

    <div class="flex-grow-1 overflow-auto p-3 bg-tertiary" id="chat-box">

        <?php foreach ($messages as $msg): ?>

            <div class="d-flex mb-2 <?= $msg->is_mine ? 'justify-content-end' : 'justify-content-start' ?>">

                <div class="px-3 py-2 rounded shadow-sm
                <?= $msg->is_mine ? 'bg-primary text-white' : 'bg-white border' ?>"
                    style="max-width: 60%;">

                    <div class="small fw-bold mb-1 opacity-75">
                        <?= esc($msg->username) ?>
                    </div>

                    <div>
                        <?= esc($msg->content) ?>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <div class="border-top border-2 border-secondary bg-light p-3 mx-5">
        <form id="messageForm" action="<?= base_url('api/send') ?>" method="post">
            <?= csrf_field() ?>

            <div class="input-group shadow-sm">

                <button
                    class="btn btn-light border border-2 border-secondary"
                    type="button">
                    <i class="fa-solid fa-paperclip"></i>
                </button>

                <input
                    type="text"
                    name="content"
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

<script>
    // 1. CHYBĚLO: Definice proměnné pro hlídání posledního ID zprávy
    let lastMessageId = 0;

    document.addEventListener("DOMContentLoaded", function() {
        const chatBox = document.getElementById('chat-box');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // 2. CHYBĚLO: Načtení nejvyššího ID zpráv, které už na stránce jsou z PHP
        updateLastMessageId();

        // Interval nastaven na 1 sekundu (1000 ms) je v pořádku
        setInterval(checkForNewMessages, 1000);
    });

    document.getElementById('messageForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const csrfInput = this.querySelector('input[type="hidden"]');

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const json = await response.json();
                console.log('Úspěšně uloženo:', json);

                this.reset();

                if (json.csrf_token && csrfInput) {
                    csrfInput.value = json.csrf_token;
                }

                // Vykreslíme naši novou zprávu
                addMessage(json);

            } else {
                alert('Něco se nepovedlo. Zkuste obnovit stránku.');
            }
        } catch (error) {
            console.error('Chyba při odesílání:', error);
            alert('Chyba sítě. Zkuste obnovit stránku.');
        }
    });

    async function checkForNewMessages() {
        try {
            // Nyní už lastMessageId bezpečně existuje
            const response = await fetch(`<?= base_url('api/messages') ?>?lastId=${lastMessageId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const messages = await response.json();

                if (messages.length > 0) {
                    messages.forEach(msg => {
                        addMessage(msg);
                    });
                }
            }
        } catch (error) {
            console.error('Chyba při stahování nových zpráv:', error);
        }
    }

    function addMessage(data) {
        const chatBox = document.getElementById('chat-box');
        if (!chatBox) return;

        const msgData = data.message || data;

        // Ochrana proti duplicitám: Pokud už zpráva v chatu je, podruhé ji nepřidáváme
        if (msgData.id && document.querySelector(`[data-msg-id="${msgData.id}"]`)) {
            return;
        }

        // Posuneme hodnotu lastMessageId, pokud je nové ID vyšší
        if (msgData.id && msgData.id > lastMessageId) {
            lastMessageId = msgData.id;
        }

        // OPRAVA: Dynamické barvy a zarovnání podle "is_mine" ze serveru
        // Pokud posíláš novou zprávu přes POST, is_mine tam z ApiControlleru nemusí přijít,
        // proto dáme "true" jako fallback (protože jsi ji právě odeslal ty).
        const isMine = msgData.is_mine !== undefined ? msgData.is_mine : true;

        const username = msgData.username || 'Uživatel';
        const content = msgData.content || '';

        const alignmentClass = isMine ? 'justify-content-end' : 'justify-content-start';
        const bgClass = isMine ? 'bg-primary text-white' : 'bg-white border';

        // Vykreslení HTML struktury (přidán atribut data-msg-id)
        const messageHtml = `
            <div class="d-flex mb-2 ${alignmentClass}" data-msg-id="${msgData.id || ''}">
                <div class="px-3 py-2 rounded shadow-sm ${bgClass}" style="max-width: 60%;">
                    <div class="small fw-bold mb-1 opacity-75">
                        ${username}
                    </div>
                    <div>
                        ${content}
                    </div>
                </div>
            </div>
        `;

        chatBox.insertAdjacentHTML('beforeend', messageHtml);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // CHYBĚLO: Pomocná funkce, která projde PHP zprávy při načtení a zjistí nejvyšší ID
    function updateLastMessageId() {
        const messages = document.querySelectorAll('#chat-box [data-msg-id]');
        messages.forEach(msg => {
            const id = parseInt(msg.getAttribute('data-msg-id'));
            if (id > lastMessageId) {
                lastMessageId = id;
            }
        });
    }
</script>

<?= $this->endSection() ?>