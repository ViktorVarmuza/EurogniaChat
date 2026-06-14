
let lastMessageId = 0; // ukladani id posledni zpravy

document.addEventListener("DOMContentLoaded", function () {
    const chatBox = document.getElementById('chat-box');
    if (chatBox) {
        chatBox.scrollTop = chatBox.scrollHeight;
    }


    updateLastMessageId(); // zjistuje lastMessageId

    setInterval(checkForNewMessages, 1000); // nastaveni intervalu pro kontrolu jestli neprisla nova zprava
});

//odeslani zpravy
document.getElementById('messageForm').addEventListener('submit', async function (e) {
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

// kontrola novych zprav
async function checkForNewMessages() {
    try {
        //kontroluje nove zpravy od urciteho id aby se neposilali vsechny zpravy z databaze
        const response = await fetch(`${BASE_URL}api/messages?lastId=${lastMessageId}`, {
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

//pridava zpravu do chat-box
function addMessage(data) {
    const chatBox = document.getElementById('chat-box');
    if (!chatBox) return;

    const msgData = data.message || data;


    if (msgData.id && document.querySelector(`[data-msg-id="${msgData.id}"]`)) {
        return;
    }

    // PlastMessageId, pokud je nové ID vyšší
    if (msgData.id && msgData.id > lastMessageId) {
        lastMessageId = msgData.id;
    }


    const isMine = msgData.is_mine !== undefined ? msgData.is_mine : true;

    const username = msgData.username || 'Uživatel';
    const content = msgData.content || '';

    const alignmentClass = isMine ? 'justify-content-end' : 'justify-content-start';
    const bgClass = isMine ? 'bg-primary text-white' : 'bg-white border';


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

//zjistuje lastmessageid
function updateLastMessageId() {
    const messages = document.querySelectorAll('#chat-box [data-msg-id]');
    messages.forEach(msg => {
        const id = parseInt(msg.getAttribute('data-msg-id'));
        if (id > lastMessageId) {
            lastMessageId = id;
        }
    });
}


