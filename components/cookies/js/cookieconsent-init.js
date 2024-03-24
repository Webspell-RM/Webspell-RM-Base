var LOREM_IPSUM = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

// obtain iframemanager object
var manager = iframemanager();

// obtain cookieconsent plugin
var cc = initCookieConsent();


// Configure with youtube embed
/*manager.run({
    currLang: 'en',
    services : {
        youtube : {
            embedUrl: 'https://www.youtube.com/embed/{data-id}',
            thumbnailUrl: 'https://i3.ytimg.com/vi/{data-id}/hqdefault.jpg',
            iframe : {
                allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
            },
            cookie : {
                name : 'cc_youtube'
            },
            languages : {
                en : {
                    notice: 'This content is hosted by a third party. By showing the external content you accept the <a rel="noreferrer" href="https://www.youtube.com/t/terms" title="Terms and conditions" target="_blank">terms and conditions</a> of youtube.com.<br><br>Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer" href="https://www.youtube.com/t/terms" title="Allgemeine Geschäftsbedingungen" target="_blank">Allgemeine Geschäftsbedingungen</ a> von youtube.com.',
                    loadBtn: 'Load video - Video laden',
                    loadAllBtn: 'Don\'t ask again - Fragen Sie nicht noch einmal'
                }
            }
        }
    }
},{
    currLang: 'de',
    services : {
        youtube : {
            embedUrl: 'https://www.youtube-nocookie.com/embed/{data-id}',
            thumbnailUrl: 'https://i3.ytimg.com/vi/{data-id}/hqdefault.jpg',
            embedUrl: '',
            thumbnailUrl: '',
            iframe : {
                allow : 'accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen;',
            },
            cookie : {
                name : 'cc_youtube'
            },
            languages : {
                en : {
                    notice: 'Dieser Inhalt wird von einem Dritten gehostet. Durch das Anzeigen der externen Inhalte akzeptieren Sie die <a rel="noreferrer" href="https://www.youtube.com/t/terms" title="Allgemeine Geschäftsbedingungen" target="_blank">Allgemeine Geschäftsbedingungen</ a> von youtube.com.',
                    loadBtn: 'Load video',
                    loadAllBtn: 'Fragen Sie nicht noch einmal'
                }
            }
        }
    }
});*/



