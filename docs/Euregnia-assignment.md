# Zadání projektu
Vytvořte jednoduchou webovou aplikaci pro chatování. Bude obsahovat minimálně dvě stránky- přihlášení a jednu chatovací místnost, do které budou moct přihlášení uživatelé psát zprávy.

## Návrh
V prvním kroku navrhněte relační databázi, zpracujte pro ni jednoduchý ER diagram a vytvořte grafický návrh stránky s chatovací místností (přihlašovací formulář není třeba).

## Implementace
Backend vytvořte v PHP frameworku CodeIgniter 4. Na frontend využijte klasický webový stack: HTML, CSS, JS. Nebo můžete využít frontend frameworky. Pro databázi vytvořte migrace a seedery pomocí CI4 spark. Přidejte jednoduché jednotkové testy a integrační testy (taktéž pomocí spark). Zprávy v chatovací místnosti se budou pravidelně načítat pomocí fetch requestů na jednoduchou REST API. Nemusíte implementovat websockety. Doplňte vhodné komentáře kódu.

## Repozitář a CI pipeline
Využijte verzovací aplikaci git a repozitář umístěte veřejně na GitHub. Do repozitáře přidejte zdrojový kód i návrhové dokumenty. Do README napište instrukce k zprovoznění projektu a případně další informace. Nastavte jednoduchou CI pipeline pro testování projektu. CI pipeline realizujte pomocí GitHub Actions.

## Fungování aplikace z pohledu uživatele
Uživatel se přihlásí vyplněním přihlašovacího formuláře. Po úspěšném přihlášení je automaticky přesměrován do chatovací místnosti. V té uvidí seznam zpráv a bude moct napsat a odeslat vlastní zprávu. V poslední řadě se bude moct uživatel odhlásit.

## Odevzdání a případné dotazy
Zaměřte se hlavně na architekturu projektu. Dále dbejte na bezpečnost. Odevzdejte klidně neúplné řešení, pokud se na něčem zaseknete nebo to časově nebudete stíhat. Klidně si můžete zadání pro své účely rozšířit. Chceme vidět, co ve Vás je. 

Řešení odevzdejte nejpozději dne 14.6.2026 odesláním emailu s odkazem na veřejný GitHub repozitář na adresu: [zizlavsky@euregnia.cz](mailto:zizlavsky@euregnia.cz)

Pokud budete mít jakékoliv dotazy k zadání, tak je taktéž směřujte na tento email. 