// run plugin with config object
cc.run({
    current_lang: false,
    autoclear_cookies: false,                 // default: false
    cookie_name: 'ws_cookie',                // default: 'cc_cookie'
    cookie_expiration: 182,                   // default: 182
    page_scripts: true,                      // default: false
    force_consent: true,                      // default: false

    auto_language: 'document',                // default: null; could also be 'browser' or 'document'
    // auto_language: null,                   // default: null; could also be 'browser' or 'document'
    // autorun: true,                         // default: true
    // delay: 0,                              // default: 0
    // hide_from_bots: false,                 // default: false
    // remove_cookie_tables: false            // default: false
     cookie_domain: location.hostname,        // default: current domain
     cookie_path: '/',                        // default: root
    /// cookie_same_site: 'None',                // None Lax Strict
     use_rfc_cookie: false,                   // default: false
    // revision: 0,                           // default: 0

    gui_options: {
        consent_modal: {
            layout: 'cloud',                    // box,cloud,bar
            position: 'bottom center',          // bottom,middle,top + left,right,center
            transition: 'slide'                 // zoom,slide
        },
        settings_modal: {
            layout: 'bar',                      // box,bar
            position: 'left',                   // right,left (available only if bar layout selected)
            transition: 'slide'                 // zoom,slide
        }
    },

    onFirstAction: function(){
        console.log('onFirstAction fired');
        window.location.reload();
    },

    onAccept: function(){
        console.log('onAccept fired!')

        // If analytics category is disabled => load all iframes automatically
        if(cc.allowedCategory('analytics')){
            console.log('iframemanager: loading all iframes');
            manager.acceptService('all');
            window.location.reload();

        }
    },

    onChange: function (cookie, changed_preferences) {
        console.log('onChange fired!');

        // If analytics category is disabled => ask for permission to load iframes
        if(!cc.allowedCategory('analytics')){
            console.log('iframemanager: disabling all iframes');
            manager.rejectService('all');
            window.location.reload();
        }else{
            console.log('iframemanager: loading all iframes');
            manager.acceptService('all');
            window.location.reload();
        }
    },

    languages: {
        'en': {
            consent_modal: {
                title: 'Hello traveller, it\'s cookie time! 🍪',
                description: '📢 Our website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent.<button type="button" data-cc="c-settings" class="cc-link">Let me choose</button>',
                primary_btn: {
                    text: 'Accept all',
                    role: 'accept_all'      //'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text: 'Reject all',
                    role: 'settings'       //'settings' or 'accept_necessary'
                },
                revision_message: '<br><br> Dear user, terms and conditions have changed since the last time you visisted!'
            },
            settings_modal: {
                title: 'Cookie settings',
                save_settings_btn: 'Save current selection',
                accept_all_btn: 'Accept all',
                reject_all_btn: 'Reject all',
                close_btn_label: 'Close',
                cookie_table_headers: [
                    {col1: 'Name'},
                    {col2: 'Domain'},
                    {col3: 'Description'}
                ],
                blocks: [
                    {
                        title: 'Cookie usage 🍪 ',
                        description: '📢 We use cookies to ensure basic functionality of the website and to improve your online experience. You can decide for each category whether you want to activate/deactivate it. For more information about cookies and other sensitive data, please see the full <a href="index.php?site=privacy_policy" class="cc-link">Privacy Policy</a>.'
                    }, {
                        title: 'Strictly Necessary Cookies',
                        description: 'These cookies are necessary for the website to function and cannot be deactivated in your systems. Typically, these cookies are only set in response to actions you take that correspond to a service request, such as setting your privacy preferences, logging in or filling out forms. You can set your browser to block these cookies or to notify you about these cookies. However, some areas of the website will not work. These cookies do not store any personal data.',
                        toggle: {
                            value: 'necessary',
                            enabled: false,
                            readonly: true  //cookie categories with readonly=true are all treated as "necessary cookies"
                        }
                    }, {
                        title: 'Functional Cookies ',
                        description: 'These cookies enable the website to provide enhanced functionality and personalization. They can be set by us or by third parties whose services we use on our sites. If you do not allow these cookies, some or all of these services may not function properly.',
                        toggle: {
                            value: 'analytics',
                            enabled: false,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: 'YouTube',
                                col2: 'youtube.com',
                                col3: 'description ...',
                                is_regex: true
                            },
                            {
                                col1: 'Gametracker',
                                col2: 'gametracker.com',
                                col3: 'Game and Teamspeak query',
                            },
                            {
                                col1: 'Twitter',
                                col2: 'twitter.com',
                                col3: 'Query from Twitter account',
                            },
                            {
                                col1: 'Discord',
                                col2: 'discord.com',
                                col3: 'Query from Discord account',
                            },
                            {
                                col1: 'twitch',
                                col2: 'twitch.tv',
                                col3: 'Query from Stream and Videos',
                            },
                            {
                                col1: 'Instagram',
                                col2: 'instagram.com',
                                col3: 'Query from Instagram account',
                            },
                            {
                                col1: 'Tiktok',
                                col2: 'tiktok.com',
                                col3: 'Query from Tiktok account',
                            },
							{
                                col1: 'Reddit',
                                col2: 'reddit.com',
                                col3: 'Query from Reddit account',
                            },

                            {
                                col1: 'Facebook',
                                col2: 'facebook.com',
                                col3: 'Query from Facebook News',
                            }
                        ]
                    }, {
                        title: 'Further information',
                        description: 'If you have any questions about our cookie policy and your choices, please <a class="cc-link" href="index.php?site=contact">Contact us</a>.',
                    }
                ]
            }
        },
		
        'de': {
            consent_modal: {
                title: 'Wir verwenden Cookies! 🍪',
                description: '📢 Hallo, diese Webseite verwendet notwendige Cookies, um ihre ordnungsgemäße Funktion sicherzustellen, und Tracking-Cookies, um zu verstehen, wie Sie mit ihr interagieren. Letztere werden erst nach Zustimmung gesetzt. <button type="button" data-cc="c-settings" class="cc-link">Lassen Sie mich auswählen</button>',
                primary_btn: {
                    text: 'Alle akzeptieren',
                    role: 'accept_all'      //'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text: 'Alle ablehnen',
                    role: 'settings'       //'settings' or 'accept_necessary'
                },
                revision_message: '<br><br> Dear user, terms and conditions have changed since the last time you visisted!'
            },
            settings_modal: {
                title: 'Cookie-Einstellungen',
                save_settings_btn: 'Einstellungen speichern',
                accept_all_btn: 'Alle akzeptieren',
                reject_all_btn: 'Alle ablehnen',
                close_btn_label: 'Schließen',
                cookie_table_headers: [
                    {col1: 'Name'},
                    {col2: 'Domain'},
                    {col3: 'Beschreibung'}
                ],
                blocks: [
                    {
                        title: 'Verwendung von Cookies 🍪 ',
                        description: '📢 Wir verwenden Cookies, um die grundlegenden Funktionen der Website sicherzustellen und Ihr Online-Erlebnis zu verbessern. Sie können für jede Kategorie entscheiden, ob Sie sie aktivieren/deaktivieren möchten. Weitere Informationen zu Cookies und anderen sensiblen Daten finden Sie in der vollständigen <a href="index.php?site=privacy_policy" class="cc-link">Datenschutzerklärung</a>.'
                    }, {
                        title: 'Unbedingt erforderliche Cookies',
                        description: 'Diese Cookies sind zur Funktion der Website erforderlich und können in Ihren Systemen nicht deaktiviert werden. In der Regel werden diese Cookies nur als Reaktion auf von Ihnen getätigte Aktionen gesetzt, die einer Dienstanforderung entsprechen, wie etwa dem Festlegen Ihrer Datenschutzeinstellungen, dem Anmelden oder dem Ausfüllen von Formularen. Sie können Ihren Browser so einstellen, dass diese Cookies blockiert oder Sie über diese Cookies benachrichtigt werden. Einige Bereiche der Website funktionieren dann aber nicht. Diese Cookies speichern keine personenbezogenen Daten.',
                        toggle: {
                            value: 'necessary',
                            enabled: false,
                            readonly: true  //cookie categories with readonly=true are all treated as "necessary cookies"
                        }
                    }, {
                        title: 'Funktionelle Cookies ',
                        description: 'Mit diesen Cookies ist die Website in der Lage, erweiterte Funktionalität und Personalisierung bereitzustellen. Sie können von uns oder von Drittanbietern gesetzt werden, deren Dienste wir auf unseren Seiten verwenden. Wenn Sie diese Cookies nicht zulassen, funktionieren einige oder alle dieser Dienste möglicherweise nicht einwandfrei.',
                        toggle: {
                            value: 'analytics',
                            enabled: false,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: 'YouTube',
                                col2: 'youtube-nocookie.com',
                                col3: 'Videos abspielen',
                                is_regex: true
                            },
                            {
                                col1: 'Gametracker',
                                col2: 'gametracker.com',
                                col3: 'Game und Teamspeak Abfrage',
                            },
                            {
                                col1: 'Twitter',
                                col2: 'twitter.com',
                                col3: 'Abfrage vom Twitter Konto',
                            },
                            {
                                col1: 'Discord',
                                col2: 'discord.com',
                                col3: 'Abfrage vom Discord Konto',
                            },
                            {
                                col1: 'twitch',
                                col2: 'twitch.tv',
                                col3: 'Abfrage vom Stream und Videos',
                            },
                            {
                                col1: 'Instagram',
                                col2: 'instagram.com',
                                col3: 'Abfrage vom Instagram',
                            },
                            {
                                col1: 'Tiktok',
                                col2: 'tiktok.com',
                                col3: 'Abfrage vom Tiktok',
                            },
							{
                                col1: 'Reddit',
                                col2: 'reddit.com',
                                col3: 'Abfrage vom Reddit',
                            },
                            {
                                col1: 'Facebook',
                                col2: 'facebook.com',
                                col3: 'Abfrage vom Facebook Nachrichten',
                            }
                        ]
                    }, {
                        title: 'Weitere Informationen',
                        description: 'Bei Fragen zu unserer Cookie-Richtlinie und Ihren Wahlmöglichkeiten, <a class="cc-link" href="index.php?site=contact">kontaktieren Sie uns</a> bitte.',
                    }
                ]
            }
        },
		
		'it': {
            consent_modal: {
                title: 'Utilizziamo i cookie! 🍪',
                description: '📢 Ciao, questo sito utilizza cookie necessari per garantirne il corretto funzionamento e cookie di tracciamento per capire come interagisci con esso. Questi ultimi vengono impostati solo dopo l\'approvazione. <button type="button" data-cc="c-settings" class="cc-link">Fammi scegliere</button>',
                primary_btn: {
                    text: 'Accetto tutti',
                    role: 'accept_all'      //'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text: 'Rifiuto tutti',
                    role: 'settings'       //'settings' or 'accept_necessary'
                },
                revision_message: '<br><br> Gentile utente, i termini e le condizioni sono cambiati dall\'ultima volta che hai visitato!'
            },
            settings_modal: {
                title: 'Impostazioni dei cookie',
                save_settings_btn: 'Salva le impostazioni',
                accept_all_btn: 'Accetto tutti',
                reject_all_btn: 'Rifiuto tutti',
                close_btn_label: 'Chiudi',
                cookie_table_headers: [
                    {col1: 'Nome'},
                    {col2: 'Domino'},
                    {col3: 'Descrizione'}
                ],
                blocks: [
                    {
                        title: 'Utilizzo dei cookie',
                        description: '📢 Utilizziamo i cookie per garantire la funzionalità di base del sito Web e per migliorare la tua esperienza online. Puoi decidere per ogni categoria se vuoi attivarla/disattivarla. Per ulteriori informazioni sui cookie e altri dati sensibili, consulta l\'<a href="index.php?site=privacy_policy" class="cc-link">Informativa sulla Privacy</a> completa.'
                    }, {
                        title: 'Cookie strettamente necessari',
                        description: 'Questi cookie sono necessari per il funzionamento del sito web e non possono essere disattivati nei vostri sistemi. In genere, questi cookie vengono impostati solo in risposta alle azioni intraprese dall\'utente che corrispondono a una richiesta di servizio, come l\'impostazione delle preferenze sulla privacy, l\'accesso o la compilazione di moduli. Puoi impostare il tuo browser per bloccare questi cookie o per avvisarti di questi cookie. Tuttavia, alcune aree del sito web non funzioneranno. Questi cookie non memorizzano alcun dato personale.',
                        toggle: {
                            value: 'necessary',
                            enabled: false,
                            readonly: true  //cookie categories with readonly=true are all treated as "necessary cookies"
                        }
                    }, {
                        title: 'Cookie funzionali',
                        description: 'Questi cookie consentono al sito Web di fornire funzionalità e personalizzazione avanzate. Possono essere impostati da noi o da terze parti di cui utilizziamo i servizi sui nostri siti. Se non consenti questi cookie, alcuni o tutti questi servizi potrebbero non funzionare correttamente.',
                        toggle: {
                            value: 'analytics',
                            enabled: false,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: 'YouTube',
                                col2: 'youtube-nocookie.com',
                                col3: 'Riproduci video',
                                is_regex: true
                            },
                            {
                                col1: 'Gametracker',
                                col2: 'gametracker.com',
                                col3: 'Interrogazione su giochi e Teamspeak',
                            },
                            {
                                col1: 'Twitter',
                                col2: 'twitter.com',
                                col3: 'Query dall\'account Twitter',
                            },
                            {
                                col1: 'Discord',
                                col2: 'discord.com',
                                col3: 'Query dall\'account Discord',
                            },
                            {
                                col1: 'twitch',
                                col2: 'twitch.tv',
                                col3: 'Query da Stream e Video',
                            },
                            {
                                col1: 'Instagram',
                                col2: 'instagram.com',
                                col3: 'Query dall\'account di Instagram',
                            },
                           {
                                col1: 'Tiktok',
                                col2: 'tiktok.com',
                                col3: 'Query dall\'account di Tiktok',
                            },
							{
                                col1: 'Reddit',
                                col2: 'reddit.com',
                                col3: 'Query dall\'account di Reddit',
                            },
                            {
                                col1: 'Facebook',
                                col2: 'facebook.com',
                                col3: 'Query dai messaggi di Facebook',
                            }
                        ]
                    }, {
                        title: 'Ulteriori informazioni',
                        description: 'Se hai domande sulla nostra politica sui cookie e sulle tue scelte, <a class="cc-link" href="index.php?site=contact">Contattaci</a>.',
                    }
                ]
            }
        }
    }
});


